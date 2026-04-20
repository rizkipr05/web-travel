<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function show($id)
    {
        $schedule = \App\Models\Schedule::with(['route', 'vehicle'])->findOrFail($id);
        $passengers = request('passengers', 1);
        
        $booked_seats = \App\Models\BookedSeat::whereHas('booking', function ($query) use ($id) {
            $query->where('schedule_id', $id)->where('status', '!=', 'cancelled');
        })->pluck('seat_number')->toArray();

        return view('pages.booking', compact('schedule', 'booked_seats', 'passengers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'name' => 'required|string',
            'phone' => 'required|string',
            'pickup' => 'required|string',
            'dropoff' => 'required|string',
            'selected_seats' => 'required|string',
        ]);

        $schedule = \App\Models\Schedule::with('route')->findOrFail($request->schedule_id);
        $seats = explode(',', $request->selected_seats);
        $total_price = $schedule->route->price * count($seats);

        $booking = \App\Models\Booking::create([
            'user_id' => \Auth::id(),
            'schedule_id' => $schedule->id,
            'user_name' => $request->name,
            'phone' => $request->phone,
            'pickup_address' => $request->pickup,
            'dropoff_address' => $request->dropoff,
            'total_price' => $total_price,
            'status' => 'pending',
            'booking_code' => 'SM-' . strtoupper(\Str::random(8)),
        ]);

        foreach ($seats as $seat) {
            \App\Models\BookedSeat::create([
                'booking_id' => $booking->id,
                'seat_number' => $seat,
            ]);
        }

        // Get Snap Token
        $midtrans = new \App\Services\MidtransService();
        $params = [
            'transaction_details' => [
                'order_id' => $booking->booking_code,
                'gross_amount' => $total_price,
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'phone' => $request->phone,
            ],
        ];

        try {
            $snapToken = $midtrans->getSnapToken($params);
            $booking->update(['payment_token' => $snapToken]);
            
            return view('pages.payment', compact('booking', 'snapToken'));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    public function myBookings()
    {
        $bookings = \App\Models\Booking::where('user_id', \Auth::id())
            ->with(['schedule.route', 'schedule.vehicle', 'bookedSeats'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('pages.my_bookings', compact('bookings'));
    }

    public function profile()
    {
        $user = \Auth::user();
        return view('pages.profile', compact('user'));
    }

    public function ticket($id)
    {
        $booking = \App\Models\Booking::with(['schedule.route', 'bookedSeats'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);
            
        return view('pages.ticket', compact('booking'));
    }

    public function updateProfile(Request $request)
    {
        $user = \Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $user->update($request->only('name', 'phone', 'address'));

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}

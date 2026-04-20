<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_bookings' => \App\Models\Booking::count(),
            'revenue' => \App\Models\Booking::where('status', 'paid')->sum('total_price'),
            'total_tours' => \App\Models\Offer::count(),
            'total_users' => \App\Models\User::count(),
        ];
        
        $recent_bookings = \App\Models\Booking::with(['schedule.route'])->orderBy('created_at', 'desc')->limit(5)->get();
        
        return view('admin.dashboard', compact('stats', 'recent_bookings'));
    }

    public function manageTours()
    {
        $tours = \App\Models\Offer::all();
        return view('admin.manage_tours', compact('tours'));
    }

    public function manageBookings()
    {
        $bookings = \App\Models\Booking::with(['schedule.route', 'user'])->orderBy('created_at', 'desc')->get();
        return view('admin.manage_bookings', compact('bookings'));
    }

    public function manageSchedules()
    {
        $schedules = \App\Models\Schedule::with(['route', 'vehicle'])->get();
        $routes = \App\Models\Route::all();
        $vehicles = \App\Models\Vehicle::all();
        return view('admin.manage_schedules', compact('schedules', 'routes', 'vehicles'));
    }

    // Tours CRUD
    public function storeTour(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'expiry_date' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'price', 'expiry_date', 'is_active']);
        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('tours', 'public');
        }

        \App\Models\Offer::create($data);
        return back()->with('success', 'Paket tour berhasil ditambahkan.');
    }

    public function updateTour(Request $request, $id)
    {
        $tour = \App\Models\Offer::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'expiry_date' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'price', 'expiry_date', 'is_active']);
        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('tours', 'public');
        }

        $tour->update($data);
        return back()->with('success', 'Paket tour berhasil diperbarui.');
    }

    public function deleteTour($id)
    {
        $tour = \App\Models\Offer::findOrFail($id);
        $tour->delete();
        return back()->with('success', 'Paket tour berhasil dihapus.');
    }

    // Schedules CRUD
    public function storeSchedule(Request $request)
    {
        $request->validate([
            'route_id' => 'required|exists:routes,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'departure_time' => 'required|date',
        ]);

        \App\Models\Schedule::create($request->all());
        return back()->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function updateSchedule(Request $request, $id)
    {
        $schedule = \App\Models\Schedule::findOrFail($id);
        $request->validate([
            'route_id' => 'required|exists:routes,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'departure_time' => 'required|date',
        ]);

        $schedule->update($request->all());
        return back()->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function deleteSchedule($id)
    {
        $schedule = \App\Models\Schedule::findOrFail($id);
        $schedule->delete();
        return back()->with('success', 'Jadwal berhasil dihapus.');
    }

    // Bookings Status Management
    public function updateBookingStatus(Request $request, $id)
    {
        $booking = \App\Models\Booking::findOrFail($id);
        $request->validate([
            'status' => 'required|in:pending,paid,completed,cancelled',
        ]);

        $booking->update(['status' => $request->status]);
        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function deleteBooking($id)
    {
        $booking = \App\Models\Booking::findOrFail($id);
        $booking->delete();
        return back()->with('success', 'Pesanan berhasil dihapus.');
    }

    public function manageOffers()
    {
        return $this->manageTours();
    }

    public function profile()
    {
        $user = \Auth::user();
        return view('admin.profile', compact('user'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransCallbackController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
    }

    public function handleCallback(Request $request)
    {
        try {
            $notification = new Notification();
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid notification payload'
            ], 400);
        }

        $transaction = $notification->transaction_status;
        $type = $notification->payment_type;
        $orderId = $notification->order_id;
        $fraud = $notification->fraud_status;

        $booking = Booking::where('booking_code', $orderId)->first();

        if (!$booking) {
            return response()->json([
                'status' => 'error',
                'message' => 'Booking not found'
            ], 404);
        }

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $booking->update(['status' => 'pending']);
                } else {
                    $booking->update(['status' => 'paid']);
                }
            }
        } else if ($transaction == 'settlement') {
            $booking->update(['status' => 'paid']);
        } else if ($transaction == 'pending') {
            $booking->update(['status' => 'pending']);
        } else if ($transaction == 'deny') {
            $booking->update(['status' => 'failed']);
        } else if ($transaction == 'expire') {
            $booking->update(['status' => 'failed']);
        } else if ($transaction == 'cancel') {
            $booking->update(['status' => 'cancelled']);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Callback processed'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $origins = \App\Models\Route::select('origin')->distinct()->pluck('origin');
        $destinations = \App\Models\Route::select('destination')->distinct()->pluck('destination');
        $offers = \App\Models\Offer::where('is_active', true)->get();
        $schedules = \App\Models\Schedule::with(['route', 'vehicle'])
            ->where('departure_time', '>', now())
            ->orderBy('departure_time', 'asc')
            ->limit(6)
            ->get();
        
        return view('pages.home', compact('origins', 'destinations', 'offers', 'schedules'));
    }

    public function tour()
    {
        $offers = \App\Models\Offer::where('is_active', true)->get();
        return view('pages.tour', compact('offers'));
    }

    public function tourDetail($id)
    {
        $offer = \App\Models\Offer::findOrFail($id);
        $schedules = \App\Models\Schedule::with(['route', 'vehicle'])
            ->where('departure_time', '>', now())
            ->orderBy('departure_time', 'asc')
            ->limit(3)
            ->get();
            
        return view('pages.tour_detail', compact('offer', 'schedules'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function help()
    {
        return view('pages.help');
    }
}

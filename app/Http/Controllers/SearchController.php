<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $date = $request->input('date');

        $schedules = \App\Models\Schedule::whereHas('route', function ($query) use ($origin, $destination) {
            $query->where('origin', $origin)->where('destination', $destination);
        })->whereDate('departure_time', $date)
          ->with(['route', 'vehicle'])
          ->get();

        return view('pages.search_results', compact('schedules', 'origin', 'destination', 'date'));
    }
}

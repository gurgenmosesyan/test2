<?php

namespace App\Http\Controllers;

use App\Models\Background\Background;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $background = Background::first();
        if (empty($background->booking)) {
            $background = $background->getImage('homepage');
        } else {
            $background = $background->getImage('booking');
        }

        $startDate = $request->input('start_date', date('Y-m-d'));
        $endDate = $request->input('end_date', date('Y-m-d', time()+86400));

        return view('booking.index')->with([
            'background' => $background,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }
}
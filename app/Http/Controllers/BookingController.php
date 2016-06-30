<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Background\Background;
use App\Models\Accommodation\Accommodation;
use App\Models\Reserved\Reserved;

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

        $startDate = $request->input('start_date', date('Y-m-d', time()+86400));
        $endDate = $request->input('end_date', date('Y-m-d', time()+172800));

        //$interval = strtotime($endDate) - strtotime($startDate);

        $accommodations = Accommodation::joinMl()->with('facilities', 'details', 'images')->get();

        $reserves = Reserved::where('date_from', '<', $endDate)->where('date_to', '>', $startDate)->orderBy('room_quantity', 'asc')->get()->keyBy('accommodation_id');

        foreach ($accommodations as $accommodation) {
            if (isset($reserves[$accommodation->id])) {
                $accommodation->room_quantity -= $reserves[$accommodation->id]->room_quantity;
            }
        }
        //dd($accommodations->toArray());

        return view('booking.index')->with([
            'background' => $background,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'accommodations' => $accommodations
        ]);
    }
}
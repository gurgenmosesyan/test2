<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Background\Background;
use App\Models\Accommodation\Accommodation;
use App\Models\Reserved\Reserved;
use DateTime;

class BookingController extends Controller
{
    protected function background()
    {
        $background = Background::first();
        if (empty($background->booking)) {
            return $background->getImage('homepage');
        } else {
            return $background->getImage('booking');
        }
    }

    public function booking1(Request $request)
    {
        $background = $this->background();

        $startDate = $request->input('start_date', date('Y-m-d', time()+86400));
        $endDate = $request->input('end_date', date('Y-m-d', time()+172800));

        return view('booking.booking1')->with([
            'background' => $background,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }

    public function booking2(Request $request)
    {
        $background = $this->background();

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $interval = 0;

        if (is_string($startDate) && is_string($endDate)) {
            $checkStart = DateTime::createFromFormat('Y-m-d', $startDate);
            $checkEnd = DateTime::createFromFormat('Y-m-d', $endDate);
            if ($checkStart && $checkStart->format('Y-m-d') === $startDate && $checkEnd && $checkEnd->format('Y-m-d') === $endDate) {
                if ($startDate > date('Y-m-d') && $endDate > $startDate) {
                    $interval = (strtotime($endDate) - strtotime($startDate)) / 86400;
                    $accommodations = Accommodation::joinMl()->with('facilities', 'details', 'images')->get();
                    $reserves = Reserved::where('date_from', '<', $endDate)->where('date_to', '>', $startDate)->orderBy('room_quantity', 'asc')->get()->keyBy('accommodation_id');
                    foreach ($accommodations as $accommodation) {
                        if (isset($reserves[$accommodation->id])) {
                            $accommodation->room_quantity -= $reserves[$accommodation->id]->room_quantity;
                        }
                        $accommodation->price = $accommodation->price * $interval;
                    }
                } else {
                    $accommodations = collect();
                }
            } else {
                $accommodations = collect();
            }
        } else {
            $accommodations = collect();
        }

        return view('booking.booking2')->with([
            'background' => $background,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'accommodations' => $accommodations,
            'interval' => $interval
        ]);
    }
}
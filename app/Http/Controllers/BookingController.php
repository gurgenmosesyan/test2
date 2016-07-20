<?php

namespace App\Http\Controllers;

use App\Models\Country\Country;
use Illuminate\Http\Request;
use App\Models\Background\Background;
use App\Models\Accommodation\Accommodation;
use App\Models\Reserved\Reserved;
use DateTime;
use Session;

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

    /*public function booking(Request $request)
    {
        $background = $this->background();

        //$startDate = Session::get('start_date');
        //$endDate = Session::get('end_date');

        $booking3 = Session::get('booking3');
        if ($booking3 != null) {
            return $this->booking4($request);
        } else {
            $booking2 = Session::get('booking2');
            if ($booking2 != null) {
                return $this->booking3($request);
            } else {
                $booking1 = Session::get('booking1');
                if ($booking1 != null) {
                    return $this->booking2($request);
                } else {
                    return $this->booking1($request);
                }
            }
        }
    }*/

    public function booking1(Request $request)
    {
        Session::forget('booking2');
        Session::forget('booking3');
        Session::forget('booking4');
        $background = $this->background();

        $startDate = Session::get('start_date');
        $endDate = Session::get('end_date');
        if ($startDate == null || $endDate == null) {
            $startDate = date('Y-m-d', time()+86400);
            $endDate = date('Y-m-d', time()+172800);
        }

        //$startDate = $request->input('start_date', date('Y-m-d', time()+86400));
        //$endDate = $request->input('end_date', date('Y-m-d', time()+172800));

        return view('booking.booking1')->with([
            'background' => $background,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }

    public function booking2(Request $request)
    {
        Session::forget('booking3');
        Session::forget('booking4');
        Session::forget('booking_info');
        $background = $this->background();

        if ($request->isMethod('post')) {
            Session::put(['booking2' => true]);
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            Session::put(['start_date' => $startDate]);
            Session::put(['end_date' => $endDate]);
        }

        if (Session::get('booking2') == null) {
            return redirect()->route('booking1', cLng('code'));
        }

        $startDate = Session::get('start_date');
        $endDate = Session::get('end_date');
        $interval = 0;

        if (is_string($startDate) && is_string($endDate)) {
            $checkStart = DateTime::createFromFormat('Y-m-d', $startDate);
            $checkEnd = DateTime::createFromFormat('Y-m-d', $endDate);
            if ($checkStart && $checkStart->format('Y-m-d') === $startDate && $checkEnd && $checkEnd->format('Y-m-d') === $endDate) {
                if ($startDate > date('Y-m-d') && $endDate > $startDate) {
                    $interval = (strtotime($endDate) - strtotime($startDate)) / 86400;
                    $accommodations = Accommodation::joinMl()->with('images')->with(['facilities' => function($query) {
                        $query->current();
                    }])->with(['details' => function($query) {
                        $query->current();
                    }])->get();
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

    public function booking3(Request $request)
    {
        Session::forget('booking4');
        Session::forget('booking_info');
        $background = $this->background();

        if ($request->isMethod('post')) {
            Session::put(['booking3' => true]);
            $reqData = $request->all();
            Session::put(['booking_acc' => $reqData]);
        }

        if (Session::get('booking3') == null) {
            if (Session::get('booking2') == null) {
                return redirect()->route('booking1', cLng('code'));
            } else {
                return redirect()->route('booking2', cLng('code'));
            }
        }

        $reqData = Session::get('booking_acc');

        //$startDate = $request->input('start_date');
        //$endDate = $request->input('end_date');

        //$reqData = $request->all();
        $data = [];
        $accIds = [];
        if (isset($reqData['accommodations']) && is_array($reqData['accommodations'])) {
            foreach ($reqData['accommodations'] as $accId => $value) {
                if (!empty($value['quantity'])) {
                    $accIds[] = $accId;
                    $data[$accId]['quantity'] = $value['quantity'];
                    if (isset($value['details']) && is_array($value['details'])) {
                        foreach ($value['details'] as $index => $detail) {
                            if ($detail == '1') {
                                $data[$accId]['details'][$index] = 1;
                            }
                        }
                    }
                }
            }
        }
        $price = 0;
        $accommodations = Accommodation::joinMl()->whereIn('accommodations.id', $accIds)->with(['details' => function($query) {
            $query->current();
        }])->get();
        foreach ($accommodations as $acc) {
            $price += $acc->price * $data[$acc->id]['quantity'];
            foreach ($acc->details as $key => $detail) {
                if (isset($data[$acc->id]['details'][$detail->index])) {
                    $price += $detail->price;
                } else {
                    unset($acc->details[$key]);
                }
            }
        }

        $countries = Country::all();

        return view('booking.booking3')->with([
            'background' => $background,
            //'startDate' => $startDate,
            //'endDate' => $endDate,
            'accommodations' => $accommodations,
            'countries' => $countries,
            'price' => $price
        ]);
    }

    public function booking4()
    {
        if (Session::get('booking4') == null) {
            if (Session::get('booking3') != null) {
                return redirect()->route('booking3', cLng('code'));
            } else if (Session::get('booking2') != null) {
                return redirect()->route('booking2', cLng('code'));
            } else {
                return redirect()->route('booking1', cLng('code'));
            }
        }
        $background = $this->background();

        return view('booking.booking4')->with([
            'background' => $background
        ]);
    }

    public function cash()
    {
        if (Session::get('booking4') == null) {
            if (Session::get('booking3') != null) {
                return redirect()->route('booking3', cLng('code'));
            } else if (Session::get('booking2') != null) {
                return redirect()->route('booking2', cLng('code'));
            } else {
                return redirect()->route('booking1', cLng('code'));
            }
        }

        $startData = Session::get('start_date');
        $endDate = Session::get('end_date');
        $accommodations = Session::get('booking_acc');
        $info = Session::get('booking_info');

        if ($this->check($startData, $endDate, $accommodations)) {
            $success = true;
        } else {
            $success = false;
        }

        return view('booking.booking5');
    }

    protected function check($startDate, $endDate, $accommodations)
    {
        $accommodations = Accommodation::get();
        $reserves = Reserved::where('date_from', '<', $endDate)->where('date_to', '>', $startDate)->orderBy('room_quantity', 'asc')->get()->keyBy('accommodation_id');
        foreach ($accommodations as $accommodation) {
            if (isset($reserves[$accommodation->id])) {
                $accommodation->room_quantity -= $reserves[$accommodation->id]->room_quantity;
            }
            $accommodation->price = $accommodation->price * $interval;
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Booking\Manager;
use App\Models\Country\Country;
use Illuminate\Http\Request;
use App\Models\Background\Background;
use App\Models\Accommodation\Accommodation;
use App\Models\Reserved\Reserved;
use DateTime;
use Session;

class BookingController extends Controller
{
    protected $manager = null;

    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    protected function background()
    {
        $background = Background::first();
        if (empty($background->booking)) {
            return $background->getImage('homepage');
        } else {
            return $background->getImage('booking');
        }
    }

    public function booking1()
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
                    }])->get()->keyBy('id');
                    $reserves = Reserved::where('date_from', '<', $endDate)->where('date_to', '>', $startDate)->orderBy('room_quantity', 'asc')->get();
                    foreach ($reserves as $reserve) {
                        if (isset($accommodations[$reserve->accommodation_id])) {
                            $accommodations[$reserve->accommodation_id]->room_quantity -= $reserve->room_quantity;
                        }
                    }
                    foreach ($accommodations as $acc) {
                        $acc->price = $acc->price * $interval;
                        foreach ($acc->details as $key => $detail) {
                            $acc->details[$key]->price = $detail->price * $interval;
                        }
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
            Session::put(['booking_acc' => $data]);
        }

        if (Session::get('booking3') == null) {
            if (Session::get('booking2') == null) {
                return redirect()->route('booking1', cLng('code'));
            } else {
                return redirect()->route('booking2', cLng('code'));
            }
        }

        $data = Session::get('booking_acc');
        $accIds = [];
        foreach ($data as $key => $value) {
            $accIds[] = $key;
        }

        //$price = 0;
        $accommodations = Accommodation::joinMl()->whereIn('accommodations.id', $accIds)->with(['details' => function($query) {
            $query->current();
        }])->get();
        /*foreach ($accommodations as $acc) {
            $price += $acc->price * $data[$acc->id]['quantity'];
            foreach ($acc->details as $key => $detail) {
                if (isset($data[$acc->id]['details'][$detail->index])) {
                    $price += $detail->price;
                } else {
                    unset($acc->details[$key]);
                }
            }
        }
        Session::put(['price' => $price]);*/

        $countries = Country::all();

        return view('booking.booking3')->with([
            'background' => $background,
            'accommodations' => $accommodations,
            'countries' => $countries,
            //'price' => $price
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

        $background = $this->background();

        $startData = Session::get('start_date');
        $endDate = Session::get('end_date');
        $accommodations = Session::get('booking_acc');
        $info = Session::get('booking_info');
        //$price = Session::get('price');

        if (($data = $this->manager->check($startData, $endDate, $accommodations)) !== false) {
            $success = true;
            $price = $data['price'];
            $accommodations = $data['accommodations'];
            $this->manager->finishCash($startData, $endDate, $accommodations, $price, $info);
            //$this->manager->reserve($accommodations, $startData, $endDate);
        } else {
            $success = false;
        }

        return view('booking.booking5')->with([
            'background' => $background,
            'success' => $success
        ]);
    }
}
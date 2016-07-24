<?php

namespace App\Models\Booking;

use App\Models\Accommodation\Accommodation;
use App\Models\Reserved\Reserved;
use App\Models\Order\Order;
use App\Models\Order\OrderAccommodation;
use App\Models\Country\Country;
use DB;

class Manager
{
    public function check($startDate, $endDate, $accommodations)
    {
        $interval = (strtotime($endDate) - strtotime($startDate)) / 86400;
        $price = 0;
        $accData = Accommodation::joinMl()->with('ml', 'details')->get()->keyBy('id');
        $reserves = Reserved::where('date_from', '<', $endDate)->where('date_to', '>', $startDate)->orderBy('room_quantity', 'asc')->get();
        /*foreach ($accommodations as $acc) {
            $price += $acc->price * $interval * $data[$acc->id]['quantity'];
            foreach ($acc->details as $key => $detail) {
                if (isset($data[$acc->id]['details'][$detail->index])) {
                    $price += $detail->price;
                } else {
                    unset($acc->details[$key]);
                }
            }
        }*/

        //$accData = Accommodation::get()->keyBy('id');

        foreach ($reserves as $reserve) {
            if (isset($accData[$reserve->accommodation_id])) {
                $accData[$reserve->accommodation_id]->room_quantity -= $reserve->room_quantity;
            }
        }
        $data = [];
        foreach ($accommodations as $accId => $value) {
            if (!isset($accData[$accId]) || $value['quantity'] > $accData[$accId]->room_quantity) {
                return false;
            }
            $price += $accData[$accId]->price * $interval * $value['quantity'];
            $data[$accId] = [
                'id' => $accId,
                'quantity' => $value['quantity']
            ];
            foreach ($accData[$accId]->ml as $ml) {
                $data[$accId]['ml'][$ml->lng_id] = $ml->title;
            }
            $details = $accData[$accId]->details->keyBy('index');
            if (isset($value['details']) && is_array($value['details'])) {
                foreach ($value['details'] as $detailIndex => $val) {
                    if (!isset($details[$detailIndex])) {
                        return false;
                    }
                    $price += $details[$detailIndex]->price * $interval;
                }
                foreach ($accData[$accId]->details as $detail) {
                    if (isset($value['details'][$detail->index])) {
                        $data[$accId]['details'][$detail->index][$detail->lng_id] = $detail->title;
                    }
                }
            }
            /*foreach ($accData[$accId]->details as $key => $detail) {
                if (isset($value['details'][$detail->index])) {
                    $price += $detail->price;
                } else {
                    unset($acc->details[$key]);
                }
            }*/
        }
        return [
            'accommodations' => $data,
            'price' => $price
        ];
    }

    public function finishCash($startDate, $endDate, $accommodations, $price, $info)
    {
        DB::transaction(function() use($startDate, $endDate, $accommodations, $price, $info) {
            $this->reserve(Reserved::TYPE_CASH, $startDate, $endDate, $accommodations);
            $this->order(Order::TYPE_CASH, $startDate, $endDate, $accommodations, $price, $info);
        });
    }

    protected function reserve($type, $startDate, $endDate, $data)
    {
        $reserved = [];
        foreach ($data as $accId => $value) {
            $reserved[] = [
                'accommodation_id' => $accId,
                'room_quantity' => $value['quantity'],
                'date_from' => $startDate,
                'date_to' => $endDate,
                'type' => $type
            ];
        }
        Reserved::insert($reserved);
    }

    protected function order($type, $startDate, $endDate, $accommodations, $price, $info)
    {
        foreach ($info['info'] as $key => $value) {
            $country = Country::where('id', $value['citizenship'])->first();
            $info['info'][$key]['citizenship'] = [
                'en' => $country->name_en,
                'hy' => $country->name_hy,
                'ru' => $country->name_ru
            ];
        }
        $order = new Order([
            'type' => $type,
            'accommodations' => json_encode($accommodations),
            'price' => $price,
            'date_from' => $startDate,
            'date_to' => $endDate,
            'info' => json_encode($info['info']),
            'phone' => $info['phone'],
            'email' => $info['email']
        ]);
        $order->save();
        $orderAccData = [];
        foreach ($accommodations as $accId => $acc) {
            $orderAccData[] = new OrderAccommodation([
                'accommodation_id' => $accId
            ]);
        }
        $order->accommodations()->saveMany($orderAccData);
    }
}
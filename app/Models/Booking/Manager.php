<?php

namespace App\Models\Booking;

use App\Models\Accommodation\Accommodation;
use App\Models\Reserved\Reserved;
use App\Models\Order\Order;
use DB;

class Manager
{
    public function check($startDate, $endDate, $accommodations)
    {
        $accData = Accommodation::get()->keyBy('id');
        $reserves = Reserved::where('date_from', '<', $endDate)->where('date_to', '>', $startDate)->orderBy('room_quantity', 'asc')->get();

        foreach ($reserves as $reserve) {
            if (isset($accData[$reserve->accommodation_id])) {
                $accData[$reserve->accommodation_id]->room_quantity -= $reserve->room_quantity;
            }
        }
        foreach ($accommodations as $accId => $value) {
            if (!isset($accData[$accId]) || $value['quantity'] > $accData[$accId]->room_quantity) {
                return false;
            }
        }
        return true;
    }

    protected function reserve($startDate, $endDate, $data)
    {
        $reserved = [];
        foreach ($data as $accId => $value) {
            $reserved[] = [
                'accommodation_id' => $accId,
                'room_quantity' => $value['quantity'],
                'date_from' => $startDate,
                'date_to' => $endDate
            ];
        }
        Reserved::insert($reserved);
    }

    public function finishCash($startDate, $endDate, $accommodations, $price, $info)
    {
        DB::transaction(function() use($startDate, $endDate, $accommodations, $price, $info) {
            $this->reserve($startDate, $endDate, $accommodations);
            $this->order('cash', $startDate, $endDate, $accommodations, $price, $info);
        });
    }

    protected function order($type, $startDate, $endDate, $accommodations, $price, $info)
    {
        $data = [
            'type' => $type,
            'accommodations' => json_encode($accommodations),
            'price' => $price,
            'date_from' => $startDate,
            'date_to' => $endDate,
            'info' => json_encode($info['info']),
            'phone' => $info['phone'],
            'email' => $info['email']
        ];
        Order::create($data);
    }
}
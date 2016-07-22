<?php

namespace App\Models\Order;

use App\Core\DataTable;

class Search extends DataTable
{
    public function totalCount()
    {
        return Order::count();
    }

    public function filteredCount()
    {
        $query = $this->constructQuery();
        return $query->count();
    }

    public function search()
    {
        $query = $this->constructQuery();
        $this->constructOrder($query);
        $this->constructLimit($query);
        $cLngId = cLng('id');
        $data = $query->get();
        foreach ($data as $value) {
            $accommodations = json_decode($value->accommodations, true);
            $value->accommodations = '';
            foreach ($accommodations as $acc) {
                $value->accommodations .= $acc['ml'][$cLngId].' - '.$acc['quantity'].'<br />';
                if (isset($acc['details'])) {
                    $value->accommodations .= '(';
                    foreach ($acc['details'] as $detail) {
                        $value->accommodations .= $detail[$cLngId];
                    }
                    $value->accommodations .= ')<hr />';
                }
            }

            $guests = json_decode($value->info, true);
            $value->info = '';
            foreach ($guests as $guest) {
                $value->info .= $guest['first_name'].' '.$guest['last_name'].'<br />';
            }
        }
        return $data;
    }

    protected function constructQuery()
    {
        $query = Order::getProcessor();
        if ($this->search != null) {
            $query->where('ml.title', 'LIKE', '%'.$this->search.'%')
                ->orWhere('ml.text', 'LIKE', '%'.$this->search.'%');
        }
        return $query;
    }

    protected function constructOrder($query)
    {
        switch ($this->orderCol) {
            case 'title':
                $orderCol = 'ml.title';
                break;
            case 'sort_order':
                $orderCol = 'orders.sort_order';
                break;
            default:
                $orderCol = 'orders.id';
        }
        $orderType = 'desc';
        if ($this->orderType == 'asc') {
            $orderType = 'asc';
        }
        $query->orderBy($orderCol, $orderType);
    }

    protected function constructLimit($query)
    {
        $query->skip($this->start)->take($this->length);
    }
}
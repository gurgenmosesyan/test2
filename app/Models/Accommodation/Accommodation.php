<?php

namespace App\Models\Accommodation;

use App\Core\Model;

class Accommodation extends Model
{
    const IMAGES_PATH = 'images/accommodation';

    protected $fillable = [
        'room_quantity',
        //'price',
        'room_size',
        'sort_order'
    ];

    protected $table = 'accommodations';

    public function getPrice($startDate, $endDate)
    {
        $startTime = strtotime($startDate);
        $endTime = strtotime($endDate);
        $prices = $this->prices;
        $priceResult = 0;
        if (date('Y', $startTime) != date('Y', $endTime)) {
            $end1Time = strtotime(date('Y', $startTime).'-12-31');
            $start2Time = strtotime(date('Y', $endTime).'-01-01');
            foreach($prices as $price) {
                if ($price->start_date < date('m-d', $end1Time) && $price->end_date >= date('m-d', $startTime)) {
                    /*if ($price->start_date <= date('m-d', $startTime)) {
                        if ($price->end_date <= date('m-d', $end1Time)) {
                            $interval = (strtotime(date('Y', $startTime).'-'.$price->end_date) - $startTime) / 86400;
                        } else {
                            $interval = ($end1Time - $startTime) / 86400;
                        }
                    } else {
                        if ($price->end_date <= date('m-d', $end1Time)) {
                            $interval = (strtotime(date('Y', $startTime).'-'.$price->end_date) - strtotime(date('Y', $startTime).'-'.$price->start_date)) / 86400;
                        } else {
                            $interval = ($end1Time - strtotime(date('Y', $startTime).'-'.$price->start_date)) / 86400;
                        }
                    }*/
                    $interval = $this->getInterval($startTime, $end1Time, $price);
                    $priceResult += $interval * $price->price;

                }
                if ($price->start_date < date('m-d', $endTime) && $price->end_date >= date('m-d', $start2Time)) {

                    /*if ($price->start_date <= date('m-d', $start2Time)) {
                        if ($price->end_date <= date('m-d', $endTime)) {
                            $interval = (strtotime(date('Y', $start2Time).'-'.$price->end_date) - $start2Time) / 86400;
                        } else {
                            $interval = ($endTime - $start2Time) / 86400;
                        }
                    } else {
                        if ($price->end_date <= date('m-d', $endTime)) {
                            $interval = (strtotime(date('Y', $start2Time).'-'.$price->end_date) - strtotime(date('Y', $startTime).'-'.$price->start_date)) / 86400;
                        } else {
                            $interval = ($endTime - strtotime(date('Y', $start2Time).'-'.$price->start_date)) / 86400;
                        }
                    }*/
                    $interval = $this->getInterval($start2Time, $endTime, $price);
                    $priceResult += $interval * $price->price;

                }
            }
        } else {

            //dd($prices->toArray(), $startDate, $endDate);
            foreach ($prices as $price) {

                if ($price->start_date < date('m-d', $endTime) && $price->end_date >= date('m-d', $startTime)) {

                    /*if ($price->start_date <= date('m-d', $startTime)) {
                        if ($price->end_date < date('m-d', $endTime)) {
                            $interval = ((strtotime(date('Y', $startTime).'-'.$price->end_date)+86400) - $startTime) / 86400;
                        } else {
                            $interval = ($endTime - $startTime) / 86400;
                        }
                    } else {
                        if ($price->end_date < date('m-d', $endTime)) {
                            $interval = ((strtotime(date('Y', $startTime).'-'.$price->end_date)+86400) - strtotime(date('Y', $startTime).'-'.$price->start_date)) / 86400;
                        } else {
                            $interval = ($endTime - strtotime(date('Y', $startTime).'-'.$price->start_date)) / 86400;
                        }
                    }*/
                    $interval = $this->getInterval($startTime, $endTime, $price);
                    $priceResult += $interval * $price->price;

                }
            }
        }
        return $priceResult;
    }

    protected function getInterval($startTime, $endTime, AccommodationPrice $price)
    {
        if ($price->start_date <= date('m-d', $startTime)) {
            if ($price->end_date < date('m-d', $endTime)) {
                $interval = ((strtotime(date('Y', $startTime).'-'.$price->end_date)+86400) - $startTime) / 86400;
            } else {
                $interval = ($endTime - $startTime) / 86400;
            }
        } else {
            if ($price->end_date < date('m-d', $endTime)) {
                $interval = ((strtotime(date('Y', $startTime).'-'.$price->end_date)+86400) - strtotime(date('Y', $startTime).'-'.$price->start_date)) / 86400;
            } else {
                $interval = ($endTime - strtotime(date('Y', $startTime).'-'.$price->start_date)) / 86400;
            }
        }
        return $interval;
    }

    public function scopeJoinMl($query)
    {
        return $query->join('accommodations_ml as ml', function($query) {
            $query->on('ml.id', '=', 'accommodations.id')->where('ml.lng_id', '=', cLng('id'));
        });
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('accommodations.sort_order', 'asc');
    }

    public function prices()
    {
        return $this->hasMany(AccommodationPrice::class, 'accommodation_id', 'id');
    }

    public function ml()
    {
        return $this->hasMany(AccommodationMl::class, 'id', 'id');
    }

    public function facilities()
    {
        return $this->hasMany(AccommodationFacility::class, 'accommodation_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(AccommodationDetail::class, 'accommodation_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(AccommodationImage::class, 'accommodation_id', 'id')->active();
    }

    public function getFile($column)
    {
        return $this->$column;
    }

    public function setFile($file, $column)
    {
        $this->attributes[$column] = $file;
    }

    public function getStorePath()
    {
        return self::IMAGES_PATH;
    }
}
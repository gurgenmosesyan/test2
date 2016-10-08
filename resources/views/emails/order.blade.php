<?php

$cLngId = cLng('id');
$interval = (strtotime($endDate) - strtotime($startDate)) / 86400;

$names = '';
foreach($info['info'] as $value) {
    $names .= $value['first_name'].' '.$value['last_name'].', ';
}
echo trans('www.order.email.guests_name') . ' - ' . rtrim($names, ', ') . "\r\n";
echo trans('www.order.email.checkin_date') . ' - ' . date('d/m/Y', strtotime($startDate)).' 14:00' . "\r\n";
echo trans('www.order.email.checkout_date') . ' - ' . date('d/m/Y', strtotime($endDate)).' 14:00' . "\r\n";
foreach($accommodations as $value) {
    echo trans('www.order.email.room_type') . ' - ' . isset($value['ml'][$cLngId]) ? $value['ml'][$cLngId] : array_shift($value['ml']);
    echo "\r\n";
    echo trans('www.order.email.room_quantity') . ' - ' . $value['quantity'] . "\r\n";
}
echo trans('www.order.email.amount') . ' - ' . $price . "\r\n";
echo trans('www.order.email.payment_type') . ' - ' . $paymentType . "\r\n";

?>
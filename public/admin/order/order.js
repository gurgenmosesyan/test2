var $order = $.extend(true, {}, $main);
$order.listPath = '/admpanel/order';

$order.initSearchPage = function() {
    $order.listColumns = [
        {data: 'id'},
        {data: 'accommodations'},
        {data: 'price'},
        {data: 'date_from'},
        {data: 'date_to'},
        {data: 'info'},
        {data: 'phone'},
        {data: 'email'}
    ];
    $order.initSearch();
};

$order.initEditPage = function() {

    $order.initForm();
};

$order.init();

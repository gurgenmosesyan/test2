var $facility = $.extend(true, {}, $main);
$facility.listPath = '/admpanel/facility';

$facility.initSearchPage = function() {
    $facility.listColumns = [
        {data: 'id'},
        {data: 'title'}
    ];
    $facility.initSearch();
};

$facility.initEditPage = function() {
    $facility.initForm();
};

$facility.init();

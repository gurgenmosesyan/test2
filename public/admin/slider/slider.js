var $slider = $.extend(true, {}, $main);
$slider.listPath = '/admpanel/slider';

$slider.initSearchPage = function() {
    $slider.listColumns = [
        {data: 'id'},
        {data: 'category'},
        {
            data: 'image',
            sorting: false,
            render: function(data) {
                return '<img src="/images/slider/'+data+'" style="max-width:150px;max-height:80px;" />';
            }
        }
    ];
    $slider.initSearch();
};

$slider.initEditPage = function() {
    $slider.initForm();
};

$slider.init();

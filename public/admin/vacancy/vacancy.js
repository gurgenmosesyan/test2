var $vacancy = $.extend(true, {}, $main);
$vacancy.listPath = '/admpanel/vacancy';

$vacancy.initSearchPage = function() {
    $vacancy.listColumns = [
        {data: 'id'},
        {data: 'title'},
        {data: 'function'}
    ];
    $vacancy.initSearch();
};

$vacancy.initEditPage = function() {

    $vacancy.initForm();

    $('.date').datepicker({
        autoclose: true
    });

    $('#asap').on('ifChanged', function() {
        if ($(this).prop('checked')) {
            $('#start-date').attr('disabled', 'disabled').val('');
        } else {
            $('#start-date').attr('disabled', false);
        }
    });
};

$vacancy.init();

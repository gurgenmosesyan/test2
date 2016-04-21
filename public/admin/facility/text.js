var $text = $.extend(true, {}, $main);
$text.listPath = '/admpanel/facility/text';

$text.initSearchPage = function() {
    $text.listColumns = [
        {data: 'id'},
        {data: 'title'}
    ];
    $text.initSearch();
};

$text.initEditPage = function() {
    $text.initForm();

    CKEDITOR.config.height = 120;
};

$text.init();

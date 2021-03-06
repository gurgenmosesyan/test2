var $accommodation = $.extend(true, {}, $main);
$accommodation.listPath = '/admpanel/accommodation';
$accommodation.imgIndex = 0;
$accommodation.facilityIndex = 0;
$accommodation.detailIndex = 0;
$accommodation.priceIndex = 0;

$accommodation.initSearchPage = function() {
    $accommodation.listColumns = [
        {data: 'id'},
        {data: 'title'},
        {data: 'sort_order'}
    ];
    $accommodation.order = [3, 'asc'];
    $accommodation.initSearch();
};

$accommodation.initUploaderForm = function() {
    var html =  '<div id="iframe-img-uploader" style="display: none">'+
                    '<form target="iframe-uploader" action="/admpanel/core/image/upload" method="post" enctype="multipart/form-data">'+
                        '<input type="file" name="image" />'+
                        '<input type="text" name="module" value="accommodation.images.image" />'+
                        '<input type="hidden" name="_token" value="'+ $main.token +'" />'+
                    '</form>'+
                    '<iframe src="#" id="iframe-uploader" name="iframe-uploader" style="display: none;"></iframe>'+
                '</div>';
    html = $(html);
    $('input[type="file"]', html).change(function() {
        $('form', html).submit();
    });
    $('form', html).submit(function() {
        $('iframe', html).load(function() {
            var result = $.parseJSON($(this.contentDocument).find('body').html());
            var errorObj = $('#form-error-images');
            var groupObj = $('#image-group');
            errorObj.text('');
            groupObj.removeClass('has-error');

            if (result.status == 'OK') {
                $accommodation.addImage(result.data.img_path, result.data.id);
            } else {
                errorObj.text(result.data.error);
                groupObj.addClass('has-error');
            }
        });
    });
    $('body').append(html);
    $('input[type="file"]', html).trigger('click');
};

$accommodation.addImage = function(imgPath, imgVal, id) {
    var idStr = id ? '<input type="hidden" name="images['+ $accommodation.imgIndex +'][id]" value="'+ id +'" />' : '';
    var html =  '<div class="img-thumbnail img-block">'+
                    '<div class="img-item">'+
                        '<img class="uploaded-image" src="'+ imgPath +'" />'+
                    '</div>'+
                    '<input type="hidden" name="images['+ $accommodation.imgIndex +'][image]" value="'+ imgVal +'" />'+
                    idStr+
                    '<div class="img-tools text-center">'+
                        '<a href="#" class="btn btn-xs btn-danger delete-img"><i class="fa fa-remove"></i></a>'+
                    '</div>'+
                '</div>';
    html = $(html);
    $accommodation.initImageTools(html);
    $('#images-block').append(html);
    $accommodation.imgIndex++;
};

$accommodation.initImageTools = function(html) {
    $('.delete-img', html).on('click', function() {
        html.remove();
        return false;
    });
};

$accommodation.generateImages = function() {
    if (!$.isEmptyObject($accommodation.images)) {
        for (var i in $accommodation.images) {
            var imgPath = '/images/accommodation/'+$accommodation.images[i].image;
            $accommodation.addImage(imgPath, 'same', $accommodation.images[i].id);
        }
    }
};

$accommodation.initImageUpload = function() {
    $('#upload-image').on('click', function() {
        $('#iframe-img-uploader').remove();
        $accommodation.initUploaderForm();
        return false;
    });

    $accommodation.generateImages();
};

$accommodation.addFacility = function(facilityData) {
    var title,
        html = '<div class="row"><div class="col-sm-11 no-padding">',
        index = $accommodation.facilityIndex,
        lng;

    for (var i in $accommodation.languages) {
        lng = $accommodation.languages[i];
        title = facilityData && facilityData[lng.id] ? facilityData[lng.id].title : '';
        html += '<div class="col-sm-4">'+
                    '<div class="form-group form-group-inner">'+
                        '<input type="text" name="ml['+lng.id+'][facilities]['+index+'][title]" class="form-control" value="'+title+'" placeholder="'+lng.name+'">'+
                        '<div id="form-error-ml_'+lng.id+'_facilities_'+index+'_title" class="form-error"></div>'+
                    '</div>'+
                '</div>';
    }
    html += '</div>';
    html += '<div class="col-sm-1 row"><a href="#" class="btn btn-default remove"><i class="fa fa-remove"></i></a></div>';
    html += '</div>';

    html = $(html);
    $('.remove', html).on('click', function() {
        html.remove();
        return false;
    });

    $('#facilities').append(html);
    $accommodation.facilityIndex++;
};

$accommodation.initFacilities = function() {
    $('#add-facility').on('click', function() {
        $accommodation.addFacility();
        return false;
    });
    if (!$.isEmptyObject($accommodation.facilities)) {
        for (var i in $accommodation.facilities) {
            $accommodation.addFacility($accommodation.facilities[i]);
        }
    }
};

$accommodation.addDetail = function(detailData) {
    var title,
        price,
        html = '<div class="row"><div class="col-sm-11 no-padding">',
        index = $accommodation.detailIndex,
        lng;

    for (var i in $accommodation.languages) {
        lng = $accommodation.languages[i];
        if (detailData && detailData[lng.id]) {
            title = detailData[lng.id].title;
            price = detailData[lng.id].price;
        } else {
            title = '';
            price = '';
        }
        title = detailData && detailData[lng.id] ? detailData[lng.id].title : '';
        html += '<div class="col-sm-4">'+
                    '<div class="form-group form-group-inner">'+
                        '<input type="text" name="details['+index+'][ml]['+lng.id+'][title]" class="form-control" value="'+title+'" placeholder="'+lng.name+'">'+
                        '<div id="form-error-details_'+index+'_ml_'+lng.id+'_title" class="form-error"></div>'+
                    '</div>'+
                '</div>';
    }
    html += '<div class="cb col-sm-4" style="margin-top:10px;">'+
                '<input type="text" name="details['+index+'][price]" class="form-control" value="'+price+'" placeholder="'+$trans.get('admin.base.label.price')+'">'+
                '<div id="form-error-details_'+index+'_price" class="form-error"></div>'+
            '</div>';
    html += '</div>';
    html += '<div class="col-sm-1 row"><a href="#" class="btn btn-default remove"><i class="fa fa-remove"></i></a></div>';
    html += '</div>';

    html = $(html);
    $('.remove', html).on('click', function() {
        html.remove();
        return false;
    });

    $('#details').append(html);
    $accommodation.detailIndex++;
};

$accommodation.initDetails = function() {
    $('#add-detail').on('click', function() {
        $accommodation.addDetail();
        return false;
    });
    if (!$.isEmptyObject($accommodation.details)) {
        for (var i in $accommodation.details) {
            $accommodation.addDetail($accommodation.details[i]);
        }
    }
};

$accommodation.addPrice = function(obj) {
    var startMonths = '',
        startDays = '',
        endMonths = '',
        endDays = '',
        html,
        index = $accommodation.priceIndex,
        start_month = '',
        start_day = '',
        end_month = '',
        end_day = '',
        price = '';
    if (obj) {
        start_month = obj.start_month;
        start_day = obj.start_day;
        end_month = obj.end_month;
        end_day = obj.end_day;
        price = obj.price;
    }
    for (var i = 1; i < 10; i++) {
        startMonths += '<option value="0'+i+'"'+('0'+i == start_month ? ' selected="selected"' : '')+'>0'+i+'</option>';
    }
    for (i = 10; i < 13; i++) {
        startMonths += '<option value="'+i+'"'+(i == start_month ? ' selected="selected"' : '')+'>'+i+'</option>';
    }
    for (i = 1; i < 10; i++) {
        startDays += '<option value="0'+i+'"'+('0'+i == start_day ? ' selected="selected"' : '')+'>0'+i+'</option>';
    }
    for (i = 10; i < 32; i++) {
        startDays += '<option value="'+i+'"'+(i == start_day ? ' selected="selected"' : '')+'>'+i+'</option>';
    }
    for (i = 1; i < 10; i++) {
        endMonths += '<option value="0'+i+'"'+('0'+i == end_month ? ' selected="selected"' : '')+'>0'+i+'</option>';
    }
    for (i = 10; i < 13; i++) {
        endMonths += '<option value="'+i+'"'+(i == end_month ? ' selected="selected"' : '')+'>'+i+'</option>';
    }
    for (i = 1; i < 10; i++) {
        endDays += '<option value="0'+i+'"'+('0'+i == end_day ? ' selected="selected"' : '')+'>0'+i+'</option>';
    }
    for (i = 10; i < 32; i++) {
        endDays += '<option value="'+i+'"'+(i == end_day ? ' selected="selected"' : '')+'>'+i+'</option>';
    }
    html =  '<div class="row" style="margin-bottom: 5px;">'+
                '<div class="col-sm-2">' +
                    '<select class="form-control" name="prices['+index+'][start_month]">'+
                        '<option value="">'+$trans.get('admin.base.label.month')+'</option>'+
                        startMonths+
                    '</select>'+
                    '<div id="form-error-prices_'+index+'_start_month" class="form-error"></div>'+
                '</div>'+
                '<div class="col-sm-2">'+
                    '<select class="form-control" name="prices['+index+'][start_day]">'+
                        '<option value="">'+$trans.get('admin.base.label.day')+'</option>'+
                        startDays+
                    '</select>'+
                    '<div id="form-error-prices_'+index+'_start_day" class="form-error"></div>'+
                '</div>'+
                '<div class="col-sm-1 text-center" style="padding-top: 5px;">'+
                    '<i class="fa fa-arrow-right"></i>'+
                '</div>'+
                '<div class="col-sm-2">' +
                    '<select class="form-control" name="prices['+index+'][end_month]">'+
                        '<option value="">'+$trans.get('admin.base.label.month')+'</option>'+
                        endMonths+
                    '</select>'+
                    '<div id="form-error-prices_'+index+'_end_month" class="form-error"></div>'+
                '</div>'+
                '<div class="col-sm-2">'+
                    '<select class="form-control" name="prices['+index+'][end_day]">'+
                        '<option value="">'+$trans.get('admin.base.label.day')+'</option>'+
                        endDays+
                    '</select>'+
                    '<div id="form-error-prices_'+index+'_end_day" class="form-error"></div>'+
                '</div>'+
                '<div class="col-sm-2">'+
                    '<input type="text" name="prices['+index+'][price]" class="form-control" value="'+price+'" placeholder="'+$trans.get('admin.base.label.price')+'">'+
                '</div>'+
                '<div class="col-sm-1" style="padding-top: 5px;">'+
                    '<a href="#"><i class="fa fa-remove remove-price"></i></a>'+
                '</div>'+
            '</div>';
    html = $(html);
    html.find('.remove-price').on('click', function() {
        html.remove();
        return false;
    });
    $('#prices-block').append(html);
    $accommodation.priceIndex++;
};

$accommodation.initPrices = function() {
    $('#add-price').on('click', function() {
        $accommodation.addPrice();
        return false;
    });
    if (!$.isEmptyObject($accommodation.prices)) {
        for (var i in $accommodation.prices) {
            $accommodation.addPrice($accommodation.prices[i]);
        }
    }
};

$accommodation.initEditPage = function() {

    $accommodation.initForm();

    $accommodation.initPrices();

    $accommodation.initImageUpload();

    $accommodation.initFacilities();

    $accommodation.initDetails();

    CKEDITOR.config.height = 120;
};

$accommodation.init();

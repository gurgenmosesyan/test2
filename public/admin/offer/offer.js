var $offer = $.extend(true, {}, $main);
$offer.listPath = '/admpanel/offer';
$offer.imgIndex = 0;

$offer.initSearchPage = function() {
    $offer.listColumns = [
        {data: 'id'},
        {data: 'title'},
        {data: 'sort_order'}
    ];
    $offer.initSearch();
};

$offer.initUploaderForm = function() {
    var html =  '<div id="iframe-img-uploader" style="display: none">'+
                    '<form target="iframe-uploader" action="/admpanel/core/image/upload" method="post" enctype="multipart/form-data">'+
                        '<input type="file" name="image" />'+
                        '<input type="text" name="module" value="offer.images.image" />'+
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
                $offer.addImage(result.data.img_path, result.data.id);
            } else {
                errorObj.text(result.data.error);
                groupObj.addClass('has-error');
            }
        });
    });
    $('body').append(html);
    $('input[type="file"]', html).trigger('click');
};

$offer.addImage = function(imgPath, imgVal, id) {
    var idStr = id ? '<input type="hidden" name="images['+ $offer.imgIndex +'][id]" value="'+ id +'" />' : '';
    var html =  '<div class="img-thumbnail img-block">'+
                    '<div class="img-item">'+
                        '<img class="uploaded-image" src="'+ imgPath +'" />'+
                    '</div>'+
                    '<input type="hidden" name="images['+ $offer.imgIndex +'][image]" value="'+ imgVal +'" />'+
                    idStr+
                    '<div class="img-tools text-center">'+
                        '<a href="#" class="btn btn-xs btn-danger delete-img"><i class="fa fa-remove"></i></a>'+
                    '</div>'+
                '</div>';
    html = $(html);
    $offer.initImageTools(html);
    $('#images-block').append(html);
    $offer.imgIndex++;
};

$offer.initImageTools = function(html) {
    $('.delete-img', html).on('click', function() {
        html.remove();
        return false;
    });
};

$offer.generateImages = function() {
    if (!$.isEmptyObject($offer.images)) {
        for (var i in $offer.images) {
            var imgPath = '/images/offer/'+$offer.images[i].image;
            $offer.addImage(imgPath, 'same', $offer.images[i].id);
        }
    }
};

$offer.initImageUpload = function() {
    $('#upload-image').on('click', function() {
        $('#iframe-img-uploader').remove();
        $offer.initUploaderForm();
        return false;
    });

    $offer.generateImages();
};

$offer.initEditPage = function() {

    $offer.initForm();

    $offer.initImageUpload();

    CKEDITOR.config.height = 120;
};

$offer.init();

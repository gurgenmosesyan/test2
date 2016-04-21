var $main = {};
$main.contactPage = null;

$main.basePath = function(path) {
    return $main.baseUrl + path;
};

$main.initSlider = function() {
    if ($('#jssor').length <= 0) {
        return;
    }
    var options = {
        $AutoPlay: true,
        $SlideshowOptions: {
            $Class: $JssorSlideshowRunner$,
            $Transitions: [
                {$Duration:1200,$Opacity:2}
            ],
            $TransitionsOrder: 1
        },
        $ArrowNavigatorOptions: {
            $Class: $JssorArrowNavigator$
        },
        $BulletNavigatorOptions: {
            $Class: $JssorBulletNavigator$
        }
    };
    $main.slider = new $JssorSlider$("jssor", options);
};

$main.drawProducts = function(data) {
    var productsBox = $('#products');
    productsBox.html('');
    var html = '';
    for (var i in data) {
        html += '<div class="product fl'+ (i % 3 == 0 ? ' mln' : '') +'">'+
                    '<img src="/images/product/'+ data[i].image +'" alt="'+ data[i].title +'" />'+
                    '<div class="product-title">'+
                        '<p>'+ data[i].title +'</p>'+
                    '</div>'+
                '</div>';
    }
    html += '<div class="cb"></div>';
    productsBox.html(html);
};

$main.getProducts = function(link) {
    $.ajax({
        type: 'post',
        url: $main.basePath('/api/products'),
        data: {
            category_id: link.data('id'),
            _token: $main.token
        },
        dataType: 'json',
        success: function(result) {
            if (result.status == 'OK') {
                $('html, body').animate({
                    scrollTop: link.offset().top - 10
                }, 500);
                $main.drawProducts(result.data);
            }
        }
    });
};

$main.initCategories = function() {
    var catLinks = $('#categories a');
    catLinks.mouseover(function() {
        var item = $(this).parent('li');
        $('.separator', $(this)).addClass('dpn');
        $('.separator', item.next()).addClass('dpn');
    });
    catLinks.mouseout(function() {
        var item = $(this).parent('li');
        $('.separator', $(this)).removeClass('dpn');
        $('.separator', item.next()).removeClass('dpn');
        $main.initCatActive();
    });
    catLinks.on('click', function() {
        var self = $(this);
        if (self.hasClass('active')) {
            return false;
        }
        window.history.pushState({}, '', $main.basePath('/products/'+self.data('alias')));
        var activeLink = $('#categories a.active'),
            item = activeLink.parent('li');
        activeLink.removeClass('active');
        $('.separator', activeLink).removeClass('dpn');
        $('.separator', item.next()).removeClass('dpn');
        self.addClass('active');
        $main.initCatActive();
        $main.getProducts(self);
        return false;
    });
};

$main.initCatActive = function() {
    var activeLink = $('#categories a.active'),
        item = activeLink.parent('li');
    $('.separator', activeLink).addClass('dpn');
    $('.separator', item.next()).addClass('dpn');
};

$main.initMap = function() {
    var myLatLng = {lat: 40.176122, lng: 44.513620};
    $main.map = new google.maps.Map(document.getElementById('map'), {
        zoom: 6,
        styles: [
            {"featureType":"administrative","elementType": "labels.text.fill","stylers": [{"color":"#563702"}]},
            {"featureType":"poi","elementType":"all","stylers":[{"color":"#F2CF9A"},{"visibility":"on"}]},
            {"featureType":"geometry","elementType":"geometry.stroke","stylers":[{"color":"#856436"}]},
            {"featureType":"landscape","elementType":"all","stylers":[{"color":"#FFE2B4"}]},
            {"featureType":"road","elementType":"all","stylers":[{"color":"#E4C392"}]},
            {"featureType":"water","elementType":"all","stylers":[{"color":"#E3BF8B"},{"visibility":"on"}]}
        ],
        center: myLatLng
    });
    new google.maps.Marker({
        position: myLatLng,
        map: $main.map,
        icon : "/images/marker.png"
    });
};

$main.resetForm = function() {
    $('.form-error').text('').closest('.form-group').removeClass('has-error');
};

$main.showErrors = function(errors) {
    for (var i in errors) {
        $('#form-error-'+i).text(errors[i]).closest('.form-group').addClass('has-error');
    }
};

$main.initContactForm = function() {
    $('#contact-form').submit(function() {
        var self = $(this);
        if (self.hasClass('sending')) {
            return false;
        }
        self.addClass('sending');
        $.ajax({
            type: 'post',
            url: self.attr('action'),
            data: self.serializeArray(),
            dataType: 'json',
            success: function(result) {
                $main.resetForm();
                if (result.status == 'OK') {
                    alert('Message successfully sent.');
                } else {
                    $main.showErrors(result.errors);
                }
                self.removeClass('sending');
            }
        });
        return false;
    });
};

$(document).ready(function() {
    $main.initSlider();
    $main.initCategories();
    $main.initCatActive();
    if ($main.contactPage) {
        $main.initMap();
        $main.initContactForm();
    }
});

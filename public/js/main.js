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

});

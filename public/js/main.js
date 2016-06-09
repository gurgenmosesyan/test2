'use strict';

var $trans = function() {
    return $trans.get.apply(arguments);
};
$trans.transMap = null;

$trans.get = function (key, paramData) {
    try {
        if ($trans.transMap  == null) {
            var locSettings = $locSettings || {};
            $trans.transMap = locSettings.trans || {};
        }
        if (typeof $trans.transMap[key] != "undefined") {
            key = $trans.transMap[key];
            if (paramData) {
                for (var i in paramData) {
                    if (paramData.hasOwnProperty(i)) {
                        key = key.replace("{"+i+"}",paramData[i]);
                    }
                }
            }
            return key;
        }
    }
    catch(e){}
    return key;
};

var $main = {};

$main.basePath = function(path) {
    return $main.baseUrl + path;
};

$main.includeGoogleMap = function() {
    var s = document.createElement("script");
    s.type = "text/javascript";
    s.src = "https://maps.googleapis.com/maps/api/js?v=3";
    $("head").append(s);
};

$main.initMap = function() {
    $main.map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        styles: [
            {"featureType":"poi","elementType":"all","stylers":[{"color":"#C9C9C9"},{"visibility":"on"}]},
            {"featureType":"landscape","elementType":"all","stylers":[{"color":"#E6E7E7"}]}
        ],
        center: {lat: 40.531119, lng: 44.703520}
    });
    new google.maps.Marker({
        position: {lat: 40.530749, lng: 44.694859},
        map: $main.map,
        icon : "/images/marker.png"
    });
};

$main.resetForm = function() {
    $('.form-error').text('').closest('.form-box').removeClass('has-error');
};

$main.showErrors = function(errors) {
    for (var i in errors) {
        $('#form-error-'+i).text(errors[i]).closest('.form-box').addClass('has-error');
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
                    alert(result.data);
                } else {
                    $main.showErrors(result.errors);
                }
                self.removeClass('sending');
            }
        });
        return false;
    });
};

$main.initClock = function() {
    function runClock(date) {
        var m = date.getMinutes();
        var minute = (m * 6) + 90;
        var hour = ((date.getHours() % 12 ) * 30) + (m / 2)  + 90;
        $('#hour').css({
            '-webkit-transform': 'rotate(' + hour + 'deg)',
            '-moz-transform': 'rotate(' + hour + 'deg)',
            '-ms-transform': 'rotate(' + hour + 'deg)',
            '-o-transform': 'rotate(' + hour + 'deg)',
            'transform': 'rotate(' + hour + 'deg)'
        });
        $('#minute').css({
            '-webkit-transform': 'rotate(' + minute + 'deg)',
            '-moz-transform': 'rotate(' + minute + 'deg)',
            '-ms-transform': 'rotate(' + minute + 'deg)',
            '-o-transform': 'rotate(' + minute + 'deg)',
            'transform': 'rotate(' + minute + 'deg)'
        });
    }
    var time = $main.time*1000;
    var date = new Date(time);
    runClock(date);
    setInterval(function() {
        time += 15000;
        date = new Date(time);
        runClock(date);
    }, 15000);
};

$main.initTopCalendar = function() {
    var fromObj = $('#from'),
        fromMinDate = fromObj.val(),
        toObj = $('#to'),
        toMinDate = toObj.val();
    fromObj.datepicker({
        defaultDate: '+1w',
        altField: '#from-hidden',
        altFormat: 'yy-mm-dd',
        minDate: fromMinDate,
        dateFormat: 'dd/mm/yy',
        numberOfMonths: 2,
        onClose: function(selectedDate, dateObj) {
            var d = new Date((dateObj.selectedMonth+1)+'/'+dateObj.selectedDay+'/'+dateObj.selectedYear);
            var time = d.getTime() + 86400000;
            d = new Date(time);
            var minDate = d.getDate()+'/'+(parseInt(d.getMonth())+1)+'/'+d.getFullYear();
            $('#to').datepicker('option', 'minDate', minDate);
        }
    });
    toObj.datepicker({
        defaultDate: '+1w',
        altField: '#to-hidden',
        altFormat: 'yy-mm-dd',
        minDate: toMinDate,
        dateFormat: 'dd/mm/yy',
        numberOfMonths: 2
    });
};

$main.animateToContact = function() {
    $('html, body').animate({
        scrollTop: $('#contact').offset().top
    }, 700);
};

$main.initContactLink = function() {
    var hash = document.location.hash.substr(1);
    if (hash == 'contacts') {
        $main.animateToContact();
    }
    $('#contact-link').on('click', function() {
        if ($main.homepage) {
            document.location.hash = 'contacts';
            $main.animateToContact();
            return false;
        }
    });
};

$main.initSlider = function() {
    $('#slider').owlCarousel({
        singleItem: true,
        autoPlay: 5900,
        navigation: true,
        navigationText: ['',''],
        pagination: true,
        paginationSpeed: 1200,
        slideSpeed: 1200,
        rewindSpeed: 2000
    });
};

$main.homeAccCarousel = function() {
    $('#home-acc').owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: ['',''],
        pagination: true,
        slideSpeed: 700,
        itemsCustom: [
            [0, 1],
            [800, 2],
            [1200, 3]
        ]
    });
};

$main.initGuests = function() {
    $('#guests-car').owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: ['',''],
        pagination: true,
        slideSpeed: 700,
        itemsCustom: [
            [0, 1],
            [500, 2],
            [775, 3],
            [1000, 4]
        ]
    });
};

$main.initAccCarousel = function() {
    $('#acc-car').owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: ['',''],
        pagination: true,
        slideSpeed: 700,
        itemsCustom: [
            [0, 1],
            [680, 2],
            [950, 3],
            [1230, 4]
        ]
    });
};

$main.initSubscribe = function() {
    $('.top-menu .subscribe a').on('click', function() {
        var subscribeBtn = $(this).parent('li');
        subscribeBtn.addClass('dpn');
        $('.top-menu .subscribe-box').removeClass('dpn');
        $(document).bind('click', function(e) {
            var clicked = $(e.target);
            if (!clicked.parents().is('#subscribe-form')) {
                $('.top-menu .subscribe-box').addClass('dpn');
                subscribeBtn.removeClass('dpn');
                $(document).unbind('click');
            }
        });
        return false;
    });
    $('#subscribe-form').submit(function() {
        var form = $(this);
        if (form.hasClass('sending')) {
            return false;
        }
        form.addClass('sending');
        $.ajax({
            type: 'post',
            url: form.attr('action'),
            data: form.serializeArray(),
            dataType: 'json',
            success: function(result) {
                if (result.status == 'OK' || result.status == 'EXIST') {
                    $('.subscribe-box').addClass('dpn');
                    $('.top-menu .subscribe').removeClass('dpn');
                    $('#subscribe-form input:text').val('');
                    alert(result.data);
                } else if (result.errors) {
                    alert(result.errors.email);
                } else {
                    alert('Error in subscribing');
                }
                form.removeClass('sending');
            }
        });
        return false;
    });
};

$main.initAccSubMenu = function() {
    $('#acc-top-menu .acc-link').on('click', function() {
        var subMenu = $('#acc-sub-menu');
        subMenu.stop().slideToggle();
        $(document).bind('click', function(e) {
            var clicked = $(e.target);
            if (!clicked.parents().is('#acc-sub-menu')) {
                subMenu.stop().slideToggle();
                $(document).unbind('click');
            }
        });
        return false;
    });
};

$(document).ready(function() {

    $main.initClock();

    $main.initTopCalendar();

    $main.initContactLink();

    $main.initSubscribe();

    $main.initAccSubMenu();
});

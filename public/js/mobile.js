'use strict';

var $mobile = {};

$mobile.initBurger = function() {
    var mobileMenu = $('#nav');
    mobileMenu.appendTo('#header');

    var burger = '<a href="#" id="burger" class="db">'+
                        '<span class="burger1 db"></span>'+
                        '<span class="burger2 db"></span>'+
                        '<span class="burger3 db"></span>'+
                    '</a>';
    burger = $(burger);

    burger.on('click', function() {
        $(this).toggleClass('open');
        mobileMenu.stop().slideToggle();
        return false;
    });
    $('#header').prepend(burger);
};

$mobile.lngSwitcher = function() {
    var languages = $('#lng-switcher');
    var html =  '<div id="m-lng-switcher">'+
                    '<div class="top-switcher">'+ $('.active a', languages).text() +'</div>'+
                    '<div class="bottom-switcher dpn">';
    $('li', languages).each(function() {
        var self = $(this);
        if (!self.hasClass('active') && !self.hasClass('cb')) {
            var link = self.find('a');
            html += '<a href="'+ link.attr('href') +'">'+ link.text() +'</a>';
        }
    });
    html += '</div></div>';
    html = $(html);
    $('.top-switcher', html).on('click', function() {
        if ($('.bottom-switcher', html).is(':visible')) {
            $('.bottom-switcher', html).stop().slideUp();
            $(document).unbind('click');
        } else {
            $('.bottom-switcher', html).stop().slideDown();
            $(document).bind('click', function(e) {
                var clicked = $(e.target);
                if (!clicked.parents().is('#m-lng-switcher')) {
                    $('.bottom-switcher', html).slideToggle();
                    $(document).unbind('click');
                }
            });
        }
    });
    $('#header').prepend(html);
};

$mobile.init = function() {
    $mobile.initBurger();

    $('#bg-block').prepend('<div class="booking"><div><a href="#" class="btn">Book now</a></div></div>').prepend('<div class="bg-overlay"></div>');

    $mobile.lngSwitcher();

    $('#contact').prepend($('#contact-form-block h2'));

    var homeAbout = $('#homepage-about'),
        homeOffers = $('#homepage-offers');
    homeAbout.prepend(homeAbout.find('h2'));
    homeOffers.find('.title').after(homeOffers.find('.img-section'));

    setTimeout(function() {
        if ($main.map) {
            $main.map.setOptions({draggable: false});
        }
    }, 1000);
};

$(document).ready(function() {
    $mobile.init();
});

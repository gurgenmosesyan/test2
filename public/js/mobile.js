'use strict';

var $mobile = {};
$mobile.mobileMode = false;

$mobile.initNav = function() {
    var mobileNav = '<a href="#" id="mobile-nav" class="db">'+
                        '<span class="db"></span>'+
                        '<span class="db"></span>'+
                        '<span class="db"></span>'+
                    '</a>';
    mobileNav = $(mobileNav);

    var mobileMenu = '<ul id="mobile-menu" class="dpn">'+
                        '<li><a href="'+ $main.basePath('/') +'">'+ $trans.get('www.menu.about') +'</a></li>'+
                        '<li><a href="'+ $main.basePath('/products') +'">'+ $trans.get('www.menu.products') +'</a></li>'+
                        '<li><a href="'+ $main.basePath('/partners') +'">'+ $trans.get('www.menu.partners') +'</a></li>'+
                        '<li class="last"><a href="'+ $main.basePath('/contact') +'">'+ $trans.get('www.menu.contact') +'</a></li>'+
                     '</ul>';
    mobileMenu = $(mobileMenu);

    $('#header').append(mobileNav).append(mobileMenu);

    mobileNav.on('click', function() {
        $(this).toggleClass('open');
        if (mobileMenu.is(':visible')) {
            mobileMenu.slideUp(300);
        } else {
            mobileMenu.slideDown(300);
        }
        return false;
    });
};

$mobile.initFooter = function() {
    $('#footer-main').appendTo($('#footer-inner'));
};

$mobile.initSlider = function() {
    function ScaleSlider() {
        var refSize = $main.slider.$Elmt.parentNode.clientWidth;
        if (refSize) {
            refSize = Math.min(refSize, 1200);
            $main.slider.$ScaleWidth(refSize);
        }
        else {
            window.setTimeout(ScaleSlider, 30);
        }
    }
    ScaleSlider();
    $(window).bind("load", ScaleSlider);
    $(window).bind("resize", ScaleSlider);
    $(window).bind("orientationchange", ScaleSlider);
};

$mobile.initCategories = function(categoriesBox) {
    var pathname = document.location.pathname;
    if (pathname != '/products') {
        $('html, body').animate({
            scrollTop: categoriesBox.offset().top - 420
        }, 500);
    }
    var leftArrow = $('<a href="#" class="cat-arrow cat-left"></a>'),
        rightArrow = $('<a href="#" class="cat-arrow cat-right"></a>');
    leftArrow.on('click', function() {
        var cLink = categoriesBox.find('a.active'),
            prevLink = cLink.parent('li').prev('li').find('a');
        if (prevLink.length == 0) {
            return false;
        }
        document.location.href = $main.basePath('/products/'+prevLink.data('alias'));
        return false;
    });
    rightArrow.on('click', function() {
        var cLink = categoriesBox.find('a.active'),
            nextLink = cLink.parent('li').next('li').find('a');
        if (nextLink.length == 0) {
            return false;
        }
        document.location.href = $main.basePath('/products/'+nextLink.data('alias'));
        return false;
    });
    categoriesBox.append(leftArrow).append(rightArrow);
};

$mobile.initPartner = function() {
    $('#partners .partner:odd').addClass('odd');
    $('#partners .partner-box').on('click', function() {
        var self = $(this);
        var title = self.find('.title').text(),
            text = self.find('.sub-title').text(),
            link, html;
        link = self.attr('href') ? '<p class="link"><a href="'+self.attr('href')+'" target="_blank">Link</a></p>' : '';
        html =  '<div id="partner-overlay">'+
                    '<div class="partner-mobile">'+
                        '<a href="#" class="close"></a>'+
                        '<div class="partner-mobile-info">'+
                            '<h3>'+title+'</h3>'+
                            '<p>'+text+'</p>'+
                            link+
                        '</div>'+
                    '</div>'+
                '</div>';
        html = $(html);
        html.find('.close').on('click', function() {
            $('#header, #content, #footer').removeClass('filter-alpha');
            html.remove();
            return false;
        });
        $('#header, #content, #footer').addClass('filter-alpha');
        $('body').append(html);
        return false;
    });
};

$mobile.init = function() {

    //$('#page').addClass('mobile');

    //$('#contact-form-block').insertBefore('#contact');
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

/*$mobile.reset = function() {
    $('#page').removeClass('mobile');
};*/

/*$mobile.resizing = function(width) {
    if (width < 705) {
        if (!$mobile.mobileMode) {
            $mobile.init();
            $mobile.mobileMode = true;
        }
    } else if ($mobile.mobileMode) {
        $mobile.reset();
        $mobile.mobileMode = false;
    }
};*/

$(document).ready(function() {

    $mobile.init();

    /*$mobile.resizing(window.innerWidth || screen.availWidth);
    $(window).resize(function() {
        $mobile.resizing(this.innerWidth || screen.availWidth);
    });*/

    /*$mobile.initNav();
    $mobile.initFooter();
    var categoriesBox = $('#categories');
    if (categoriesBox.length > 0) {
        $mobile.initCategories(categoriesBox);
    }
    if ($main.slider) {
        $mobile.initSlider();
    }
    if ($main.map) {
        $main.map.setOptions({draggable: false});
    }
    $mobile.initPartner();*/
});

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

var $mobile = {};

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

$(document).ready(function() {
    $mobile.initNav();
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
    $mobile.initPartner();
});

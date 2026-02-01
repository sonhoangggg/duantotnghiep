/* Template Name: Adminox - Bootstrap 4 Landing Page Tamplate
   Author: Techzaa
   File Description: Main JS file of the template
*/


! function($) {
    "use strict";

    var Flacto = function() {};

    Flacto.prototype.initSmoothLink = function() {
        $('.navbar-nav a').on('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top - 50
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        });
    },

    Flacto.prototype.initScrollspy = function() {
        $("#navbarCollapse").scrollspy({
            offset: 50
        });
    },

    Flacto.prototype.initBacktoTop = function() {
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.back-to-top').fadeIn();
            } else {
                $('.back-to-top').fadeOut();
            }
        }); 
        $('.back-to-top').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 1000);
            return false;
        });
    },


    Flacto.prototype.init = function() {
        this.initStickyMenu();
        this.initSmoothLink();
        this.initScrollspy();
        this.initContact();
        this.initBacktoTop();
    },
    //init
    $.Flacto = new Flacto, $.Flacto.Constructor = Flacto
}(window.jQuery),

//initializing
function($) {
    "use strict";
    $.Flacto.init();
}(window.jQuery);
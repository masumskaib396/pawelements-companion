(function ($) {

"use strict";


 // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/pawelem_accordion.default',function($scope, $){
           
          
            $('#tpw-accordion').on('show.bs.collapse', function(e) {
                var closest = e.target.closest('.card');
                $(closest).addClass('card__active').siblings().removeClass('card__active');
            })

        });

    });

})(jQuery);
(function ($) {

"use strict";

var ExeCourseHandler = function ($scope, $) {
  var postwrapper = $scope.find(".exeter-three-column-slider");
  if( postwrapper.length === 0 )
    return;
  var settings = postwrapper.data('settings');
/*--------------------------------------------------------------
EXETER THEREE COLUMN SLIDER JS
--------------------------------------------------------------*/
var postwrapper = $('.exeter-three-column-slider');
  if (postwrapper.is_exist()) {
      postwrapper.owlCarousel({
      loop:settings['loop'],
      margin:30,
      nav:settings['nav'],
      dots:false,
      mouseDrag:false,
      autoplay: settings['autoplay'],
      autoplayTimeout: settings['autoplaytimeout'],
      navContainerClass: 'owl-nav flat-nav',
      items:settings['course_per_coulmn'],
      navText: ["<i class=\"ti-angle-right\"></i>",
        "<i class=\"ti-angle-left\"></i>"],
      responsive:{
            0:{
                items: settings['course_per_coulmn_mobile'],
                mouseDrag:true,
                dots:settings['dots'],
            },
            768:{
                items: settings['course_per_coulmn_tablet'],
                mouseDrag:false,
                dots:settings['dots'],
            },
            1025:{
                items:settings['course_per_coulmn'],
                mouseDrag:false,
                dots:settings['dots'],
            }
        }
  });

}


}

 // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/exe_course.default', ExeCourseHandler);

    });

})(jQuery);


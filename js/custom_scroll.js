jQuery(document).ready(function($) {
'use strict';	
	$(window).scroll(jQuery.throttle( 250, function() {
		if($('.sidebar').length > 0){
			var sheight = $('.sidebar').height();
			var theight = $('.sidebar').offset();
			var swidth = $('.sidebar').width();
			var tthis = $('.sidebar .stickyscroll_widget').first().height();
		}else{
			var sheight = $('.elementor-widget-sidebar').height();
			var theight = $('.elementor-widget-sidebar').offset();
			var swidth = $('.elementor-widget-sidebar').width();
			var tthis = $('.elementor-widget-sidebar .stickyscroll_widget').first().height();			
		}
		var hbot = $('.rh-content-wrap').offset();
		var hfoot = $('.rh-content-wrap').height();

		if ($(this).scrollTop()>sheight + theight.top) $('.sidebar .stickyscroll_widget').first().css({'position':'fixed','top':'90px', 'width': swidth}).addClass('scrollsticky');
		else $('.sidebar .stickyscroll_widget').first().css({'position':'static', 'width':'auto','top':'0'}).removeClass('scrollsticky');
		if ($(this).scrollTop()>hfoot + hbot.top - tthis ) $('.sidebar .stickyscroll_widget').first().css({'position':'static', 'width':'auto','top':'0'}).removeClass('scrollsticky');
	}));
});
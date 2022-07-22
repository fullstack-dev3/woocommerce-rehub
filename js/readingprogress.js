jQuery(document).ready(function($) {
'use strict';	
    $('body').prepend('<progress value=\"0\" class=\"rh-progress-bar\"></progress>');

    var winHeight = $(window).height(), 
        docHeight = $('.post-inner').height(),
        progressBar = $('progress'),
        max, value;

        max = docHeight - winHeight;
        progressBar.attr('max', max);
    $(window).scroll(function(){
        value = $(window).scrollTop();
        progressBar.attr('value', value);
    });
});

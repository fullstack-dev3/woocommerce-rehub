(function($) {
   'use strict';
    function multiParallax() {       
        //Element parallax
        if($('.rh-parallaxel-true').length > 0){
            var $winHeight  = $( window ).height();
            $('.elementor-section').each(function() {
                var $position   = $(this).offset().top - $(document).scrollTop();

                if ( $winHeight >= $position ) {
                    var $layers     = $(this).find('.rh-parallaxel-true');

                     $($layers).each(function() {
                        var $parent     = $(this).parent();
                        var $curPos     = $($parent).offset().top - $(document).scrollTop();
                        var $depth = $(this).data('parallax-speed');
                        var $depth = parseInt($depth)/100;
                        if($(this).data('parallax-dir')){
                            var $movement   = - $curPos * $depth;
                        }else{
                            var $movement   = $curPos * $depth;
                        }
                        var $translate  = 'translate3d(0, ' + $movement + 'px, 0)';

                        $(this).css({
                            "-webkit-transform" : $translate,   
                            "-moz-transform"    : $translate,
                            "-ms-transform"     : $translate,
                            "-o-transform"      : $translate,
                            "transform"         : $translate
                        });
                        $(this).addClass('parallaxloaded');
                    });
                }
            });
        }
        //BG parallax
        if($('.rh-parallax-bg-true').length > 0){
            var scrollTop = $(window).scrollTop();
            $('.rh-parallax-bg-true').each(function() {
                var paralasicValue = $(this).prop('class').match(/rh-parallax-bg-speed-([0-9]+)/)[1];
                var paralasicValue = parseInt(paralasicValue)/100;
                var backgroundPos = $(this).css('backgroundPosition').split(" ");
                if (backgroundPos[0] == '100%'){
                    var bgx = 'right';
                }
                else if (backgroundPos[0] == '50%'){
                    var bgx = 'center';
                }
                else if (backgroundPos[0] == '0%'){
                    var bgx = 'left';
                }else{
                    var bgx = backgroundPos[0];
                } 
                if (backgroundPos[1] == '0%'){
                    var bgy = 'top';
                }
                else if (backgroundPos[1] == '50%'){
                    var bgy = 'center';
                }
                else if (backgroundPos[1] == '100%'){
                    var bgy = 'bottom';
                } 
                else{
                    var bgy = backgroundPos[1];
                }                                                              
                $(this).css('background-position', ''+bgx+' '+bgy+' -' + scrollTop * paralasicValue + 'px');
            }); 
        }       
    }   
    $(window).on('load scroll', function() {
        multiParallax();
    }); 
})(jQuery);
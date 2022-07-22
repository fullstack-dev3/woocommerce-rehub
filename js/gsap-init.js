jQuery(document).ready(function($) {
   'use strict';	
    //GSAP 
    if($('.rh-gsap-wrap').length > 0){
        var rhscroller = new ScrollMagic.Controller();
        $('.rh-gsap-wrap').each(function(){

            var scrollargs = {};
            var anargs = {};
            var current = $(this);
            if(current.hasClass('prehidden')){
                current.removeClass('prehidden');
            }

            var $duration = current.data('duration');
            var $duration = parseFloat($duration);
            anargs.duration = $duration;

            if(current.data('x')){
                anargs.x = current.data('x');
            }

            if(current.data('y')){
                anargs.y = current.data('y');
            }

            if(current.data('xo')){
                anargs.xPercent = current.data('xo');
            }

            if(current.data('yo')){
                anargs.yPercent = current.data('yo');
            }

            if(current.data('width')){
                anargs.width = current.data('width');
            }

            if(current.data('height')){
                anargs.height = current.data('height');
            }

            if(current.data('r')){
                anargs.rotation = current.data('r');
            }

            if(current.data('rx')){
                anargs.rotationX = current.data('rx');
            }

            if(current.data('ry')){
                anargs.rotationY = current.data('ry');
            }

            if(current.data('s')){
                anargs.scale = current.data('s');
            }

            if(current.data('sx')){
                anargs.scaleX = current.data('sx');
            }

            if(current.data('sy')){
                anargs.scaleY = current.data('sy');
            }

            if(current.data('o')){
                anargs.opacity = parseInt(current.data('o'))/100;
            }
            if(current.data('bg')){
                anargs.backgroundColor = current.data('bg');
            }
            if(current.data('origin')){
                anargs.transformOrigin = current.data('origin');
            }

            if(current.data('loop')=='yes'){
                if(current.data('yoyo')=='yes'){
                    anargs.yoyo = true;
                }
                anargs.repeat = -1;
                if(current.data('delay')){
                    anargs.repeatDelay = current.data('delay');
                }
                
            }
            if(current.data('path')){
                anargs.motionPath = {
                    path: current.data('path'),
                    immediateRender: true
                }
                if(current.data('path-align')){
                    anargs.motionPath.align = current.data('path-align');
                }
                if(current.data('path-orient')){
                    anargs.motionPath.autoRotate = true;
                }

            }
            if(current.data('delay')){
                anargs.delay = current.data('delay');
            }

            if(current.data('ease')){
                var $ease = current.data('ease').split('-');
                anargs.ease = $ease[0]+'.'+$ease[1];
                if(anargs.ease === 'power0.none'){           
                    anargs.ease = 'none';
                }
            }

            if(current.data('stagger')){
                var $anobj = '.'+current.data('stagger');
            }else if(current.data('text')){
                var $texttype = current.data('text');
                var splittextobj = current.children();
                var split = new SplitText(splittextobj, {type: $texttype});
                if($texttype == 'chars'){
                    var $anobj = split.chars;
                }else if($texttype == 'words'){
                    var $anobj = split.words;
                }else{
                    var $anobj = split.lines;
                }
            }else if(current.data('svgdraw')){
                var svgarray = [];
                var shapes = ['path', 'line', 'polyline', 'polygon', 'rect', 'ellipse', 'circle'];
                for (var shape in shapes){
                    if($(this).find(shapes[shape]).length > 0){
                        svgarray.push($(this).find(shapes[shape]));
                    }
                }
                $anobj = svgarray;
                if(current.data('from')=='yes'){
                    anargs.drawSVG = "0%";
                }else{
                    anargs.drawSVG = "100%";
                }
                if(current.data('bg')){
                    anargs.stroke = current.data('bg');
                }
                
            }else if(current.data('video')){
                if($(this).find('video').length > 0){
                    var $videoobj = $(this).find('video');
                    $videoobj[0].pause();
                    anargs.currentTime = current.data('video');
                    $anobj = $videoobj;

                }else{
                    $anobj = current;
                }
            }
            else{
                $anobj = current;
            }

            if(current.data('stagger') || current.data('text') || current.data('svgdraw')){
                if(current.data('stdelay')){
                    anargs.stagger = current.data('stdelay');
                }else{
                    anargs.stagger = 0.2;
                }

            }

            if(current.data('from')=='yes'){
                var animation = gsap.from($anobj, anargs);
            }else{
                var animation = gsap.to($anobj, anargs);
            }
            
            if(current.data('customtrigger')){
                var customtrigger = '#'+current.data('customtrigger');               
            }else{
                var customtrigger = $(this).closest('.elementor-widget');
            }
            scrollargs.triggerElement = customtrigger;

            if(current.data('triggerheight')){
                var $hookpos = parseInt(current.data('triggerheight'))/100;
                scrollargs.triggerHook = $hookpos;
            }else{
                scrollargs.triggerHook = 0.85;
            }

            if(current.data('scrollduration')){
                var $hookdur = current.data('scrollduration');
                scrollargs.duration = $hookdur;
            }   

            var scene = new ScrollMagic.Scene(scrollargs).setTween(animation).addTo(rhscroller);
            if(current.data('pin') && current.data('scrollduration')){
                var pin = '#'+current.data('pin'); 
                scene.setPin(pin);             
            }
            if(current.data('rev')){
                scene.reverse(false);
            } 
        });
    }

    //reveal
    if($('.rh-reveal-wrap').length > 0){
        $('.rh-reveal-wrap').each(function(){
            var tl = gsap.timeline({paused: true}); 
            var revealwrap = $(this); 
            var revealcover = $(this).find(".rh-reveal-block");
            var revealcontent = $(this).find(".rh-reveal-cont"); 
            revealwrap.removeClass('rhhidden');
            if(revealcover.data('reveal-speed')){
                var $coverspeed = revealcover.data('reveal-speed');
            }else{
                var $coverspeed = 0.5;
            } 
            if(revealcover.data('reveal-delay')){
                var $coverdelay = revealcover.data('reveal-delay');
            }else{
                var $coverdelay = 0;
            }  
            $(this).find('img.lazyimages').each(function(){
                var source = $(this).attr("data-src");
                $(this).attr("src", source).css({'opacity': '1'});
            });            
            if(revealcover.data('reveal-dir')=='lr'){
                tl.from(revealcover,{ duration:$coverspeed, scaleX: 0, transformOrigin: "left", delay: $coverdelay  });
                tl.to(revealcover,{ duration:$coverspeed, scaleX: 0, transformOrigin: "right" }, "reveal");
            }else if(revealcover.data('reveal-dir')=='rl'){
                tl.from(revealcover,{ duration:$coverspeed, scaleX: 0, transformOrigin: "right", delay: $coverdelay });
                tl.to(revealcover,{ duration:$coverspeed, scaleX: 0, transformOrigin: "left" }, "reveal");
            }
            else if(revealcover.data('reveal-dir')=='tb'){
                tl.from(revealcover,{ duration:$coverspeed, scaleY: 0, transformOrigin: "top", delay: $coverdelay });
                tl.to(revealcover,{ duration:$coverspeed, scaleY: 0, transformOrigin: "bottom" }, "reveal");
            }
            else if(revealcover.data('reveal-dir')=='bt'){
                tl.from(revealcover,{ duration:$coverspeed, scaleY: 0, transformOrigin: "bottom", delay: $coverdelay });
                tl.to(revealcover,{ duration:$coverspeed, scaleY: 0, transformOrigin: "top" }, "reveal");
            }
            tl.from(revealcontent,{ duration:1, opacity: 0 }, "reveal"); 
            revealwrap.elementorWaypoint(function(direction) {
                tl.play();
            }, { offset: 'bottom-in-view' });          
        });
    }

    //mouse move
    if($('.rh-prlx-mouse').length > 0){
        $('#content').mousemove(function(event){

            var xPos = (event.clientX/$('#content').width())-0.5,
               yPos = (event.clientY/$('#content').height())-0.5;
          
            $(".rh-prlx-mouse").each(function(index, element){

                var mouseargs = {};
                var curmouse = $(this);

                if(curmouse.data('prlx-xy')){
                    var $speedx = curmouse.data('prlx-xy');
                    mouseargs.x = xPos * $speedx;
                    mouseargs.y = yPos * $speedx;
                }

                if(curmouse.data('prlx-tilt')){
                    var $speedtilt = curmouse.data('prlx-tilt');
                    mouseargs.rotationY = xPos * $speedtilt;
                    mouseargs.rotationX = yPos * $speedtilt;
                }

                mouseargs.ease = Power1.easeOut;            

                gsap.to(curmouse, mouseargs);
            });  
        });
    }

});
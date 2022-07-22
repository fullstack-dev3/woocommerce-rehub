/* jQuery Countdown plugin v1.0 Copyright 2010, Vassilis Dourdounis */
!function(a){a.fn.countDown=function(t){return config={},a.extend(config,t),diffSecs=this.setCountDown(config),config.onComplete&&a.data(a(this)[0],"callback",config.onComplete),config.omitWeeks&&a.data(a(this)[0],"omitWeeks",config.omitWeeks),a("#"+a(this).attr("id")+" .digit").html('<div class="top"></div><div class="bottom"></div>'),a(this).doCountDown(a(this).attr("id"),diffSecs,500),this},a.fn.stopCountDown=function(){clearTimeout(a.data(this[0],"timer"))},a.fn.startCountDown=function(){this.doCountDown(a(this).attr("id"),a.data(this[0],"diffSecs"),500)},a.fn.setCountDown=function(t){var e=new Date;t.targetDate?e=new Date(t.targetDate.month+"/"+t.targetDate.day+"/"+t.targetDate.year+" "+t.targetDate.hour+":"+t.targetDate.min+":"+t.targetDate.sec+(t.targetDate.utc?" UTC":"")):t.targetOffset&&(e.setFullYear(t.targetOffset.year+e.getFullYear()),e.setMonth(t.targetOffset.month+e.getMonth()),e.setDate(t.targetOffset.day+e.getDate()),e.setHours(t.targetOffset.hour+e.getHours()),e.setMinutes(t.targetOffset.min+e.getMinutes()),e.setSeconds(t.targetOffset.sec+e.getSeconds()));var s=new Date;return diffSecs=Math.floor((e.valueOf()-s.valueOf())/1e3),a.data(this[0],"diffSecs",diffSecs),diffSecs},a.fn.doCountDown=function(s,i,o){$this=a("#"+s),i<=0&&(i=0,a.data($this[0],"timer")&&clearTimeout(a.data($this[0],"timer"))),secs=i%60,mins=Math.floor(i/60)%60,hours=Math.floor(i/60/60)%24,1==a.data($this[0],"omitWeeks")?(days=Math.floor(i/60/60/24),weeks=Math.floor(i/60/60/24/7)):(days=Math.floor(i/60/60/24)%7,weeks=Math.floor(i/60/60/24/7)),$this.dashChangeTo(s,"seconds_dash",secs,o||800),$this.dashChangeTo(s,"minutes_dash",mins,o||1200),$this.dashChangeTo(s,"hours_dash",hours,o||1200),$this.dashChangeTo(s,"days_dash",days,o||1200),$this.dashChangeTo(s,"weeks_dash",weeks,o||1200),a.data($this[0],"diffSecs",i),i>0?(e=$this,t=setTimeout(function(){e.doCountDown(s,i-1)},1e3),a.data(e[0],"timer",t)):(cb=a.data($this[0],"callback"))&&a.data($this[0],"callback")()},a.fn.dashChangeTo=function(t,e,s,i){$this=a("#"+t);for(var o=$this.find("."+e+" .digit").length-1;o>=0;o--){var n=s%10;s=(s-n)/10,$this.digitChangeTo("#"+$this.attr("id")+" ."+e+" .digit:eq("+o+")",n,i)}},a.fn.digitChangeTo=function(t,e,s){s||(s=800),a(t+" div.top").html()!=e+""&&(a(t+" div.top").css({display:"none"}),a(t+" div.top").html(e||"0").slideDown(s),a(t+" div.bottom").animate({height:""},s,function(){a(t+" div.bottom").html(a(t+" div.top").html()),a(t+" div.bottom").css({display:"block",height:""}),a(t+" div.top").hide().slideUp(10)}))}}(jQuery);
!function(e,i){"object"==typeof exports&&"undefined"!=typeof module?i(exports):"function"==typeof define&&define.amd?define(["exports"],i):i((e=e||self).window=e.window||{})}(this,function(e){"use strict";function g(){return i||"undefined"!=typeof window&&(i=window.gsap)&&i.registerPlugin&&i}function j(e,i,t){t=!!t,e.visible!==t&&(e.visible=t,e.traverse(function(e){return e.visible=t}))}function k(e){return("string"==typeof e&&"="===e.charAt(1)?e.substr(0,2)+parseFloat(e.substr(2)):e)*t}function l(e){(i=e||g())&&(d=i.core.PropTween,f=1)}var i,f,d,u={x:"position",y:"position",z:"position"},t=Math.PI/180;"position,scale,rotation".split(",").forEach(function(e){return u[e+"X"]=u[e+"Y"]=u[e+"Z"]=e});var n={version:"3.0.0",name:"three",register:l,init:function init(e,i){var t,n,o,r,s,a;for(r in f||l(),i){if(t=u[r],o=i[r],t)n=~(s=r.charAt(r.length-1).toLowerCase()).indexOf("x")?"x":~s.indexOf("z")?"z":"y",this.add(e[t],n,e[t][n],~r.indexOf("rotation")?k(o):o);else if("scale"===r)this.add(e[r],"x",e[r].x,o),this.add(e[r],"y",e[r].y,o),this.add(e[r],"z",e[r].z,o);else if("opacity"===r)for(s=(a=e.material.length?e.material:[e.material]).length;-1<--s;)a[s].transparent=!0,this.add(a[s],r,a[s][r],o);else"visible"===r?e.visible!==o&&(this._pt=new d(this._pt,e,r,o?0:1,o?1:-1,0,0,j)):this.add(e,r,e[r],o);this._props.push(r)}}};g()&&i.registerPlugin(n),e.ThreePlugin=n,e.default=n;if (typeof(window)==="undefined"||window!==e){Object.defineProperty(e,"__esModule",{value:!0})} else {delete e.default}});
var rhscroller = new ScrollMagic.Controller();

(function($) {
    "use strict";

    function multiParallax() {
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

    var RehubWidgetsScripts = function( $scope, $ ) {

        var canSlide = true;

        // Setup a callback for the YouTube api to attach video event handlers
        window.onYouTubeIframeAPIReady = function(){
          // Iterate through all videos
          jQuery('.gallery_top_slider iframe').each(function(){
             var slider = jQuery('.gallery_top_slider');
             // Create a new player pointer; "this" is a DOMElement of the player's iframe
             var player = new YT.Player(this, {
                playerVars: {
                   autoplay: 0
                }
             });

             // Watch for changes on the player
             player.addEventListener("onStateChange", function(state){
                switch(state.data)
                {
                   // If the user is playing a video, stop the slider
                   case YT.PlayerState.PLAYING:
                      slider.flexslider("stop");
                      canSlide = false;
                      break;
                   // The video is no longer player, give the go-ahead to start the slider back up
                   case YT.PlayerState.ENDED:
                   case YT.PlayerState.PAUSED:
                      slider.flexslider("play");
                      canSlide = true;
                      break;
                }
             });

             jQuery(this).data('player', player);
          });
        }

        //SLIDER
        jQuery('.gallery_top_slider').each(function() {
            var tag = document.createElement('script');
                tag.src = "//www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
                firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
            var slider = jQuery(this);
            slider.flexslider({
                animation: "fade",
                controlNav: "thumbnails",
                slideshow: false,
                video: true,
                //useCSS: false,
                before: function(){
                   if(!canSlide)
                      slider.flexslider("stop");
                },
                start: function(slider) {
                   slider.find('img.lazyimages').trigger("unveil");
                   slider.removeClass('loading');
                   jQuery('.flex-control-thumbs img').each(function() {
                      var widththumb = jQuery(this).width();
                      jQuery(this).height(widththumb);
                   });
                }
            });
            slider.on("click", ".flex-prev, .flex-next, .flex-control-nav", function(){
                canSlide = true;
                jQuery('.gallery_top_slider iframe').each(function(){
                   jQuery(this).data('player').pauseVideo();
                });
                if (jQuery('.gallery_top_slider .flex-active-slide iframe').length > 0) {
                   jQuery('.gallery_top_slider .flex-active-slide iframe').data('player').playVideo();
                }
            });
            jQuery(".play3").fitVids();
        });

        jQuery(".re_carousel").each(function(){
          var owl = jQuery(this);
          owl.on('initialized.owl.carousel', function(e) {
            owl.parent().removeClass('loading');
            owl.find('img.lazyimages').trigger("unveil");
          });
          var carouselplay = (owl.data('auto')==1) ? true : false;
          var showrow = (owl.data('showrow') !='') ? owl.data('showrow') : 4;
          var laizy = (owl.data('laizy') == 1) ? true : false;
          var navdisable = (owl.data('navdisable') == 1) ? false : true;
          var loopdisable = (owl.data('loopdisable') == 1) ? false : true;
          var rtltrue = (jQuery('body').hasClass('rtl')) ? true : false;
          if (owl.data('fullrow') == 1) {
             var breakpoint = {
                0:{
                   items:1,
                   nav:true,
                },
                530:{
                   items:2,
                },
                730:{
                   items:3,
                },
                1024:{
                   items:4,
                },                        
                1224:{
                   items:showrow,
                }
             }
          }
          else if (owl.data('fullrow') == 2) {
             var breakpoint = {
                0:{
                   items:1,
                   nav:true,
                },
                768:{
                   items:2,
                },
                1120:{
                   items:3,
                },                        
                1224:{
                   items:showrow,
                }
             }
          } 
          else if (owl.data('fullrow') == 3) {
             var breakpoint = {
                0:{
                   items:1,
                   nav:true,
                },
                768:{
                   items:1,
                },
                1120:{
                   items:1,
                },                        
                1224:{
                   items:showrow,
                }
             }
          }            
          else {
             var breakpoint = {
                0:{
                   items:1,
                   nav:true,
                },
                510:{
                   items:2,
                },
                600:{
                   items:3,
                },            
                1024:{
                   items:showrow,
                }
             }
          }         

          owl.owlCarousel({
            rtl:rtltrue,
             loop:loopdisable,
             dots:false,
             nav: navdisable,
             lazyLoad: laizy,
             autoplay: carouselplay,
             responsiveClass:true,
             navText :["", ""],
             navClass: ["controls prev","controls next"],
             responsive: breakpoint,
             autoplayTimeout : 8000,
             autoplayHoverPause : true,
             autoplaySpeed : 1000,
             navSpeed : 800
          }); 

          var customnext = owl.closest('.custom-nav-car').find('.cus-car-next');
          if(customnext){
            customnext.click(function(){
            owl.trigger('next.owl.carousel', [800]);
          });
          }
          var customprev = owl.closest('.custom-nav-car').find('.cus-car-prev');
          if(customprev){
            customprev.click(function(){
            owl.trigger('prev.owl.carousel', [800]);
          });
          }      

        });

        $('.main_slider').each(function() {
         var slider = $(this);
         slider.flexslider({
            animation: "slide",
            start: function(slider) {
               slider.removeClass('loading');
            }
         });
        });

        $('.wpsm-bar').each(function(){
            $(this).find('.wpsm-bar-bar').animate({ width: $(this).attr('data-percent') }, 1500 );
        }); 

        $('.rate-bar').each(function(){
            $(this).find('.rate-bar-bar').css("width", $(this).attr('data-percent'));
        });                

        $('.rtl .main_slider').each(function() {
           var slider = $(this);
           slider.flexslider({
              animation: "slide",
              rtl: true,
              start: function(slider) {
                 slider.removeClass('loading');
              }
           });
        }); 

        $(".countdown_dashboard").each(function(){
            $(this).show();
            var id = $(this).attr("id");
            var day = $(this).attr("data-day");
            var month = $(this).attr("data-month");
            var year = $(this).attr("data-year");
            var hour = $(this).attr("data-hour");
            var min = $(this).attr("data-min");
            $(this).countDown({
                targetDate: {
                    "day":      day,
                    "month":    month,
                    "year":     year,
                    "hour":     hour,
                    "min":      min,
                    "sec":      0
                },
                omitWeeks: true,
                onComplete: function() { $("#"+ id).hide() }
            });            
        });

        if ($('.wpsm-tooltip').length > 0) {
            $(".wpsm-tooltip").tipsy({gravity: "s", fade: true, html: true });
        }        

        $('.tabs-menu').on('click', 'li:not(.current)', function() {
            var tabcontainer = $(this).closest('.tabs');
            if(tabcontainer.length == 0) {
                var tabcontainer = $(this).closest('.elementor-widget-wrap');
            }
            $(this).addClass('current').siblings().removeClass('current');
            tabcontainer.find('.tabs-item').hide().removeClass('stuckMoveDownOpacity').eq($(this).index()).show().addClass('stuckMoveDownOpacity');
            tabcontainer.find('img.lazyimages').each(function(){
                var source = $(this).attr("data-src");
                $(this).attr("src", source).css({'opacity': '1'});
            });    
        });        

        $('.radial-progress').each(function(){
          $(this).find('.circle .mask.full, .circle .fill:not(.fix)').animate({  borderSpacing: $(this).attr('data-rating')*18 }, {
              step: function(now,fx) {
                $(this).css('-webkit-transform','rotate('+now+'deg)'); 
                $(this).css('-moz-transform','rotate('+now+'deg)');
                $(this).css('transform','rotate('+now+'deg)');
              },
              duration:'slow'
          },'linear');

          $(this).find('.circle .fill.fix').animate({  borderSpacing: $(this).attr('data-rating')*36 }, {
              step: function(now,fx) {
                $(this).css('-webkit-transform','rotate('+now+'deg)'); 
                $(this).css('-moz-transform','rotate('+now+'deg)');
                $(this).css('transform','rotate('+now+'deg)');
              },
              duration:'slow'
          },'linear');                     
        });

        $('img.lazyimages').unveil(40, function() {
            $(this).on('load', function(){
                this.style.opacity = 1;
            });
        }); 

        if($scope.find('.swiper-slide').length > 0){
            var link = $scope.find(".swiper-slide a").first().attr('href');
            if (typeof link !== 'undefined' && link !== null) {
                var links = link.split(';');
                var elements = $scope.find(".swiper-slide:not(.swiper-slide-duplicate)");
                for (var i = elements.length - 1; i >= 0; i--) {
                    if (typeof links[i] !== 'undefined' && links[i] !== null) {
                        $scope.find("[data-elementor-lightbox-index='" + i + "']").attr('href',links[i]);
                    } 
                }
            }
        }

        //GSAP
        if($scope.find('.rh-gsap-wrap').length > 0){

            var scrollargs = {};
            var anargs = {};
            var current = $scope.find('.rh-gsap-wrap');

            var $duration = current.data('duration');
            var $duration = parseFloat($duration);
            anargs.duration = $duration;
            if(current.hasClass('prehidden')){
                current.removeClass('prehidden');
            }
            

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

            if(current.data('r')){
                anargs.rotation = current.data('r');
            }

            if(current.data('rx')){
                anargs.rotationX = current.data('rx');
            }

            if(current.data('ry')){
                anargs.rotationY = current.data('ry');
            }

            if(current.data('width')){
                anargs.width = current.data('width');
            }

            if(current.data('height')){
                anargs.height = current.data('height');
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
                    if($scope.find(shapes[shape]).length > 0){
                        svgarray.push($scope.find(shapes[shape]));
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
                if($scope.find('video').length > 0){
                    var $videoobj = $scope.find('video');
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
                var customtrigger = $scope;
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
        }

        //reveal
        if($scope.find('.rh-reveal-wrap').length > 0){
            var tl = gsap.timeline({paused: true}); 
            var revealwrap = $scope.find(".rh-reveal-wrap"); 
            var revealcover = $scope.find(".rh-reveal-block");
            var revealcontent = $scope.find(".rh-reveal-cont"); 
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
            $scope.find('img.lazyimages').each(function(){
                var source = $(this).attr("data-src");
                $(this).attr("src", source).css({'opacity': '1'});
            });             
            if(revealcover.data('reveal-dir')=='lr'){
                tl.from(revealcover,{ duration:$coverspeed, scaleX: 0, transformOrigin: "left", delay: $coverdelay });
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
        }
        
    }

    var RehubElCanvas = function($scope, $) {

        if($scope.find('.rh-particle-canvas-true').length > 0){
            var $particleobj = $scope.find('.rh-particle-canvas-true');
            var particleid = $particleobj.attr("id");
            var particlejson = $particleobj.data('particlejson');
            particlesJS(particleid, particlejson, function() {console.log("callback - particles.js config loaded");});
        }

        if($scope.find('.rh-video-canvas').length > 0){
            rhloadVideo();

            // Pause when page is not in the foreground
            $(window).blur(function() {
                $('.rh-video-canvas')[0].pause();
            });

            // Play when page returns to the foreground
            $(window).focus(function() {
                rhloadVideo();
            });
            // Play video when page resizes
            $(window).resize(function() {
                rhloadVideo();
            });

            // Play when page returns from browser history button
            window.onpopstate = function() {
                rhloadVideo();
            };
            function rhloadVideo() {
                var videocurrent = $scope.find('.rh-video-canvas');

                var mainbreakpoint = (typeof videocurrent.data("breakpoint") !=='undefined') ? parseInt(videocurrent.data("breakpoint")) : 1200;
                var tabletbreakpoint = 1024;
                var mobilebreakpoint = 768;

                var mainposter = (typeof videocurrent.data("poster") !=='undefined') ? videocurrent.data("poster") : '';
                var fallbackposter = (typeof videocurrent.data("fallback") !=='undefined') ? videocurrent.data("fallback") : '';
                var tabletposter = (typeof videocurrent.data("fallback-tablet") !=='undefined') ? videocurrent.data("fallback-tablet") : '';
                var mobileposter = (typeof videocurrent.data("fallback-mobile") !=='undefined') ? videocurrent.data("fallback-mobile") : '';     

                var mp4source = (typeof videocurrent.data("mp4") !=='undefined') ? videocurrent.data("mp4") : '';
                var ogvsource = (typeof videocurrent.data("ogv") !=='undefined') ? videocurrent.data("ogv") : '';
                var webmsource = (typeof videocurrent.data("webm") !=='undefined') ? videocurrent.data("webm") : '';

                // Add source tags if not already present
                if ($(window).width() > mainbreakpoint) {
                    if(mainposter){
                        videocurrent.attr('poster', mainposter);
                    }
                    if (videocurrent.find('source').length < 1) {
                        if(mp4source){
                            var source1 = document.createElement('source');
                            source1.setAttribute('src', mp4source);
                            source1.setAttribute('type', 'video/mp4');
                            videocurrent.append(source1);                           
                        }

                        if(webmsource){
                            var source2 = document.createElement('source');
                            source2.setAttribute('src', webmsource);
                            source2.setAttribute('type', 'video/webm');
                            videocurrent.append(source2);                           
                        }

                        if(ogvsource){
                            var source3 = document.createElement('source');
                            source3.setAttribute('src', ogvsource);
                            source3.setAttribute('type', 'video/ogg');
                            videocurrent.append(source3);                           
                        }                                               
                    }

                    // Play the video
                    $('.rh-video-canvas')[0].play();
                }

                // Remove existing source tags for mobile
                if ($(window).width() <= mainbreakpoint) {
                    videocurrent.find('source').remove();
                    if(fallbackposter){
                        videocurrent.attr('poster', fallbackposter);
                    }
                }               

                if(tabletposter && $(window).width() <= tabletbreakpoint){
                    videocurrent.attr('poster', tabletposter);
                }
                if(mobileposter && $(window).width() <= mobilebreakpoint){
                    videocurrent.attr('poster', mobileposter);
                }               

                
            }
        }

        //SVG blobs
        if($scope.find('.rh-svgblob-wrapper').length > 0){
            var blobobj = $scope.find('.rh-svgblob-wrapper');   
                
            var id_scope = blobobj.attr('data-id');

            //console.log(elementSettings);

            var numPoints = parseInt(blobobj.data('numpoints'));
            var minRadius = parseInt(blobobj.data('minradius'));
            var maxRadius = parseInt(blobobj.data('maxradius'));
            var minDuration = parseInt(blobobj.data('minduration'));
            var maxDuration = parseInt(blobobj.data('maxduration'));
            var tensionPoints = parseInt(blobobj.data('tensionpoints'));

            var blob1 = createBlob({
                element: document.querySelector("#rhblobpath-"+id_scope),
                numPoints: numPoints, //5,
                centerX: 300,
                centerY: 300,
                minRadius: minRadius, //200,
                maxRadius: maxRadius, //225,
                minDuration: minDuration,
                maxDuration: maxDuration,
                tensionPoints: tensionPoints,
            });

            function createBlob(options) {
               
                var points = [];  
                var path = options.element;
                var slice = (Math.PI * 2) / options.numPoints;
                var startAngle = random(Math.PI * 2);
              
                var tl = gsap.timeline({
                    onUpdate: update
                });  
              
                for (var i = 0; i < options.numPoints; i++) {
                    var angle = startAngle + i * slice;
                    var duration = random(options.minDuration, options.maxDuration);
                    
                    var point = {
                        x: options.centerX + Math.cos(angle) * options.minRadius,
                        y: options.centerY + Math.sin(angle) * options.minRadius
                    };   
                    
                    var tween = gsap.to(point, {
                        duration: duration,
                        x: options.centerX + Math.cos(angle) * options.maxRadius,
                        y: options.centerY + Math.sin(angle) * options.maxRadius,
                        repeat: -1,
                        yoyo: true,
                        ease: Sine.easeInOut
                    });
                    
                    tl.add(tween, -random(duration));
                    points.push(point);
                }
              
                options.tl = tl;
                options.points = points;
              
                function update() {
                    path.setAttribute("d", cardinal(points, true, options.tensionPoints));
                }
                return options;
            }

            // Cardinal spline - a uniform Catmull-Rom spline with a tension option
            function cardinal(data, closed, tension) {
              
              if (data.length < 1) return "M0 0";
              if (tension == null) tension = 1;
              
              var size = data.length - (closed ? 0 : 1);
              var path = "M" + data[0].x + " " + data[0].y + " C";
              
              for (var i = 0; i < size; i++) {
                
                var p0, p1, p2, p3;
                
                if (closed) {
                  p0 = data[(i - 1 + size) % size];
                  p1 = data[i];
                  p2 = data[(i + 1) % size];
                  p3 = data[(i + 2) % size];
                  
                } else {
                  p0 = i == 0 ? data[0] : data[i - 1];
                  p1 = data[i];
                  p2 = data[i + 1];
                  p3 = i == size - 1 ? p2 : data[i + 2];
                }
                    
                var x1 = p1.x + (p2.x - p0.x) / 6 * tension;
                var y1 = p1.y + (p2.y - p0.y) / 6 * tension;

                var x2 = p2.x - (p3.x - p1.x) / 6 * tension;
                var y2 = p2.y - (p3.y - p1.y) / 6 * tension;
                
                path += " " + x1 + " " + y1 + " " + x2 + " " + y2 + " " + p2.x + " " + p2.y;
              }
              
              return closed ? path + "z" : path;
            }

            function random(min, max) {
                if (max == null) { max = min; min = 0; }
                if (min > max) { var tmp = min; min = max; max = tmp; }
                return min + (max - min) * Math.random();
            }
        }

    }


    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/widget', RehubWidgetsScripts);
        elementorFrontend.hooks.addAction('frontend/element_ready/rh_a_canvas.default', RehubElCanvas);
        if ( typeof elementor != "undefined" && typeof elementor.settings.page != "undefined") {
            elementor.settings.page.addChangeCallback( 'content_type', function( newValue ) {
                elementor.saver.update( {
                    onSuccess: function() {
                    }
                } );
                elementor.reloadPreview();
                elementor.once( 'preview:loaded', function() {
                    elementor.getPanelView().setPage( 'page_settings' );
                    elementor.reloadPreview();
                } );
            } ); 
            elementor.settings.page.addChangeCallback( '_footer_disable', function( newValue ) {
                elementor.saver.update( {
                    onSuccess: function() {
                    }
                } );
                elementor.reloadPreview();
                elementor.once( 'preview:loaded', function() {
                    elementor.getPanelView().setPage( 'page_settings' );
                    elementor.reloadPreview();
                } );
            } );
            elementor.settings.page.addChangeCallback( '_header_disable', function( newValue ) {
                elementor.saver.update( {
                    onSuccess: function() {
                    }
                } );
                elementor.reloadPreview();
                elementor.once( 'preview:loaded', function() {
                    elementor.getPanelView().setPage( 'page_settings' );
                    elementor.reloadPreview();
                } );
            } );                             
        }  
        //mouse move
        $('#content').mousemove(function(event){
            if($('.rh-prlx-mouse').length > 0){
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
            }
        });      
    });

    $(window).on('resize scroll', function() {
        multiParallax();
    });     

})(jQuery); 
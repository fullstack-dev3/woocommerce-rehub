jQuery(document).ready(function($) {
   'use strict';
    if($('.rh-video-canvas').length){
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
    }
    function rhloadVideo() {
        $('.rh-video-canvas').each(function(el){
            var videocurrent = $(this);

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

        });
    }

    //SVG blobs
    if($('.rh-svgblob-wrapper').length){
        $('.rh-svgblob-wrapper').each(function(el){    
            
            var id_scope = $(this).attr('data-id');

            //console.log(elementSettings);

            var numPoints = parseInt($(this).data('numpoints'));
            var minRadius = parseInt($(this).data('minradius'));
            var maxRadius = parseInt($(this).data('maxradius'));
            var minDuration = parseInt($(this).data('minduration'));
            var maxDuration = parseInt($(this).data('maxduration'));
            var tensionPoints = parseInt($(this).data('tensionpoints'));

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

});
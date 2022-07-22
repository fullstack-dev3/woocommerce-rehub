!function(e,i){"object"==typeof exports&&"undefined"!=typeof module?i(exports):"function"==typeof define&&define.amd?define(["exports"],i):i((e=e||self).window=e.window||{})}(this,function(e){"use strict";function g(){return i||"undefined"!=typeof window&&(i=window.gsap)&&i.registerPlugin&&i}function j(e,i,t){t=!!t,e.visible!==t&&(e.visible=t,e.traverse(function(e){return e.visible=t}))}function k(e){return("string"==typeof e&&"="===e.charAt(1)?e.substr(0,2)+parseFloat(e.substr(2)):e)*t}function l(e){(i=e||g())&&(d=i.core.PropTween,f=1)}var i,f,d,u={x:"position",y:"position",z:"position"},t=Math.PI/180;"position,scale,rotation".split(",").forEach(function(e){return u[e+"X"]=u[e+"Y"]=u[e+"Z"]=e});var n={version:"3.0.0",name:"three",register:l,init:function init(e,i){var t,n,o,r,s,a;for(r in f||l(),i){if(t=u[r],o=i[r],t)n=~(s=r.charAt(r.length-1).toLowerCase()).indexOf("x")?"x":~s.indexOf("z")?"z":"y",this.add(e[t],n,e[t][n],~r.indexOf("rotation")?k(o):o);else if("scale"===r)this.add(e[r],"x",e[r].x,o),this.add(e[r],"y",e[r].y,o),this.add(e[r],"z",e[r].z,o);else if("opacity"===r)for(s=(a=e.material.length?e.material:[e.material]).length;-1<--s;)a[s].transparent=!0,this.add(a[s],r,a[s][r],o);else"visible"===r?e.visible!==o&&(this._pt=new d(this._pt,e,r,o?0:1,o?1:-1,0,0,j)):this.add(e,r,e[r],o);this._props.push(r)}}};g()&&i.registerPlugin(n),e.ThreePlugin=n,e.default=n;if (typeof(window)==="undefined"||window!==e){Object.defineProperty(e,"__esModule",{value:!0})} else {delete e.default}});
(function() {
   "use strict";
    var gltfcanvas = document.querySelectorAll(".rh-gltf-canvas");
    if(gltfcanvas.length > 0){
        gltfcanvas.forEach(container=>{
            var scene, camera, pointLight, model, envMap, dirLight, shaderurl, shadermaterial, containerwidth, containerheight, modelcenter;
            var renderer, mixer, controls;
            var hasanimation = false;

            var mouseX = 0;
            var mouseY = 0;

            var windowHalfX = window.innerWidth / 2;
            var windowHalfY = window.innerHeight / 2;

            var clock = new THREE.Clock();

            renderer = new THREE.WebGLRenderer( { antialias: true, alpha: true } );
            renderer.setPixelRatio( window.devicePixelRatio );
            renderer.outputEncoding = THREE.sRGBEncoding;
            //renderer.physicallyCorrectLights = true;

            setContainerSize(); //update renderer with container width and height

            container.appendChild( renderer.domElement );

            scene = new THREE.Scene();
            //scene.background = new THREE.Color( 0xbfe3dd );

            var scenecenter = [0, 0, 0];
            var modelcenter = [0,0,0];

            camera = new THREE.PerspectiveCamera( 40, containerwidth / containerheight, 0.1, 10 ); // we take width and height from setCpntainerSize function
            scene.add(camera);
            var camerax = parseFloat(container.dataset.camerax);
            var cameray = parseFloat(container.dataset.cameray);
            var cameraz = parseFloat(container.dataset.cameraz);
            //camera.position.set( 5, 2, 8 );

            // rotation types
            var gltf_rotation = container.dataset.rotationtype;
            var gltf_rx = parseFloat(container.dataset.rx);
            var gltf_ry = parseFloat(container.dataset.ry);
            var gltf_rz = parseFloat(container.dataset.rz);
            var gltf_mousemove = container.dataset.mousemove;

            //Orbit controller
            controls = new THREE.OrbitControls( camera, renderer.domElement );
            controls.target.set( 0, 0.5, 0 );
            controls.enablePan = false;
            var disablezoom = container.dataset.zoom;
            if(disablezoom) controls.enableZoom = false;

            // envmap

            var env = container.dataset.env;
            var envpx = container.dataset.envpx;
            var envpy = container.dataset.envpy;
            var envpz = container.dataset.envpz;
            var envnx = container.dataset.envnx;
            var envny = container.dataset.envny;
            var envnz = container.dataset.envnz;

            if(env && envpx && envpy && envpz && envnx && envny && envnz){
                var envMap = new THREE.CubeTextureLoader().load( [envpx, envnx, envpy, envny, envpz, envnz] );               
            }

            //Here we check if we set shaderfrog json

            var shaderurl = container.dataset.shaderurl;
            if(shaderurl){
                shaderurl = decodeURIComponent(shaderurl);
                var runtime = new ShaderRuntime();
                runtime.load(shaderurl, function( shaderData ) {
                    shadermaterial = runtime.get( shaderData.name );
                });
                runtime.registerCamera( camera );
            }    

            //Loader of gltf                

            var loader = new THREE.GLTFLoader();
            var urlgltf = decodeURIComponent(container.dataset.url);
            loader.load( urlgltf, function ( gltf ) {

                model = gltf.scene;
                //model.position.set( 1, 1, 0 );

                //center object in scene

                var modelbox = new THREE.Box3().setFromObject( model );
                modelcenter = modelbox.getCenter( new THREE.Vector3() );
                var modelsize = modelbox.getSize(new THREE.Vector3()).length();
                model.position.x += ( model.position.x - modelcenter.x );
                model.position.y += ( model.position.y - modelcenter.y );
                model.position.z += ( model.position.z - modelcenter.z );

                //update controls and camera according to size

                controls.maxDistance = modelsize * 10;
                camera.near = modelsize / 100;
                camera.far = modelsize * 100;
                camera.position.copy(modelcenter);
                camera.position.x += modelsize / 2.0;
                camera.position.y += modelsize / 5.0;
                camera.position.z += modelsize / 2.0;
                camera.updateProjectionMatrix();

                //offset camera if need

                if(camerax) camera.position.x += camerax;
                if(cameray) camera.position.y += cameray;
                if(cameraz) camera.position.z += cameraz;
                camera.lookAt(modelcenter);

                //offset model if need

                var modelx = parseFloat(container.dataset.modelx);
                var modely = parseFloat(container.dataset.modely);
                var modelz = parseFloat(container.dataset.modelz);

                if(modelx) model.position.x += modelx;
                if(modely) model.position.y += modely;
                if(modelz) model.position.z += modelz;

                //Rescale model if need

                var rescale = parseFloat(container.dataset.scale);
                if(rescale){
                    model.scale.set( rescale, rescale, rescale );
                }


                // Point Light

                var lights = container.dataset.lights;
                if(lights){
                    var color = container.dataset.lightcolor;
                    var intensity = parseFloat(container.dataset.lightstrength);
                    var diffuse = parseFloat(container.dataset.lightdiffuse);
                    if(!diffuse) diffuse = 0;
                    var diffuse = 100 - diffuse; 

                    pointLight = new THREE.PointLight( color, intensity, diffuse);
                    pointLight.position.copy( camera.position );
                    //pointLight.target.position.set(modelcenter); 

                    var lightx = parseFloat(container.dataset.lightx);
                    var lighty = parseFloat(container.dataset.lighty);
                    var lightz = parseFloat(container.dataset.lightz);

                    if(lightx) pointLight.position.x += lightx;
                    if(lighty) pointLight.position.y += lighty;
                    if(lightz) pointLight.position.z += lightz;

                    scene.add( pointLight);

                }

                // Directional Light

                var lightds = container.dataset.lightds;
                if(lightds){
                    var colord = container.dataset.lightdcolor;
                    var intensityd = parseFloat(container.dataset.lightdstrength); 

                    dirLight = new THREE.DirectionalLight( colord, intensityd);
                    dirLight.position.copy( camera.position );
                    dirLight.target.position.set(modelcenter); 

                    var lightdx = parseFloat(container.dataset.lightdx);
                    var lightdy = parseFloat(container.dataset.lightdy);
                    var lightdz = parseFloat(container.dataset.lightdz);

                    if(lightdx) dirLight.position.x += lightdx;
                    if(lightdy) dirLight.position.y += lightdy;
                    if(lightdz) dirLight.position.z += lightdz;

                    scene.add( dirLight);

                }

                // Ambient Light

                var alights = container.dataset.alights;
                if(alights){
                    var acolor = container.dataset.alightcolor;
                    var aintensity = parseFloat(container.dataset.alightstrength); 
                    scene.add( new THREE.AmbientLight(acolor,aintensity) );                  
                }
                
                // Check all inner objects and assign materials

                var meshanimations = container.dataset.meshanimations;
                if(meshanimations) meshanimations = JSON.parse(meshanimations);

                var childmeshes = []; 
                var childmeshesnames = [];

                model.traverse( function ( child ) {
                    if ( child.isMesh ) {
                        if(shaderurl){
                            var shadermesh = container.dataset.shadermesh;
                            if(shadermesh){
                                if(child.name == shadermesh){
                                    child.material = shadermaterial;
                                }
                            }else{
                                child.material = shadermaterial;
                            }
                            
                        }
                        if(envMap){
                            child.material.envMap = envMap;
                            var envintensity = container.dataset.envstrength;
                            if(envintensity) child.material.envMapIntensity = envintensity;
                        }
                        childmeshes.push(child);
                        childmeshesnames.push(child.name);
                    }

                } );
                
                if(meshanimations){
                    for(var curr = 0; curr < meshanimations.length; curr++){

                        var findname = meshanimations[curr].mesh_name;

                        if(findname){
                            var indexbyname = childmeshesnames.indexOf(findname); 
                            var mesh = childmeshes[indexbyname]; 
                        }else{
                            var mesh = childmeshes[curr];
                        }

                        if(mesh.name){

                            var pivotcenter = meshanimations[curr].model_center;
                            if(pivotcenter){
                                var center = new THREE.Vector3();
                                mesh.geometry.computeBoundingBox();
                                mesh.geometry.boundingBox.getCenter(center);
                                mesh.geometry.center();
                                mesh.position.copy(center);
                            }

                            var animatedobj = mesh;

                            let rx = meshanimations[curr].model_rx;
                            let ry = meshanimations[curr].model_ry;
                            let rz = meshanimations[curr].model_rz;
                            let px = meshanimations[curr].model_px;
                            let py = meshanimations[curr].model_py;
                            let pz = meshanimations[curr].model_pz;
                            let sc = meshanimations[curr].model_scale;
                            let du = meshanimations[curr].model_duration;
                            let de = meshanimations[curr].model_delay;
                            let ea = meshanimations[curr].model_ease;
                            let inf = meshanimations[curr].model_infinite;
                            let yoyo = meshanimations[curr].model_yoyo;
                            let from = meshanimations[curr].model_from;
                            let opacity = meshanimations[curr].model_opacity;
                            let anargs = {};
                            anargs.three = {};
                            if(rx) anargs.three.rotationX = parseFloat(rx);
                            if(ry) anargs.three.rotationY = parseFloat(ry);
                            if(rz) anargs.three.rotationZ = parseFloat(rz);
                            if(px) anargs.three.x = parseFloat(px);
                            if(py) anargs.three.y = parseFloat(py);
                            if(pz) anargs.three.z = parseFloat(pz);
                            if(sc) anargs.three.scale = parseFloat(sc);
                            if(opacity) anargs.three.opacity = parseInt(opacity)/100;
                            if(du) anargs.duration = parseFloat(du);
                            if(de) anargs.delay = parseFloat(de);
                            if(ea){
                                var $ease = ea.split("-");
                                anargs.ease = $ease[0]+"."+$ease[1];
                                if(anargs.ease === "power0.none"){           
                                    anargs.ease = "none";
                                }
                            }
                            if(inf=="yes"){
                                if(yoyo=="yes"){
                                    anargs.yoyo = true;
                                }
                                anargs.repeat = -1;
                                if(de){
                                    anargs.repeatDelay = parseFloat(de);
                                }
                                
                            }
                            if(from=="yes"){
                                gsap.from(animatedobj, anargs);
                            }else{
                                gsap.to(animatedobj, anargs);
                            }
                        }
                    }
                }

                // finally add model to scene
                scene.add( model );

                // Check if we have animations and play it

                if(gltf.animations.length > 0){
                    mixer = new THREE.AnimationMixer( model );
                    gltf.animations.forEach((clip) => {
                        mixer.clipAction(clip).reset().play();
                    });
                    hasanimation = true;                   
                }

                

            }, undefined, function ( e ) {

                console.error( e );

            } );

            //offset camera if need in case if no model. If we have model, camera will be repositioned and offset again because loader is async

            if(camerax) camera.position.x += camerax;
            if(cameray) camera.position.y += cameray;
            if(cameraz) camera.position.z += cameraz;
            camera.lookAt(modelcenter);

            //Start animation here

            animate();

            //On resize function

            window.onresize = function () {

                setContainerSize();
                camera.aspect = containerwidth / containerheight;
                camera.updateProjectionMatrix();

            };

            //Mouse move feature 

            document.addEventListener("mousemove", function(event){

                mouseX = ( event.clientX - windowHalfX );
                mouseY = ( event.clientY - windowHalfY );

                //$("#content").width()/2
            });

            //Basic animation on each frame 

            function animate() {

                requestAnimationFrame( animate );

                var delta = clock.getDelta(); // we get clock time from three js
                if(hasanimation){
                    mixer.update( delta ); //check if scene has animation and update it
                }
                controls.update( delta ); //update orbit control
                if(shaderurl){
                    runtime.updateShaders( clock.getElapsedTime() ); //update shaderfrog
                }
                
                if ( model && gltf_rotation == "mouse" ) { // rotation on mouse move
                    model.rotation.y += 0.05 * ( mouseX * gltf_mousemove/1000 - model.rotation.y );
                    model.rotation.x += 0.05 * ( mouseY * gltf_mousemove/1000 - model.rotation.x );
                    //0.05 is speed, 001 is strength of rotation
                }else if(scene && gltf_rotation == "inf"){ //infinite rotation
                    if(gltf_rx) scene.rotation.x += gltf_rx/1000;
                    if(gltf_ry) scene.rotation.y += gltf_ry/1000;
                    if (gltf_rz) scene.rotation.z += gltf_rz/1000;
                }

                renderer.render( scene, camera );
            }

            //Set container width and height

            function setContainerSize(){

                var positionInfo = container.getBoundingClientRect();
                containerheight = positionInfo.height;
                if(containerheight < 100) containerheight = 100;
                containerwidth = positionInfo.width;

                renderer.setSize( containerwidth, containerheight );
            }

        });
    }

})();
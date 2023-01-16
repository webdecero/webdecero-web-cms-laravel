<head>
    <meta charset="utf-8">
    <title>{!! $title !!}</title>
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="description" content="">
    <link rel="shortcut icon" href="#" />
    
    <base href="{{url('/')}}">

    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=1"
    />
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="storage-webcms/uploads/assets/img/favicon.png"
    />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      rel="preload"
      href="https://cdnjs.cloudflare.com/ajax/libs/PreloadJS/1.0.1/preloadjs.min.js"
      as="script"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PreloadJS/1.0.1/preloadjs.min.js"></script>
    @stack('scripts')
    @yield('css')
    <meta
        name="preloader-list"
        content='["storage-webcms/uploads/assets/img/riesgo-1.jpg","storage-webcms/uploads/assets/img/riesgo-2.jpg","storage-webcms/uploads/assets/img/riesgo-3.jpg","storage-webcms/uploads/assets/img/riesgo-4.jpg","storage-webcms/uploads/assets/img/riesgo-5.jpg","storage-webcms/uploads/assets/img/riesgo-6.jpg","storage-webcms/uploads/assets/img/consultoria1.jpg","storage-webcms/uploads/assets/img/consultoria2.jpg"]'
    />
    <script type="x-shader/x-vertex" id="vertexshaderParticle">
        attribute float size;
        attribute vec3 color;
        attribute float fade;
    
        varying vec3 vColor;
    
        void main() {
            vColor = color;
            vec4 mvPosition = modelViewMatrix * vec4(position, 1.0);
            gl_PointSize = size;
            gl_Position = projectionMatrix * mvPosition;
        }
      </script>
      <script type="x-shader/x-fragment" id="fragmentshaderParticle">
        uniform sampler2D pointTexture;
        varying vec3 vColor;
        void main() {
            gl_FragColor = vec4(vColor, 1.0);
            gl_FragColor = gl_FragColor * texture2D(pointTexture, gl_PointCoord);
        }
      </script>
</head>

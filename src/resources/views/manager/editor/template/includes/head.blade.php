<head>
    <meta charset="utf-8">
    <title>ContentBuilder.js Example - Using in Material Design Lite framework</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="shortcut icon" href="#" />

    <!-- Material Design Lite -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">

    <base href="{{url('/')}}">

    <link href="{{ asset('storage-webcms/manager/assets/minimalist-blocks/content.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('storage-webcms/manager/contentbuilder/contentbuilder.css') }}" rel="stylesheet" type="text/css" />

    <!-- These includes will enable snippet slider (using Glide slider) -->
    <link href="{{ asset('storage-webcms/manager/assets/scripts/glide/css/glide.core.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('storage-webcms/manager/assets/scripts/glide/css/glide.theme.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('storage-webcms/manager/assets/scripts/glide/glide.js')}}" type="text/javascript"></script>

    <!-- These includes will enable snippet slider (using Glide slider) -->
    <link href="{{ asset('storage-webcms/manager/assets/scripts/glide/css/glide.core.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('storage-webcms/manager/assets/scripts/glide/css/glide.theme.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('storage-webcms/manager/assets/scripts/glide/glide.js')}}" type="text/javascript"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    @yield('css')

    @stack('scripts')

    <style>
        .container-builder {  margin: 80px auto; max-width: rem; width:100%; padding:0 35px; box-sizing: border-box;}
    </style>
</head>

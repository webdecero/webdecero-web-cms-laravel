<head>
    <meta charset="utf-8">
    <title>ContentBuilder.js Example - Using in Material Design Lite framework</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="shortcut icon" href="#" />

    <!-- Material Design Lite -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">

    <link href="{{ asset('assets/minimalist-blocks/content.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('contentbuilder/contentbuilder.css') }}" rel="stylesheet" type="text/css" />

    <!-- These includes will enable snippet slider (using Glide slider) -->
    <link href="{{ asset('assets/scripts/glide/css/glide.core.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/scripts/glide/css/glide.theme.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/scripts/glide/glide.js')}}" type="text/javascript"></script>


    @yield('css')


    <base href="{{url('')}}">

    <style>
        /* .container {margin: 20px auto; max-width: 800px; width:100%; padding:0 35px; box-sizing: border-box;} */
        .container {margin: 20px auto; width:100%; padding:0 35px; box-sizing: border-box;}
    </style>
</head>

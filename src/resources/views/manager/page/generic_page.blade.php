@extends('manager.page.layouts.base')

@section('css')
        
    @foreach($cssSite as $item) 
        <link href="{{ asset($item['pathFile'])}}"  rel="stylesheet" type="text/css" />
    @endforeach

    @foreach($cssPage as $item) 
        <link href="{{ asset($item['pathFile'])}}"  rel="stylesheet" type="text/css" />
    @endforeach
        
    @foreach($cssTemplateMain as $item)
        <link href="{{ asset($item['pathFile'])}}"  rel="stylesheet" type="text/css" />
    @endforeach

    @foreach($cssTemplateHeader as $item)
        <link href="{{ asset($item['pathFile'])}}"  rel="stylesheet" type="text/css" />
    @endforeach

    @foreach($cssTemplateFooter as $item)
        <link href="{{ asset($item['pathFile'])}}"  rel="stylesheet" type="text/css" />
    @endforeach

    @if (!empty($cssCustomSite['pathFile']))
        <link href="{{ asset($cssCustomSite['pathFile'])}}"  rel="stylesheet" type="text/css" />
    @endif
    @if (!empty($cssCustomPage['pathFile']))
        <link href="{{ asset($cssCustomPage['pathFile'])}}"  rel="stylesheet" type="text/css" />
    @endif
    @if (!empty($cssCustomTemplateMain['pathFile']))
        <link href="{{ asset($cssCustomTemplateMain['pathFile'])}}"  rel="stylesheet" type="text/css" />
    @endif
    @if (!empty($cssCustomTemplateHeader['pathFile']))
        <link href="{{ asset($cssCustomTemplateHeader['pathFile'])}}"  rel="stylesheet" type="text/css" />
    @endif
    @if (!empty($cssCustomTemplateFooter['pathFile']))
        <link href="{{ asset($cssCustomTemplateFooter['pathFile'])}}"  rel="stylesheet" type="text/css" />
    @endif

@endsection


{{-- Add main template --}}
@section('contenido')

{!! $content !!}

@endsection

@push('bodyClass')
    @if (!empty($javaScriptCustomSite['pathFile']))
        <script defer="defer" src="{{ asset($javaScriptCustomSite['pathFile'])}}" ></script>
    @endif
    @if (!empty($javaScriptCustomPage['pathFile']))
        <script defer="defer" src="{{ asset($javaScriptCustomPage['pathFile'])}}" ></script>
    @endif
    @if (!empty($javaScriptCustomTemplateMain['pathFile']))
        <script defer="defer" src="{{ asset($javaScriptCustomTemplateMain['pathFile'])}}" ></script>
    @endif
    @if (!empty($javaScriptCustomTemplateHeader['pathFile']))
        <script defer="defer" src="{{ asset($javaScriptCustomTemplateHeader['pathFile'])}}" ></script>
    @endif
    @if (!empty($javaScriptCustomTemplateFooter['pathFile']))
        <script defer="defer" src="{{ asset($javaScriptCustomTemplateFooter['pathFile'])}}" ></script>
    @endif
@endpush

{{-- add JavaScript template --}}
@push('scripts')
    @foreach($javaScriptSite as $item)
        <script defer="defer" src="{{ asset($item['pathFile'])}}" ></script>
    @endforeach

    @foreach($javaScriptPage as $item)
        <script defer="defer" src="{{ asset($item['pathFile'])}}" ></script>
    @endforeach

    @foreach($javaScriptTemplateMain as $item)
        <script defer="defer" src="{{ asset($item['pathFile'])}}" ></script>
    @endforeach

    @foreach($javaScriptTemplateHeader as $item)
        <script defer="defer" src="{{ asset($item['pathFile'])}}" ></script>
    @endforeach

    @foreach($javaScriptTemplateFooter as $item)
        <script defer="defer" src="{{ asset($item['pathFile'])}}" ></script>
    @endforeach 
@endpush


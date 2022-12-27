@extends('manager.editor.template.layouts.base')

{{-- {{ dd($cssSite, $cssTemplate) }} --}}
@section('css')

    @foreach($cssSite as $item)

        <link href="{{ asset($item['pathFile'])}}"  rel="stylesheet" type="text/css" />

    @endforeach

    @foreach($cssTemplate as $item)

        <link href="{{ asset($item['pathFile'])}}"  rel="stylesheet" type="text/css" />

    @endforeach
    
    @if (!empty($cssCustomSite['pathFile']))
        <link href="{{ asset($cssCustomSite['pathFile'])}}"  rel="stylesheet" type="text/css" />
    @endif

    @if (!empty($cssCustomTemplate['pathFile']))
        <link href="{{ asset($cssCustomTemplate['pathFile'])}}"  rel="stylesheet" type="text/css" />
    @endif
    


@endsection

{{-- Add header template --}}


{{-- Add main template --}}
@section('contenido')

{!! $content !!}

@endsection


{{-- add JavaScript template --}}
@push('scripts')
    @foreach($javaScriptStite as $item)
        <script defer="defer" src="{{ asset($item['pathFile'])}}"></script>
    @endforeach

    @foreach($javaScriptTemplate as $item)
        <script defer="defer" src="{{ asset($item['pathFile'])}}"></script>
    @endforeach

    @if (!empty($javaScriptCustomSite['pathFile']))
        <script defer="defer" src="{{ asset($javaScriptCustomSite['pathFile'])}}" ></script>
    @endif

    @if (!empty($javaScriptCustomTemplate['pathFile']))
        <script defer="defer" src="{{ asset($javaScriptCustomTemplate['pathFile'])}}" ></script>
    @endif

@endpush



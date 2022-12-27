@extends('manager.editor.template.layouts.base')

@section('css')

    @foreach($cssSite as $item)
        @if (!empty($item['pathFile']))
            <link href="{{ asset($item['pathFile'])}}"  rel="stylesheet" type="text/css" />
        @endif
    @endforeach

    @foreach($cssTemplate as $item)
        @if (!empty($item['pathFile']))
            <link href="{{ asset($item['pathFile'])}}"  rel="stylesheet" type="text/css" />
        @endif
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
        @if (!empty($item['pathFile']))
            <script defer src="{{ asset($item['pathFile'])}}"></script>
        @endif

    @endforeach

    @foreach($javaScriptTemplate as $item)
        @if (!empty($item['pathFile']))
            <script defer src="{{ asset($item['pathFile'])}}"></script>
        @endif
    @endforeach

    @if (!empty($javaScriptCustomSite['pathFile']))
        <link defer="defer" href="{{ asset($javaScriptCustomSite['pathFile'])}}"  rel="stylesheet" type="text/css" />
    @endif
    @if (!empty($javaScriptCustomTemplate['pathFile']))
        <link defer="defer" href="{{ asset($javaScriptCustomTemplate['pathFile'])}}"  rel="stylesheet" type="text/css" />
    @endif

@endpush



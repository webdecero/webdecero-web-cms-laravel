@extends('manager.editor.template.layouts.base')

@section('css')

    @foreach($cssSite as $item)

        <link href="{{ asset($item['pathFile'])}}"  rel="stylesheet" type="text/css" />

    @endforeach

    @foreach($cssTemplate as $item)

        <link href=" {{ asset($item['pathFile'])}}"  rel="stylesheet" type="text/css" />

    @endforeach
    
    <link defer="defer" href="{{ asset($cssCustomSite['pathFile'])}}"  rel="stylesheet" type="text/css" />
    <link defer="defer" href="{{ asset($cssCustomTemplate['pathFile'])}}"  rel="stylesheet" type="text/css" />


@endsection

{{-- Add main template --}}
@section('contenido')

{!! $content !!}

@endsection


{{-- add JavaScript template --}}
@push('scripts')
    @foreach($javaScriptStite as $item)

        <script src="{{ asset($item['pathFile'])}}"></script>

    @endforeach

    @foreach($javaScriptTemplate as $item)

        <script src="{{ asset($item['pathFile'])}}"></script>

    @endforeach

    <script src="{{ asset($javaScriptCustomSite['pathFile'])}}"></script>
    <script src="{{ asset($javaScriptCustomTemplate['pathFile'])}}"></script>

@endpush



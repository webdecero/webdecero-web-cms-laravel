@extends('contentBuilder.layouts.base')

@section('css')

    @foreach($style as $item)

        <link href="{{ asset($item['path'])}}"  rel="stylesheet" type="text/css" />

    @endforeach

@endsection

{{-- Add header template --}}
@section('header')

{!! $header ?? '' !!}

@endsection


{{-- Add main template --}}
@section('contenido')

{!! $template !!}

@endsection


{{-- add JavaScript template --}}
@push('scripts')
    @foreach($js as $item)

        <script src="{{ asset($item['path'])}}"></script>

    @endforeach
@endpush

@extends('layouts.app')

@section('title', 'Galeri Video & Tutorial - Ibrahim Portfolio')

@section('extra_css')
    <link rel="stylesheet" href="{{ asset('css/video.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection

@section('content')
    @include('partials.video_cards')
@endsection

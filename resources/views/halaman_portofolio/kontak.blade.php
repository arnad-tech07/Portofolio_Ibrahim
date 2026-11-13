@extends('layouts.app')

@section('title', 'Kontak & Lokasi Maps - Ibrahim')

@section('extra_css')
    <link rel="stylesheet" href="{{ asset('css/kontak_maps.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection

@section('content')
    @include('partials.kontak')
@endsection

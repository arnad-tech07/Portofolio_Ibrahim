@extends('layouts.app')

@section('title', 'Dokumentasi Proyek Web - Ibrahim Portfolio')

@section('extra_css')
    <link rel="stylesheet" href="{{ asset('css/dokumentasi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection

@section('content')
    @include('partials.dokumentasi_cards')
@endsection

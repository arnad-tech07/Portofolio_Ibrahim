@extends('layouts.app')

@section('title', 'Jasa Pembuatan Website & Training Pemrograman - Ibrahim')

@section('extra_css')
    <link rel="stylesheet" href="{{ asset('css/layanan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection

@section('content')
    @include('partials.layanan')
@endsection

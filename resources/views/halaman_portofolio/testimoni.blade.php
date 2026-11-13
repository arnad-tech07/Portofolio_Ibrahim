@extends('layouts.app')

@section('title', 'Apa Kata Mereka - Testimoni Klien Ibrahim')

@section('extra_css')
    <link rel="stylesheet" href="{{ asset('css/testimoni.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection

@section('content')
    @include('partials.testimoni')
@endsection

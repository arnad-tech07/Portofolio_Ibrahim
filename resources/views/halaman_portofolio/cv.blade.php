@extends('layouts.app')

@section('title', 'Curriculum Vitae & Profil - Ibrahim Digital Portfolio')

@section('extra_css')
    <link rel="stylesheet" href="{{ asset('css/cv.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection

@section('content')
    @include('partials.cv_profile')
@endsection

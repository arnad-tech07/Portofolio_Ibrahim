@extends('layouts.app')

@section('title', 'Ibrahim - Portofolio Digital, Jasa Pembuatan Website & Training Pemrograman')

@section('extra_css')
    <!-- CSS Terpisah Sesuai Setiap Komponen / Halaman -->
    <link rel="stylesheet" href="{{ asset('css/carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cv.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layanan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dokumentasi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/video.css') }}">
    <link rel="stylesheet" href="{{ asset('css/testimoni.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kontak_maps.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection

@section('content')
    <!-- 1. Slide Banner Carousel Interaktif -->
    @include('partials.carousel')

    <!-- 2. Profil & CV Digital Ibrahim -->
    @include('partials.cv_profile')

    <!-- 3. Layanan Jasa Pembuatan Website & Training Pemrograman -->
    @include('partials.layanan')

    <!-- 4. Card Dokumentasi Proyek dengan Judul & Deskripsi -->
    @include('partials.dokumentasi_cards')

    <!-- 5. Card Video Showcase dengan Judul & Deskripsi -->
    @include('partials.video_cards')

    <!-- 6. Apa Kata Mereka (Testimoni Klien & Alumni) -->
    @include('partials.testimoni')

    <!-- 7. Peta Lokasi (Maps) & Formulir Kontak Hubungi Saya -->
    @include('partials.kontak')
@endsection

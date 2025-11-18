@extends('layout.landingPage')

@section('content')
    <!-- Hero -->
    @include('LandingPage.pages.Home.partials.hero')

    <!-- Blog -->
    @include('LandingPage.pages.Home.partials.blog')

    <!-- Proyek -->
    @include('LandingPage.pages.Home.partials.proyek')

    <!-- Testimoni -->
    @include('LandingPage.pages.Home.partials.testimonials')

    <!-- Pegawai -->
    @include('LandingPage.pages.Home.partials.pegawai')
    
    <!-- Kontak -->
    @include('LandingPage.pages.Home.partials.contact_2')

    {{-- @include('LandingPage.pages.Home.partials.about')
    @include('LandingPage.pages.Home.partials.features')
    @include('LandingPage.pages.Home.partials.courses')
    @include('LandingPage.pages.Home.partials.team')
    @include('LandingPage.pages.Home.partials.team_2')
    @include('LandingPage.pages.Home.partials.testimonials')
    @include('LandingPage.pages.Home.partials.stats')
    @include('LandingPage.pages.Home.partials.service')
    @include('LandingPage.pages.Home.partials.pricing')
    @include('LandingPage.pages.Home.partials.faq')
    @include('LandingPage.pages.Home.partials.cta_2')
    @include('LandingPage.pages.Home.partials.contact_2')
    @include('LandingPage.pages.Home.partials.pegawai') --}}
@endsection

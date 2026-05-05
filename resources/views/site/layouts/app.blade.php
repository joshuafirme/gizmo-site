@extends('site.layouts.master')
@section('content')
    @include('site.partials.topnav')

    @yield('panel')

    @include('site.partials.footer')
@endsection

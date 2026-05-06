@extends('admin.layouts.master')
@section('content')
    @include('admin.partials.sidenav')

    <div id="content">
        <div class="topnav d-flex align-items-center p-3 border-bottom border-secondary">
            <button class="btn btn-dark d-md-none"><i class="fa-solid fa-bars"></i></button>
            
            <div class="ms-auto d-flex align-items-center">
                <a href="{{ url('/') }}" target="_blank" class="text-muted me-4 text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Visit Public Website">
                    <i class="fa-solid fa-globe fs-5 text-tech transition-all hover-lift"></i>
                </a>

                @php
                    $user = auth()->user();
                @endphp
                <span class="me-3 text-muted">Welcome, {{ $user->name }}</span>
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0d6efd&color=fff"
                    class="rounded-circle border border-secondary" width="35" height="35" alt="Avatar">
            </div>
        </div>

        @yield('panel')

    </div>
@endsection
@extends('admin.layouts.master')
@section('content')
    @include('admin.partials.sidenav')

    <div id="content">
        <!-- Top Navigation -->
        <div class="topnav">
            <button class="btn btn-dark d-md-none"><i class="fa-solid fa-bars"></i></button>
            <div class="ms-auto d-flex align-items-center">
                <span class="me-3 text-muted">Welcome, Admin</span>
                <img src="https://ui-avatars.com/api/?name=Admin&background=3080C4&color=fff" class="rounded-circle"
                    width="35">
            </div>
        </div>

        @yield('panel')
        
    </div>
@endsection

@extends('admin.layouts.app')

@section('panel')
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1 text-white"><i class="fa-solid fa-chart-line text-tech me-2"></i>Dashboard Overview</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#"
                                class="text-muted text-decoration-none">Administration</a></li>
                        <li class="breadcrumb-item active text-tech">System Summary</li>
                    </ol>
                </nav>
            </div>
            <div class="text-muted small">
                <i class="fa-regular fa-clock me-1"></i> Last login: {{ auth()->user()->updated_at->diffForHumans() }}
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-6 col-xl-3">
                <div class="admin-card border-secondary p-4 rounded h-100 position-relative overflow-hidden"
                    style="background-color: var(--bg-card); border: 1px solid rgba(255,255,255,0.1);">
                    <i
                        class="fa-solid fa-envelope fa-4x text-tech opacity-25 position-absolute top-50 translate-middle-y end-0 me-3"></i>
                    <h6 class="text-muted text-uppercase fw-bold mb-3">Unread Inquiries</h6>
                    <h2 class="display-5 fw-bold text-white mb-0">{{ $stats['unread_messages'] }}</h2>
                    <a href="{{ route('admin.messages.index') }}" class="stretched-link"></a>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="admin-card border-secondary p-4 rounded h-100 position-relative overflow-hidden"
                    style="background-color: var(--bg-card); border: 1px solid rgba(255,255,255,0.1);">
                    <i
                        class="fa-solid fa-server fa-4x text-tech opacity-25 position-absolute top-50 translate-middle-y end-0 me-3"></i>
                    <h6 class="text-muted text-uppercase fw-bold mb-3">Active Products</h6>
                    <h2 class="display-5 fw-bold text-white mb-0">{{ $stats['total_products'] }}</h2>
                    <a href="{{ route('admin.products.index') }}" class="stretched-link"></a>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="admin-card border-secondary p-4 rounded h-100 position-relative overflow-hidden"
                    style="background-color: var(--bg-card); border: 1px solid rgba(255,255,255,0.1);">
                    <i
                        class="fa-solid fa-star fa-4x text-tech opacity-25 position-absolute top-50 translate-middle-y end-0 me-3"></i>
                    <h6 class="text-muted text-uppercase fw-bold mb-3">Client Reviews</h6>
                    <h2 class="display-5 fw-bold text-white mb-0">{{ $stats['total_reviews'] }}</h2>
                    <a href="{{ route('admin.client-reviews.index') }}" class="stretched-link"></a>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="admin-card border-secondary p-4 rounded h-100 position-relative overflow-hidden"
                    style="background-color: var(--bg-card); border: 1px solid rgba(255,255,255,0.1);">
                    <i
                        class="fa-solid fa-users fa-4x text-tech opacity-25 position-absolute top-50 translate-middle-y end-0 me-3"></i>
                    <h6 class="text-muted text-uppercase fw-bold mb-3">Admin Accounts</h6>
                    <h2 class="display-5 fw-bold text-white mb-0">{{ $stats['total_users'] }}</h2>
                    <a href="{{ route('admin.users.index') }}" class="stretched-link"></a>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="admin-card border-secondary rounded h-100"
                    style="background-color: var(--bg-card); border: 1px solid rgba(255,255,255,0.1);">
                    <div
                        class="card-header bg-transparent border-bottom border-secondary p-4 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-white"><i class="fa-solid fa-inbox text-tech me-2"></i> Recent Inquiries</h5>
                        <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-secondary">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse($recentMessages as $msg)
                                <a href="{{ route('admin.messages.index') }}"
                                    class="list-group-item list-group-item-action bg-transparent border-secondary p-3 {{ $msg->is_read ? '' : 'border-start border-tech border-4' }}">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <strong class="text-white">{{ $msg->name }}</strong>
                                        <small class="text-muted">{{ $msg->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="small text-muted text-truncate" style="max-width: 90%;">
                                        <span class="badge bg-secondary me-2">{{ $msg->subject ?? 'General' }}</span>
                                        {{ Str::limit($msg->message, 50) }}
                                    </div>
                                </a>
                            @empty
                                <div class="p-4 text-center text-muted small">No recent inquiries found.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="admin-card border-secondary rounded h-100"
                    style="background-color: var(--bg-card); border: 1px solid rgba(255,255,255,0.1);">
                    <div
                        class="card-header bg-transparent border-bottom border-secondary p-4 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-white"><i class="fa-solid fa-boxes-stacked text-tech me-2"></i> New Hardware
                        </h5>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary">View
                            Catalog</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse($recentProducts as $product)
                                <div class="list-group-item bg-transparent border-secondary p-3 d-flex align-items-center">
                                    <div class="bg-dark rounded d-flex align-items-center justify-content-center me-3 border border-secondary"
                                        style="width:45px; height:45px; overflow:hidden;">
                                        @if ($product->image_path)
                                            <img src="{{ asset('storage/' . $product->image_path) }}" class="w-100 h-100"
                                                style="object-fit:cover;">
                                        @else
                                            <i class="fa-solid {{ $product->icon_class ?? 'fa-server' }} text-muted"></i>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <strong class="text-white">{{ $product->name }}</strong>
                                            <span
                                                class="badge {{ $product->is_active ? 'bg-success' : 'bg-danger' }}">{{ $product->is_active ? 'Active' : 'Draft' }}</span>
                                        </div>
                                        <div class="small text-muted">
                                            {{ $product->subcategory->category->name ?? 'Uncategorized' }} &rarr;
                                            {{ $product->subcategory->name ?? 'Uncategorized' }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-4 text-center text-muted small">No recent products added.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('admin.layouts.app')

@section('panel')
    <div class="container-fluid p-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1 text-white"><i class="fa-solid fa-users text-tech me-2"></i>System Users</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#"
                                class="text-muted text-decoration-none">Administration</a></li>
                        <li class="breadcrumb-item active text-tech" aria-current="page">Users & Roles</li>
                    </ol>
                </nav>
            </div>
            <button class="btn btn-tech" data-bs-toggle="modal" data-bs-target="#userModal" data-role="fill-modal"
                data-mode="create" data-module="User" data-action="{{ route('admin.users.store') }}">
                <i class="fa-solid fa-plus me-2"></i> Add New User
            </button>
        </div>

        <!-- Session Alerts -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show bg-success text-white border-0" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show bg-danger text-white border-0" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Data Table Card -->
        <div class="admin-card">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead class="border-bottom border-secondary">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="25%">User Information</th>
                            <th width="20%">System Role</th>
                            <th width="20%">Joined Date</th>
                            <th width="15%" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-muted">#{{ $user->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2b3035&color=fff"
                                            class="rounded-circle me-3" width="40" height="40" alt="Avatar">
                                        <div>
                                            <div class="fw-bold text-white">{{ $user->name }}</div>
                                            <div class="small text-muted">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $roleColors = [
                                            'admin' => 'bg-danger',
                                            'content_manager' => 'bg-info text-dark',
                                            'technical_administrator' => 'bg-tech-alt text-dark',
                                            'web_master' => 'bg-primary',
                                            'user' => 'bg-secondary',
                                        ];
                                    @endphp
                                    <span class="badge {{ $roleColors[$user->role_name] ?? 'bg-secondary' }}">
                                        {{ ucwords(str_replace('_', ' ', $user->role_name)) }}
                                    </span>
                                </td>
                                <td class="text-muted small">
                                    <i class="fa-regular fa-calendar me-1"></i> {{ $user->created_at->format('M d, Y') }}
                                </td>
                                <td class="text-end">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#userModal" data-role="fill-modal" data-mode="edit"
                                            data-module="User" data-method="PUT"
                                            data-action="{{ route('admin.users.update', $user->id) }}"
                                            data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                                            data-role="{{ $user->role }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        @if (auth()->id() !== $user->id)
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-btn"
                                                data-url="{{ route('admin.users.destroy', $user->id) }}"
                                                data-name="{{ $user->name }}" data-token="{{ csrf_token() }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination Links -->
            @if ($users->hasPages())
                <div class="mt-4 d-flex justify-content-end">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>

    <!-- ================= User Modal ================= -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true" data-bs-theme="dark">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-card border-secondary">
                <div class="modal-header border-bottom border-secondary">
                    <h5 class="modal-title text-white">System User</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small text-muted">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control text-white" required
                                placeholder="John Doe">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Email Address <span
                                    class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control text-white" required
                                placeholder="john@example.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Access Role <span
                                    class="text-danger">*</span></label>
                            <select name="role_name" id="role" class="form-select text-white" required>
                                <option value="user">Standard User</option>
                                <option value="content_manager">Content Manager</option>
                                <option value="web_master">Web Master</option>
                                <option value="technical_administrator">Technical Administrator</option>
                                <option value="admin">Super Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Password</label>
                            <input type="password" name="password" id="password" class="form-control text-white"
                                minlength="8" placeholder="••••••••">
                            <small class="text-muted" style="font-size: 0.75rem;">
                                <i class="fa-solid fa-circle-info"></i> Required for new accounts. Leave blank when editing
                                to keep current password.
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer border-top border-secondary">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-tech">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('assets/js/crud-helper.js') }}"></script>
@endpush

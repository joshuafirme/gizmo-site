@extends('admin.layouts.app')
@section('title', 'Product Categories')
@section('panel')
    <div class="container-fluid p-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1 text-white"><i class="fa-solid fa-tags text-tech me-2"></i>Product Categories</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        </li>
                        <li class="breadcrumb-item"><a href="#" class="text-muted text-decoration-none">Products
                                Catalog</a></li>
                        <li class="breadcrumb-item active text-tech" aria-current="page">Categories</li>
                    </ol>
                </nav>
            </div>
            <button class="btn btn-tech" data-bs-toggle="modal" data-bs-target="#globalModal" data-role="fill-modal"
                data-mode="create" data-module="Product" data-action="/admin/categories">
                <i class="fa-solid fa-plus me-2"></i> Add Category
            </button>
        </div>

        @include('admin.partials.alerts')

        <!-- Data Table Card -->
        <div class="admin-card">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead class="border-bottom border-secondary" style="border-color: rgba(255,255,255,0.1) !important;">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="20%">Category Name</th>
                            <th width="20%">Slug</th>
                            <th width="30%">Description</th>
                            <th width="5%">Icon</th>
                            <th width="10%" class="text-center">Status</th>
                            <th width="10%" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Assuming $categories is passed from ProductCategoryController --}}
                        @forelse($categories as $category)
                            <tr>
                                <td class="text-muted">#{{ $category->id }}</td>
                                <td class="fw-bold text-white">{{ $category->name }}</td>
                                <td class="text-muted"><code>{{ $category->slug }}</code></td>
                                <td class="text-muted small text-truncate" style="max-width: 250px;">
                                    {{ $category->description ?? 'No description provided.' }}
                                </td>
                                <td class="text-muted"><i class="fa-solid {{ $category->icon_class }}"></i></td>
                                <td class="text-center">
                                    <!-- Status Toggle Form -->
                                    <form action="{{ route('admin.categories.toggle-status', $category->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-check form-switch d-flex justify-content-center m-0">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="statusSwitch{{ $category->id }}" onchange="this.form.submit()"
                                                {{ $category->is_active ? 'checked' : '' }}>
                                        </div>
                                    </form>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex gap-1">
                                        <!-- Edit Button triggers modal -->
                                        <button type="button" class="btn btn-sm btn-outline-primary edit-btn"
                                            data-bs-toggle="modal" data-bs-target="#globalModal" data-role="fill-modal"
                                            data-mode="edit" data-module="Category" data-method="PUT"
                                            data-action="/admin/categories/{{ $category->id }}"
                                            data-id="{{ $category->id }}" data-name="{{ $category->name }}"
                                            data-slug="{{ $category->slug }}"
                                            data-description="{{ $category->description }}"
                                            data-icon_class="{{ $category->icon_class }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-btn"
                                            data-url="{{ route('admin.categories.destroy', $category->id) }}"
                                            data-name="{{ $category->name }}" data-token="{{ csrf_token() }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <div class="py-5">
                                        <i class="fa-solid fa-folder-open fa-3x mb-3 opacity-50"></i>
                                        <h5>No Categories Found</h5>
                                        <p class="small">Click 'Add Category' to create your first product category.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            @if (isset($categories) && $categories->hasPages())
                <div class="mt-4 d-flex justify-content-end">
                    {{ $categories->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>

    <!-- ================= Modals ================= -->

    <!-- Add Category Modal -->
    <div class="modal fade" id="globalModal" tabindex="-1" aria-hidden="true" data-bs-theme="dark">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: var(--bg-card); border: 1px solid var(--border-color);">
                <div class="modal-header border-bottom border-secondary"
                    style="border-color: rgba(255,255,255,0.1) !important;">
                    <h5 class="modal-title text-white" id="addCategoryModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small text-muted">Category Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control text-white slug-source" required
                                placeholder="e.g. Servers & Storage">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">URL Slug <span class="text-danger">*</span></label>
                            <input type="text" name="slug" class="form-control text-white slug-target" required
                                placeholder="e.g. servers-storage">
                            <small class="text-muted" style="font-size: 0.75rem;">Leave blank to auto-generate from
                                name.</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Description</label>
                            <textarea name="description" class="form-control text-white" rows="3"
                                placeholder="Brief overview of this category..."></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small text-muted">Icon Class (optional)</label>
                            <input type="text" name="icon_class" class="form-control" placeholder="e.g. fa-server">
                        </div>
                        <div class="form-check form-switch mt-3">
                            <input class="form-check-input" type="checkbox" role="switch" name="is_active"
                                id="flexSwitchCheckChecked" checked value="1">
                            <label class="form-check-label small text-muted" for="flexSwitchCheckChecked">Enable category
                                immediately</label>
                        </div>
                    </div>
                    <div class="modal-footer border-top border-secondary"
                        style="border-color: rgba(255,255,255,0.1) !important;">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-tech">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/crud-helper.js?v=' . $settings->version) }}"></script>
@endpush

@extends('admin.layouts.app')
@section('title', 'Product Subcategories')
@section('panel')
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1 text-white"><i class="fa-solid fa-layer-group text-tech me-2"></i>Product Subcategories</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#" class="text-muted text-decoration-none">Products
                                Catalog</a></li>
                        <li class="breadcrumb-item active text-tech" aria-current="page">Subcategories</li>
                    </ol>
                </nav>
            </div>
            <button class="btn btn-tech" data-bs-toggle="modal" data-bs-target="#globalModal" data-role="fill-modal"
                data-mode="create" data-module="Subcategory" data-action="{{ route('admin.subcategories.store') }}">
                <i class="fa-solid fa-plus me-2"></i> Add Subcategory
            </button>
        </div>

        @include('admin.partials.alerts')

        <div class="admin-card">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead class="border-bottom border-secondary">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="15%">Parent Category</th>
                            <th width="20%">Subcategory Name</th>
                            <th width="15%">Slug</th>
                            <th width="10%" class="text-center">Status</th>
                            <th width="15%" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subcategories as $sub)
                            <tr>
                                <td class="text-muted">#{{ $sub->id }}</td>
                                <td><span class="badge bg-secondary">{{ $sub->category->name }}</span></td>
                                <td class="fw-bold text-white">{{ $sub->name }}</td>
                                <td class="text-muted"><code>{{ $sub->slug }}</code></td>
                                <td class="text-center">
                                    <form action="{{ route('admin.subcategories.toggle-status', $sub->id) }}"
                                        method="POST">
                                        @csrf @method('PATCH')
                                        <div class="form-check form-switch d-flex justify-content-center m-0">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                onchange="this.form.submit()" {{ $sub->is_active ? 'checked' : '' }}>
                                        </div>
                                    </form>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex gap-1 justify-content-end">
                                        <button type="button" class="btn btn-sm btn-outline-primary edit-btn"
                                            data-bs-toggle="modal" data-bs-target="#globalModal" data-role="fill-modal"
                                            data-mode="edit" data-module="Subcategory" data-method="PUT"
                                            data-action="{{ route('admin.subcategories.update', $sub->id) }}"
                                            data-id="{{ $sub->id }}" data-category_id="{{ $sub->category_id }}"
                                            data-name="{{ $sub->name }}" data-slug="{{ $sub->slug }}"
                                            data-description="{{ $sub->description }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-btn"
                                            data-url="{{ route('admin.subcategories.destroy', $sub->id) }}"
                                            data-name="{{ $sub->name }}" data-token="{{ csrf_token() }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">No Subcategories Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4 d-flex justify-content-end">
                {{ $subcategories->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="globalModal" tabindex="-1" aria-hidden="true" data-bs-theme="dark">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #1a1d21; border: 1px solid #343a40;">
                <div class="modal-header border-bottom border-secondary">
                    <h5 class="modal-title text-white">Add Subcategory</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small text-muted">Parent Category <span
                                    class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-select text-white" required>
                                <option value="">Select Parent Category</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Subcategory Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control text-white slug-source"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">URL Slug</label>
                            <input type="text" name="slug" class="form-control text-white slug-target">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Description</label>
                            <textarea name="description" id="description" class="form-control text-white" rows="3"></textarea>
                        </div>
                        <div class="form-check form-switch mt-3">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked
                                value="1">
                            <label class="form-check-label small text-muted" for="is_active">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer border-top border-secondary">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-tech">Save Subcategory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/crud-helper.js') }}"></script>
@endpush

@extends('admin.layouts.app')

@section('panel')
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1 text-white"><i class="fa-solid fa-box text-tech me-2"></i>Product Catalog</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#" class="text-muted text-decoration-none">Catalog</a></li>
                        <li class="breadcrumb-item active text-tech">Products</li>
                    </ol>
                </nav>
            </div>
            <button class="btn btn-tech" data-bs-toggle="modal" data-bs-target="#productModal" data-role="fill-modal"
                data-mode="create" data-module="Product" data-action="{{ route('admin.products.store') }}">
                <i class="fa-solid fa-plus me-2"></i> Add Product
            </button>
        </div>

        @include('admin.partials.alerts')

        <div class="admin-card">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="5%">Info</th>
                            <th width="20%">Product</th>
                            <th width="15%">Subcategory</th>
                            <th width="10%" class="text-center">Featured</th>
                            <th width="10%" class="text-center">Active</th>
                            <th width="15%" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    @if ($product->image_path)
                                        <img src="{{ asset('storage/' . $product->image_path) }}"
                                            class="rounded border border-secondary" width="40" height="40"
                                            style="object-fit: cover;">
                                    @else
                                        <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                                            style="width:40px; height:40px;">
                                            <i class="fa-solid {{ $product->icon_class ?? 'fa-image' }} text-white-50"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="text-white fw-bold">{{ $product->name }}</div>
                                    <small class="text-muted"><code>{{ $product->slug }}</code></small>
                                </td>
                                <td><span class="badge bg-info text-dark">{{ $product->subcategory?->name }}</span></td>
                                <td class="text-center">
                                    <form action="{{ route('admin.products.toggle', [$product->id, 'is_featured']) }}"
                                        method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit"
                                            class="btn btn-sm {{ $product->is_featured ? 'text-warning' : 'text-muted' }}">
                                            <i class="fa-solid fa-star fa-lg"></i>
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('admin.products.toggle', [$product->id, 'is_active']) }}"
                                        method="POST">
                                        @csrf @method('PATCH')
                                        <div class="form-check form-switch d-inline-block">
                                            <input class="form-check-input" type="checkbox" onchange="this.form.submit()"
                                                {{ $product->is_active ? 'checked' : '' }}>
                                        </div>
                                    </form>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#productModal" data-role="fill-modal" data-mode="edit"
                                            data-module="Product" data-method="PUT"
                                            data-action="{{ route('admin.products.update', $product->id) }}"
                                            data-subcategory_id="{{ $product->subcategory_id }}"
                                            data-name="{{ $product->name }}" data-slug="{{ $product->slug }}"
                                            data-icon_class="{{ $product->icon_class }}"
                                            data-is_featured="{{ $product->is_featured }}"
                                            data-is_active="{{ $product->is_active }}"
                                            data-description="{{ $product->description }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger delete-btn"
                                            data-url="{{ route('admin.products.destroy', $product->id) }}"
                                            data-name="{{ $product->name }}" data-token="{{ csrf_token() }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Product Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true" data-bs-theme="dark">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-card border-secondary">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Subcategory</label>
                                <select name="subcategory_id" class="form-select" required>
                                    @foreach ($subcategories as $sub)
                                        <option value="{{ $sub->id }}">{{ $sub->category->name }} >
                                            {{ $sub->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Icon Class (optional)</label>
                                <input type="text" name="icon_class" class="form-control"
                                    placeholder="e.g. fa-server">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Name</label>
                                <input type="text" name="name" class="form-control slug-source" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Slug</label>
                                <input type="text" name="slug" class="form-control slug-target" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label small text-muted">Description</label>
                                <textarea name="description" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Product Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-3 mt-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_featured" id="feat_check"
                                        value="1">
                                    <label class="form-check-label" for="feat_check">Featured</label>
                                </div>
                            </div>
                            <div class="col-md-3 mt-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="act_check"
                                        checked value="1">
                                    <label class="form-check-label" for="act_check">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="submit" class="btn btn-tech">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="{{asset('assets/js/crud-helper.js')}}"></script>
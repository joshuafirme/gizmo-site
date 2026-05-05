@extends('admin.layouts.app')

@section('panel')
    <div class="container-fluid p-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1 text-white"><i class="fa-solid fa-images text-tech me-2"></i>Hero Sliders</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#" class="text-muted text-decoration-none">Frontend</a></li>
                        <li class="breadcrumb-item active text-tech">Hero Section</li>
                    </ol>
                </nav>
            </div>
            <button class="btn btn-tech" data-bs-toggle="modal" data-bs-target="#sliderModal" data-role="fill-modal"
                data-mode="create" data-module="Slider" data-action="{{ route('admin.sliders.store') }}">
                <i class="fa-solid fa-plus me-2"></i> Add New Slide
            </button>
        </div>

        @include('admin.partials.alerts')
        
        <!-- Table -->
        <div class="admin-card">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="5%">Order</th>
                            <th width="15%">Preview</th>
                            <th width="25%">Content</th>
                            <th width="20%">Button</th>
                            <th width="10%" class="text-center">Status</th>
                            <th width="15%" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sliders as $slider)
                            <tr>
                                <td class="text-muted fw-bold">#{{ $slider->display_order }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $slider->image_path) }}"
                                        class="rounded border border-secondary" width="120" height="60"
                                        style="object-fit: cover;">
                                </td>
                                <td>
                                    <span class="badge bg-tech-outline mb-1">{{ $slider->title_badge }}</span>
                                    <div class="text-white fw-bold">{{ $slider->heading }}</div>
                                </td>
                                <td>
                                    @if ($slider->button_text)
                                        <a href="{{ $slider->button_link }}" target="_blank"
                                            class="btn btn-sm btn-outline-light">
                                            {{ $slider->button_text }}
                                        </a>
                                    @else
                                        <span class="text-muted small italic">No button</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('admin.sliders.toggle-status', $slider->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <div class="form-check form-switch d-inline-block">
                                            <input class="form-check-input" type="checkbox" onchange="this.form.submit()"
                                                {{ $slider->is_active ? 'checked' : '' }}>
                                        </div>
                                    </form>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#sliderModal" data-role="fill-modal" data-mode="edit"
                                            data-module="Slider" data-method="PUT"
                                            data-action="{{ route('admin.sliders.update', $slider->id) }}"
                                            data-title_badge="{{ $slider->title_badge }}"
                                            data-heading="{{ $slider->heading }}"
                                            data-description="{{ $slider->description }}"
                                            data-button_text="{{ $slider->button_text }}"
                                            data-button_link="{{ $slider->button_link }}"
                                            data-display_order="{{ $slider->display_order }}"
                                            data-is_active="{{ $slider->is_active }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger delete-btn"
                                            data-url="{{ route('admin.sliders.destroy', $slider->id) }}"
                                            data-name="Slide #{{ $slider->display_order }}"
                                            data-token="{{ csrf_token() }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">No slides found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="sliderModal" tabindex="-1" aria-hidden="true" data-bs-theme="dark">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-card border-secondary">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Slider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label small text-muted">Badge Title</label>
                                <input type="text" name="title_badge" class="form-control"
                                    placeholder="e.g. Enterprise Architecture" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label small text-muted">Display Order</label>
                                <input type="number" name="display_order" class="form-control" value="0" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label small text-muted">Heading</label>
                                <input type="text" name="heading" class="form-control" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label small text-muted">Description</label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Button Text</label>
                                <input type="text" name="button_text" class="form-control"
                                    placeholder="e.g. Learn More">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Button Link</label>
                                <input type="text" name="button_link" class="form-control"
                                    placeholder="e.g. /services/consulting">
                            </div>
                            <div class="col-md-8 mb-3">
                                <label class="form-label small text-muted">Slide Image (1920x1080 recommended)</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="form-check form-switch pt-2">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="slide_active"
                                        checked value="1">
                                    <label class="form-check-label" for="slide_active">Active Status</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="submit" class="btn btn-tech">Save Slide</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="{{ asset('assets/js/crud-helper.js') }}"></script>

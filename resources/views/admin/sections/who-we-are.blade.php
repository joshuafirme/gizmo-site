@extends('admin.layouts.app')

@section('panel')
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1 text-white"><i class="fa-solid fa-address-card text-tech me-2"></i>Who We Are</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active text-tech">About Section</li>
                    </ol>
                </nav>
            </div>
            <button class="btn btn-tech" data-bs-toggle="modal" data-bs-target="#aboutModal" data-role="fill-modal"
                data-mode="create" data-module="About Section" data-action="{{ route('admin.who-we-are.store') }}">
                <i class="fa-solid fa-plus me-2"></i> Add Section
            </button>
        </div>

        @include('admin.partials.alerts')

        <div class="admin-card">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="15%">Badge</th>
                            <th width="30%">Heading</th>
                            <th width="10%">Bullets</th>
                            <th width="10%">Status</th>
                            <th width="15%" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sections as $item)
                            <tr>
                                <td><span class="badge bg-secondary">{{ $item->badge_text }}</span></td>
                                <td class="text-white fw-bold">{{ $item->heading }}</td>
                                <td><span class="badge bg-info">{{ count($item->bullet_points ?? []) }} Items</span></td>
                                <td>
                                    <span class="badge {{ $item->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $item->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#aboutModal" data-role="fill-modal" data-mode="edit"
                                            data-module="About" data-method="PUT"
                                            data-action="{{ route('admin.who-we-are.update', $item->id) }}"
                                            data-badge_text="{{ $item->badge_text }}" data-heading="{{ $item->heading }}"
                                            data-main_content="{{ $item->main_content }}"
                                            data-bullets="{{ json_encode($item->bullet_points) }}"
                                            data-is_active="{{ $item->is_active }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger delete-btn"
                                            data-url="{{ route('admin.who-we-are.destroy', $item->id) }}"
                                            data-name="Section">
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

    <!-- Modal -->
    <div class="modal fade" id="aboutModal" tabindex="-1" aria-hidden="true" data-bs-theme="dark">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-card border-secondary">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Who We Are</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label small text-muted">Badge Text</label>
                                <input type="text" name="badge_text" class="form-control" value="Who We Are">
                            </div>
                            <div class="col-md-8 mb-3">
                                <label class="form-label small text-muted">Heading</label>
                                <input type="text" name="heading" class="form-control" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label small text-muted">Main Content</label>
                                <textarea name="main_content" id="editor" class="form-control"></textarea>
                            </div>

                            <!-- Dynamic Bullet Points -->
                            <div class="col-12 mb-3">
                                <label class="form-label small text-muted d-flex justify-content-between">
                                    Bullet Points (Features)
                                    <button type="button" class="btn btn-sm btn-tech py-0" id="add-bullet"><i
                                            class="fa-solid fa-plus"></i></button>
                                </label>
                                <div id="bullet-container">
                                    <div class="input-group mb-2 bullet-row">
                                        <input type="text" name="bullet_points[]" class="form-control"
                                            placeholder="Enter feature...">
                                        <button class="btn btn-outline-danger remove-bullet" type="button"><i
                                                class="fa-solid fa-xmark"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="about_active"
                                        checked value="1">
                                    <label class="form-check-label" for="about_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="submit" class="btn btn-tech">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="{{ asset('assets/js/crud-helper.js') }}"></script>

{{-- <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script> --}}
<script>
    // let editorInstance;
    // ClassicEditor.create(document.querySelector('#editor')).then(editor => { editorInstance = editor; });

    $(document).ready(function() {
        // Add Bullet Row
        $(document).on('click', '#add-bullet', function() {
            $('#bullet-container').append(`
                <div class="input-group mb-2 bullet-row">
                    <input type="text" name="bullet_points[]" class="form-control" placeholder="Enter feature...">
                    <button class="btn btn-outline-danger remove-bullet" type="button"><i class="fa-solid fa-xmark"></i></button>
                </div>
            `);
        });

        // Remove Bullet Row
        $(document).on('click', '.remove-bullet', function() {
            if ($('.bullet-row').length > 1) $(this).closest('.bullet-row').remove();
        });

        // Fill Modal Override for Bullets and Editor
        $(document).on('click', '[data-role="fill-modal"]', function() {
            const data = $(this).data();

            // Set CKEditor content
            // if(editorInstance) {
            //     editorInstance.setData(data.main_content || '');
            // }

            // Handle Bullet Points
            $('#bullet-container').html('');
            let bullets = data.bullets ? (typeof data.bullets === 'string' ? JSON.parse(data.bullets) :
                data.bullets) : [''];

            if (bullets.length === 0) bullets = [''];

            bullets.forEach(val => {
                $('#bullet-container').append(`
                    <div class="input-group mb-2 bullet-row">
                        <input type="text" name="bullet_points[]" class="form-control" value="${val}" placeholder="Enter feature...">
                        <button class="btn btn-outline-danger remove-bullet" type="button"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                `);
            });
        });
    });
</script>

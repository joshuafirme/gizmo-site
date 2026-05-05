@extends('admin.layouts.app')

@section('panel')
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1 text-white"><i class="fa-solid fa-circle-info text-tech me-2"></i>About Us Management</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active text-tech">Core Identity</li>
                    </ol>
                </nav>
            </div>
            <button class="btn btn-tech" data-bs-toggle="modal" data-bs-target="#aboutUsModal" data-role="fill-modal"
                data-mode="create" data-module="About Entry" data-action="{{ route('admin.about-us.store') }}">
                <i class="fa-solid fa-plus me-2"></i> Add Identity Section
            </button>
        </div>

        @include('admin.partials.alerts')
        <div class="admin-card">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="20%">Section Title</th>
                            <th width="30%">Mission / Vision</th>
                            <th width="20%">Core Values</th>
                            <th width="10%">Status</th>
                            <th width="15%" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($entries as $item)
                            @php $content = is_array($item->json_content) ? $item->json_content : json_decode($item->json_content, true); @endphp
                            <tr>
                                <td class="text-white fw-bold">{{ $item->section_title }}</td>
                                <td>
                                    <div class="small text-truncate" style="max-width: 250px;"><strong
                                            class="text-tech">M:</strong> {{ $content['mission'] ?? '' }}</div>
                                    <div class="small text-truncate" style="max-width: 250px;"><strong
                                            class="text-tech">V:</strong> {{ $content['vision'] ?? '' }}</div>
                                </td>
                                <td>
                                    @foreach ($content['values'] ?? [] as $val)
                                        <span class="badge bg-secondary mb-1">{{ $val }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <span class="badge {{ $item->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $item->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#aboutUsModal" data-role="fill-modal" data-mode="edit"
                                            data-module="About Entry" data-method="PUT"
                                            data-action="{{ route('admin.about-us.update', $item->id) }}"
                                            data-section_title="{{ $item->section_title }}"
                                            data-mission="{{ $content['mission'] ?? '' }}"
                                            data-vision="{{ $content['vision'] ?? '' }}"
                                            data-values="{{ json_encode($content['values'] ?? []) }}"
                                            data-is_active="{{ $item->is_active }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger delete-btn"
                                            data-url="{{ route('admin.about-us.destroy', $item->id) }}"
                                            data-name="{{ $item->section_title }}">
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

    <div class="modal fade" id="aboutUsModal" tabindex="-1" aria-hidden="true" data-bs-theme="dark">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-card border-secondary">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">About Us Entry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small text-muted">Section Title</label>
                            <input type="text" name="section_title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Mission Statement</label>
                            <textarea name="mission" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Vision Statement</label>
                            <textarea name="vision" class="form-control" rows="2" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small text-muted d-flex justify-content-between">
                                Core Values
                                <button type="button" class="btn btn-sm btn-tech py-0" id="add-value"><i
                                        class="fa-solid fa-plus"></i></button>
                            </label>
                            <div id="values-container">
                            </div>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="about-us_active" checked
                                value="1">
                            <label class="form-check-label" for="about-us_active">Active Status</label>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="submit" class="btn btn-tech">Update Identity</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script src="{{ asset('assets/js/crud-helper.js') }}"></script>
    <script>
        $(document).ready(function() {
            function createValueRow(val = '') {
                return `
                <div class="input-group mb-2 value-row">
                    <input type="text" name="values[]" class="form-control" value="${val}" placeholder="e.g. Integrity">
                    <button class="btn btn-outline-danger remove-value" type="button"><i class="fa-solid fa-xmark"></i></button>
                </div>`;
            }

            $('#add-value').click(function() {
                $('#values-container').append(createValueRow());
            });

            $(document).on('click', '.remove-value', function() {
                $(this).closest('.value-row').remove();
            });

            // Override fill-modal for JSON values
            $(document).on('click', '[data-role="fill-modal"]', function() {
                const data = $(this).data();
                $('#values-container').html('');

                let values = [];
                try {
                    values = typeof data.values === 'string' ? JSON.parse(data.values) : data.values;
                } catch (e) {
                    values = [];
                }

                if (!values || values.length === 0) values = [''];

                values.forEach(v => {
                    $('#values-container').append(createValueRow(v));
                });
            });
        });
    </script>
@endpush

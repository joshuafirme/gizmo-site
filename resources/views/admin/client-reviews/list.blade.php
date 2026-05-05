@extends('admin.layouts.app')

@section('panel')
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1 text-white"><i class="fa-solid fa-comment-dots text-tech me-2"></i>Client Reviews</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active text-tech">Testimonials</li>
                    </ol>
                </nav>
            </div>
            <button class="btn btn-tech" data-bs-toggle="modal" data-bs-target="#reviewModal" data-role="fill-modal"
                data-mode="create" data-module="Client Review" data-action="{{ route('admin.client-reviews.store') }}">
                <i class="fa-solid fa-plus me-2"></i> Add Review
            </button>
        </div>

        <div class="admin-card">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="10%">Client</th>
                            <th width="20%">Name & Company</th>
                            <th width="35%">Review</th>
                            <th width="10%">Rating</th>
                            <th width="10%">Status</th>
                            <th width="15%" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $review)
                            <tr>
                                <td>
                                    <img src="{{ $review->image_path ? asset('storage/' . $review->image_path) : 'https://ui-avatars.com/api/?name=' . urlencode($review->client_name) }}"
                                        class="rounded-circle border border-secondary" width="45" height="45"
                                        style="object-fit: cover;">
                                </td>
                                <td>
                                    <div class="text-white fw-bold">{{ $review->client_name }}</div>
                                    <small class="text-muted">{{ $review->position_company }}</small>
                                </td>
                                <td>
                                    <p class="small text-muted mb-0 text-truncate" style="max-width: 300px;">
                                        "{{ $review->review_text }}"</p>
                                </td>
                                <td>
                                    <span class="text-warning small">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa-{{ $i <= $review->rating ? 'solid' : 'regular' }} fa-star"></i>
                                        @endfor
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $review->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $review->is_active ? 'Visible' : 'Hidden' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#reviewModal" data-role="fill-modal" data-mode="edit"
                                            data-module="Review" data-method="PUT"
                                            data-action="{{ route('admin.client-reviews.update', $review->id) }}"
                                            data-client_name="{{ $review->client_name }}"
                                            data-position_company="{{ $review->position_company }}"
                                            data-review_text="{{ $review->review_text }}"
                                            data-rating="{{ $review->rating }}" data-is_active="{{ $review->is_active }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger delete-btn"
                                            data-url="{{ route('admin.client-reviews.destroy', $review->id) }}"
                                            data-name="{{ $review->client_name }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $reviews->links() }}</div>
        </div>
    </div>

    <!-- Review Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-hidden="true" data-bs-theme="dark">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-card border-secondary">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Client Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label small text-muted">Client Name</label>
                                <input type="text" name="client_name" class="form-control" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label small text-muted">Position & Company</label>
                                <input type="text" name="position_company" class="form-control"
                                    placeholder="e.g. CEO, Tech Solutions" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Rating (1-5)</label>
                                <select name="rating" class="form-select">
                                    <option value="5.0">5 Stars</option>
                                    <option value="4.0">4 Stars</option>
                                    <option value="3.0">3 Stars</option>
                                    <option value="2.0">2 Stars</option>
                                    <option value="1.0">1 Star</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Profile Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label small text-muted">Review Content</label>
                                <textarea name="review_text" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="rev_active"
                                        checked value="1">
                                    <label class="form-check-label" for="rev_active">Publish Review</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="submit" class="btn btn-tech">Save Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="{{ asset('assets/js/crud-helper.js') }}"></script>

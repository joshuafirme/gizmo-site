@extends('admin.layouts.app')

@section('panel')
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1 text-white">
                    <i class="fa-solid fa-inbox text-tech me-2"></i>Contact Messages
                    @if ($unreadCount > 0)
                        <span class="badge bg-danger ms-2" style="font-size: 0.8rem;">{{ $unreadCount }} New</span>
                    @endif
                </h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#"
                                class="text-muted text-decoration-none">Communication</a></li>
                        <li class="breadcrumb-item active text-tech">Inquiries</li>
                    </ol>
                </nav>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show bg-success text-white border-0" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="admin-card border-secondary rounded"
            style="background-color: var(--bg-card); border: 1px solid rgba(255,255,255,0.1);">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead class="border-bottom border-secondary">
                        <tr>
                            <th width="5%">Status</th>
                            <th width="20%">Sender</th>
                            <th width="20%">Company / Subject</th>
                            <th width="30%">Message Preview</th>
                            <th width="10%">Received</th>
                            <th width="15%" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $msg)
                            <tr class="{{ $msg->is_read ? '' : 'bg-dark border-start border-primary border-4' }}">
                                <td class="text-center">
                                    <form action="{{ route('admin.messages.toggle-read', $msg->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-link text-decoration-none p-0">
                                            @if ($msg->is_read)
                                                <i class="fa-regular fa-envelope-open text-muted"
                                                    title="Mark as unread"></i>
                                            @else
                                                <i class="fa-solid fa-envelope text-tech" title="Mark as read"></i>
                                            @endif
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <div class="fw-bold {{ $msg->is_read ? 'text-muted' : 'text-white' }}">
                                        {{ $msg->name }}</div>
                                    <div class="small text-muted"><a href="mailto:{{ $msg->email }}"
                                            class="text-tech-alt text-decoration-none">{{ $msg->email }}</a></div>
                                </td>
                                <td>
                                    <span class="badge bg-secondary text-truncate"
                                        style="max-width: 150px;">{{ $msg->subject ?? 'No Subject' }}</span>
                                </td>
                                <td>
                                    <div class="small text-muted text-truncate" style="max-width: 300px;">
                                        {{ $msg->message }}
                                    </div>
                                </td>
                                <td class="text-muted small">
                                    {{ $msg->created_at->diffForHumans() }}
                                </td>
                                <td class="text-end">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                            data-bs-target="#readMessageModal" data-role="fill-modal" data-mode="read"
                                            data-module="Message" data-name="{{ $msg->name }}"
                                            data-email="{{ $msg->email }}" data-subject="{{ $msg->subject }}"
                                            data-date="{{ $msg->created_at->format('F d, Y \a\t h:i A') }}"
                                            data-message="{{ $msg->message }}">
                                            <i class="fa-solid fa-eye"></i> Read
                                        </button>

                                        <button type="button" class="btn btn-sm btn-outline-danger delete-btn"
                                            data-url="{{ route('admin.messages.destroy', $msg->id) }}"
                                            data-name="message from {{ $msg->name }}" data-token="{{ csrf_token() }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    <i class="fa-solid fa-inbox fa-3x mb-3 opacity-50"></i>
                                    <h5>Inbox is Empty</h5>
                                    <p class="small">No contact messages or inquiries have been received yet.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($messages->hasPages())
                <div class="mt-4 p-3 d-flex justify-content-end border-top border-secondary">
                    {{ $messages->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="readMessageModal" tabindex="-1" aria-hidden="true" data-bs-theme="dark">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-card border-secondary">
                <div class="modal-header border-bottom border-secondary">
                    <h5 class="modal-title text-white"><i class="fa-solid fa-envelope-open-text me-2 text-tech"></i> Message
                        Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row mb-4 bg-dark p-3 rounded border border-secondary mx-0">
                        <div class="col-md-6 mb-2 mb-md-0">
                            <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">From</small>
                            <span class="text-white fw-bold d-block" id="name"></span>
                            <a href="" id="email-link" class="text-tech text-decoration-none small"></a>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <small class="text-muted d-block text-uppercase fw-bold"
                                style="font-size: 0.7rem;">Received</small>
                            <span class="text-white small" id="date"></span>
                            <div class="mt-1">
                                <span class="badge bg-secondary" id="subject"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-2">
                        <small class="text-muted d-block text-uppercase fw-bold mb-2" style="font-size: 0.7rem;">Message
                            Content</small>
                        <div class="text-white p-3 rounded"
                            style="background-color: #212529; min-height: 150px; white-space: pre-wrap;" id="message">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top border-secondary">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="#" id="reply-btn" class="btn btn-tech"><i class="fa-solid fa-reply me-2"></i> Reply
                        via Email</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/crud-helper.js?v=' . $settings->version) }}"></script>
    <script>
        $(document).ready(function() {
            // Intercept the global fill-modal logic specifically for the Read Message modal
            $(document).on('click', '[data-bs-target="#readMessageModal"]', function() {
                const data = $(this).data();
                // Populate the modal fields
                $('#readMessageModal #name').text(data.name);
                $('#readMessageModal #email-link').text(data.email).attr('href', 'mailto:' + data.email);
                $('#readMessageModal #subject').text(data.subject || 'No Company/Subject Provided');
                $('#readMessageModal #date').text(data.date);
                $('#readMessageModal #message').text(data.message); // text() automatically sanitizes output

                // Set up the reply button mailto link
                const replySubject = encodeURIComponent('Re: Inquiry to Gizmo Systems');
                $('#readMessageModal #reply-btn').attr('href',
                    `mailto:${data.email}?subject=${replySubject}`);
            });
        });
    </script>
@endpush

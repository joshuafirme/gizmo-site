        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show bg-success text-white border-0" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @elseif(session('danger'))
            <div class="alert alert-danger alert-dismissible fade show bg-danger text-white border-0" role="alert">
                <i class="fa-solid fa-circle-x me-2"></i>{{ session('danger') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif

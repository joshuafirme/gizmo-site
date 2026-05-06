@extends('admin.layouts.app')

@section('panel')
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1 text-white"><i class="fa-solid fa-cogs text-tech me-2"></i>System Settings</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#"
                                class="text-muted text-decoration-none">Administration</a></li>
                        <li class="breadcrumb-item active text-tech">Global Configurations</li>
                    </ol>
                </nav>
            </div>
            <button type="submit" form="settingsForm" class="btn btn-tech px-4">
                <i class="fa-solid fa-floppy-disk me-2"></i> Save & Apply Settings
            </button>
        </div>

        @include('admin.partials.alerts')
        <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data" id="settingsForm">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="admin-card mb-4 border-secondary p-4 rounded"
                        style="background-color: var(--bg-card); border: 1px solid rgba(255,255,255,0.1);">
                        <h5 class="text-white border-bottom border-secondary pb-3 mb-4"><i
                                class="fa-solid fa-cube me-2"></i>General Information</h5>
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label small text-muted">Application Name</label>
                                <input type="text" name="app_name" class="form-control text-white"
                                    value="{{ old('app_name', $settings->app_name ?? 'Gizmo Systems') }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label small text-muted">Version</label>
                                <input type="text" name="version" class="form-control text-white"
                                    value="{{ old('version', $settings->version ?? '1.0.0') }}" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label small text-muted">System Description (Meta)</label>
                                <textarea name="description" class="form-control text-white" rows="3">{{ old('description', $settings->description) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="admin-card border-secondary p-4 rounded"
                        style="background-color: var(--bg-card); border: 1px solid rgba(255,255,255,0.1);">
                        <h5 class="text-white border-bottom border-secondary pb-3 mb-4"><i
                                class="fa-solid fa-address-book me-2"></i>Contact & Social</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Contact Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark border-secondary text-muted"><i
                                            class="fa-solid fa-envelope"></i></span>
                                    <input type="email" name="contact_email" class="form-control text-white"
                                        value="{{ old('contact_email', $settings->contact_email) }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Contact Phone</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark border-secondary text-muted"><i
                                            class="fa-solid fa-phone"></i></span>
                                    <input type="text" name="contact_phone" class="form-control text-white"
                                        value="{{ old('contact_phone', $settings->contact_phone) }}">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label small text-muted">Facebook URL</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark border-secondary text-muted"><i
                                            class="fa-brands fa-facebook-f"></i></span>
                                    <input type="url" name="facebook_url" class="form-control text-white"
                                        value="{{ old('facebook_url', $settings->facebook_url) }}">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label small text-muted">Twitter URL</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark border-secondary text-muted"><i
                                            class="fa-brands fa-twitter"></i></span>
                                    <input type="url" name="twitter_url" class="form-control text-white"
                                        value="{{ old('twitter_url', $settings->twitter_url) }}">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label small text-muted">LinkedIn URL</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark border-secondary text-muted"><i
                                            class="fa-brands fa-linkedin-in"></i></span>
                                    <input type="url" name="linkedin_url" class="form-control text-white"
                                        value="{{ old('linkedin_url', $settings->linkedin_url) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="admin-card border-secondary p-4 rounded h-100"
                        style="background-color: var(--bg-card); border: 1px solid rgba(255,255,255,0.1);">
                        <h5 class="text-white border-bottom border-secondary pb-3 mb-4"><i
                                class="fa-solid fa-images me-2"></i>Brand Assets</h5>

                        <div class="mb-4">
                            <label class="form-label small text-muted d-block">Main Logo</label>
                            <div class="bg-dark rounded border border-secondary d-flex align-items-center justify-content-center p-3 mb-2"
                                style="height: 120px;">
                                @if ($settings->logo_path)
                                    <img src="{{ asset('storage/' . $settings->logo_path) }}" alt="Logo"
                                        class="img-fluid" style="max-height: 90px;">
                                @else
                                    <span class="text-muted small"><i
                                            class="fa-solid fa-image fa-2x mb-2 d-block text-center"></i>No Logo
                                        Uploaded</span>
                                @endif
                            </div>
                            <input type="file" name="logo" class="form-control form-control-sm text-white">
                            <small class="text-muted" style="font-size: 0.75rem;">Leave blank to keep current
                                logo.</small>
                        </div>

                        <hr class="border-secondary mb-4">
                        <div class="mb-3">
                            <label class="form-label small text-muted d-block">Favicon</label>
                            <div class="bg-dark rounded border border-secondary d-flex align-items-center justify-content-center p-3 mb-2"
                                style="height: 80px; width: 80px;">
                                @if ($settings->favicon_path)
                                    <img src="{{ asset('storage/' . $settings->favicon_path) }}" alt="Favicon"
                                        class="img-fluid" style="max-height: 48px;">
                                @else
                                    <span class="text-muted small"><i class="fa-solid fa-globe"></i></span>
                                @endif
                            </div>
                            <input type="file" name="favicon" class="form-control form-control-sm text-white">
                            <small class="text-muted" style="font-size: 0.75rem;">Recommended: 32x32px or 64x64px (.ico or
                                .png)</small>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

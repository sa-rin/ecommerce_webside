@extends('layouts.admin')
@section('title', 'Footer Settings')
@section('subtitle', 'Manage company information, support channels, and legal text')

@section('actions')
    <a href="{{ route('footer.list') }}" class="btn btn-light rounded-pill px-4 shadow-sm border">
        <i class="bi bi-arrow-left me-1"></i> View Footer Records
    </a>
@endsection

@section('content')
<div class="p-4 p-lg-5">
    <form action="{{ route('footer.update') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $Footer->id }}">

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-4 d-flex align-items-center">
                            <i class="bi bi-info-circle text-primary me-2"></i> Company Information
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label text-muted small fw-bold">Company Name</label>
                                <input type="text" name="CompanyName" class="form-control form-control-premium" value="{{ $Footer->CompanyName }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold">Email Address</label>
                                <input type="email" name="Email" class="form-control form-control-premium" value="{{ $Footer->Email }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold">Phone Number</label>
                                <input type="text" name="Phone" class="form-control form-control-premium" value="{{ $Footer->Phone }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label text-muted small fw-bold">Physical Address</label>
                                <textarea name="Address" class="form-control form-control-premium" rows="2">{{ $Footer->Address }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-4 d-flex align-items-center">
                            <i class="bi bi-share text-primary me-2"></i> Social Media (URLs)
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold"><i class="bi bi-facebook me-1"></i> Facebook</label>
                                <input type="text" name="Facebook" class="form-control form-control-premium" value="{{ $Footer->Facebook }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold"><i class="bi bi-telegram me-1"></i> Telegram</label>
                                <input type="text" name="Telegram" class="form-control form-control-premium" value="{{ $Footer->Telegram }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label text-muted small fw-bold"><i class="bi bi-youtube me-1"></i> Youtube Channel</label>
                                <input type="text" name="Youtube" class="form-control form-control-premium" value="{{ $Footer->Youtube }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-4 d-flex align-items-center">
                            <i class="bi bi-gear-wide-connected text-primary me-2"></i> General Settings
                        </h6>
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">Copyright Statement</label>
                            <input type="text" name="Copyright" class="form-control form-control-premium" value="{{ $Footer->Copyright }}">
                        </div>
                        <div>
                            <label class="form-label text-muted small fw-bold">Deployment Status</label>
                            <select name="IsActive" class="form-select form-control-premium shadow-none">
                                <option value="1" {{ $Footer->IsActive ? 'selected':'' }}>Active & Public</option>
                                <option value="0" {{ !$Footer->IsActive ? 'selected':'' }}>Draft / Hidden</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="p-4 rounded-4 bg-primary-subtle border border-primary-subtle text-primary-emphasis opacity-75">
                    <i class="bi bi-magic fs-3 mb-2 d-block"></i>
                    <h6 class="fw-bold">Make it Professional</h6>
                    <p class="small mb-0">Ensure all social media links are full URLs (starting with https://). This information will appear at the bottom of every page.</p>
                </div>
            </div>
        </div>

        <div class="mt-5 pt-4 border-top d-flex justify-content-end gap-3">
            <button type="submit" class="btn btn-premium-primary px-5 rounded-pill">
                <i class="bi bi-check2-all me-1"></i> Save Footer Settings
            </button>
        </div>
    </form>
</div>
@endsection
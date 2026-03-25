@extends('layouts.admin')
@section('title', 'Create Slider')
@section('subtitle', 'Create slider image for homepage carousel')

@section('actions')
    <a href="{{ route('slider.list') }}" class="btn btn-light rounded-pill px-4 shadow-sm border">
        <i class="bi bi-arrow-left me-1"></i> Back to List
    </a>
@endsection

@section('content')
<div class="p-4 p-lg-5">
    <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark">Slider Title</label>
                        <input type="text" name="Title" class="form-control form-control-premium" 
                               value="{{ old('Title') }}" placeholder="Main catchy title">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark">Sub Title</label>
                        <input type="text" name="SubTitle" class="form-control form-control-premium" 
                               value="{{ old('SubTitle') }}" placeholder="Secondary descriptive text">
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-12">
                        <label class="form-label fw-bold text-dark">Destination Link (optional)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-link-45deg"></i></span>
                            <input type="text" name="Link" class="form-control form-control-premium border-start-0" 
                                   value="{{ old('Link') }}" placeholder="https://ecommerce.com/collection">
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark">Sort Order</label>
                        <input type="number" name="SortOrder" class="form-control form-control-premium" value="{{ old('SortOrder',0) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark">Status</label>
                        <select name="IsActive" class="form-select form-control-premium shadow-none">
                            <option value="1" selected>Active</option>
                            <option value="0">Disabled</option>
                        </select>
                    </div>
                </div>

                <div class="p-4 rounded-4 border border-dashed bg-light bg-opacity-50 text-center mb-0">
                    <i class="bi bi-cloud-arrow-up fs-1 text-primary mb-2 d-block"></i>
                    <h6 class="fw-bold text-dark">Hero Background</h6>
                    <p class="small text-muted mb-3">Upload a high-quality landscape image (Recommended: 1920x800px)</p>
                    <div class="mx-auto" style="max-width: 300px;">
                        <input type="file" name="SliderImage" class="form-control form-control-sm" 
                               accept="image/*" onchange="previewImg(event,'sliderPreview')" required>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <label class="form-label fw-bold text-dark mb-3">Slider Preview</label>
                <div class="ratio ratio-16x9 border rounded-4 bg-white shadow-sm overflow-hidden d-flex align-items-center justify-content-center">
                    <div id="sliderPreviewPlaceholder" class="position-absolute text-center opacity-25">
                        <i class="bi bi-image fs-1 d-block mb-1"></i>
                        <div class="small fw-bold">Live Preview</div>
                    </div>
                    <img id="sliderPreview" src="" class="img-fluid d-none" style="object-fit: cover; z-index: 1;">
                </div>
                <div class="mt-3 p-3 rounded-4 bg-primary-subtle border border-primary-subtle text-primary small">
                    <i class="bi bi-info-circle-fill me-1"></i>
                    Hero sliders are the first thing users see. Use high-resolution images for the best impact.
                </div>
            </div>
        </div>

        <div class="mt-5 pt-4 border-top d-flex justify-content-end gap-3">
            <a href="{{ route('slider.list') }}" class="btn btn-light px-4 rounded-pill border fw-semibold">
                Cancel
            </a>
            <button type="submit" class="btn btn-premium-primary px-5 rounded-pill">
                <i class="bi bi-view-carousel me-1"></i> Create Slider
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function previewImg(event, id){
    const img = document.getElementById(id);
    const placeholder = document.getElementById(id + 'Placeholder');
    const file = event.target.files?.[0];
    
    if(!file) { 
        img.classList.add('d-none'); 
        img.src = ""; 
        if (placeholder) placeholder.style.display = 'block';
        return; 
    }
    
    img.src = URL.createObjectURL(file);
    img.classList.remove('d-none');
    if (placeholder) placeholder.style.display = 'none';
}
</script>
@endpush
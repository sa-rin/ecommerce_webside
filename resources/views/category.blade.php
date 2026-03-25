@extends('layouts.admin')
@section('title', 'Create Category')
@section('subtitle', 'Add a new product category to your store')

@section('actions')
    <a href="{{ route('category.list') }}" class="btn btn-light rounded-pill px-4 shadow-sm border">
        <i class="bi bi-arrow-left me-1"></i> Back to List
    </a>
@endsection

@section('content')
<div class="p-4 p-lg-5">
    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="CategoryName" class="form-control form-control-premium"
                           value="{{ old('CategoryName') }}" placeholder="e.g. Electronics, Clothing" required>
                    <div class="form-text text-muted">Give your category a unique and descriptive name.</div>
                </div>

                <div class="p-4 rounded-4 border border-dashed bg-light bg-opacity-50 text-center mb-0">
                    <i class="bi bi-cloud-arrow-up fs-1 text-primary mb-2 d-block"></i>
                    <h6 class="fw-bold text-dark">Upload Category Image</h6>
                    <p class="small text-muted mb-3">Recommended size: 800x600px (PNG, JPG)</p>
                    <div class="mx-auto" style="max-width: 300px;">
                        <input type="file" name="CategoryImage" class="form-control form-control-sm" 
                               accept="image/*" onchange="previewImg(event,'catPreview')">
                    </div>
                </div>
            </div>
            
            <div class="col-lg-5">
                <label class="form-label fw-bold text-dark mb-3">Image Preview</label>
                <div class="ratio ratio-4x3 border rounded-4 bg-white shadow-sm overflow-hidden">
                    <div class="d-flex align-items-center justify-content-center">
                        <div id="catPreviewPlaceholder" class="text-center opacity-25">
                            <i class="bi bi-image fs-1 d-block mb-1"></i>
                            <div class="small fw-bold">No Image Selected</div>
                        </div>
                        <img id="catPreview" src="" class="img-fluid d-none" style="object-fit: cover; max-height: 100%; width: 100%;">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 pt-4 border-top d-flex justify-content-end gap-3">
            <a href="{{ route('category.list') }}" class="btn btn-light px-4 rounded-pill border fw-semibold">
                Cancel
            </a>
            <button type="submit" class="btn btn-premium-primary px-5 rounded-pill">
                <i class="bi bi-check2-circle me-1"></i> Create Category
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

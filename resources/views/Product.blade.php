@extends('layouts.admin')
@section('title', 'Create Product')
@section('subtitle', 'Add a new product to your catalog')

@section('actions')
    <a href="{{ url('/productList') }}" class="btn btn-light rounded-pill px-4 shadow-sm border">
        <i class="bi bi-arrow-left me-1"></i> Back to List
    </a>
@endsection

@section('content')
<div class="p-4 p-lg-5">
    <form action="{{ url('/productStore') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark">Product Name <span class="text-danger">*</span></label>
                    <input type="text" name="productName" class="form-control form-control-premium" 
                           placeholder="e.g. iPhone 15 Pro" required>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark">Category <span class="text-danger">*</span></label>
                        <select name="CategoryID" class="form-select form-control-premium shadow-none">
                            <option value="" disabled selected>Select a category...</option>
                            @foreach($Categories as $Category)
                                <option value="{{ $Category->id }}">{{ $Category->CategoryName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark">Price ($) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted">$</span>
                            <input type="number" step="0.01" name="price" class="form-control form-control-premium border-start-0" 
                                   placeholder="0.00" required>
                        </div>
                    </div>
                </div>

                <div class="p-4 rounded-4 border border-dashed bg-light bg-opacity-50 text-center mb-0">
                    <i class="bi bi-cloud-arrow-up fs-1 text-primary mb-2 d-block"></i>
                    <h6 class="fw-bold text-dark">Product Media</h6>
                    <p class="small text-muted mb-3">Upload a high-quality product image (PNG, JPG)</p>
                    <div class="mx-auto" style="max-width: 300px;">
                        <input type="file" name="productImage" class="form-control form-control-sm" 
                               accept="image/*" onchange="previewImg(event,'proPreview')">
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <label class="form-label fw-bold text-dark mb-3">Product Preview</label>
                <div class="ratio ratio-1x1 border rounded-4 bg-white shadow-sm overflow-hidden">
                    <div class="d-flex align-items-center justify-content-center">
                        <div id="proPreviewPlaceholder" class="text-center opacity-25">
                            <i class="bi bi-image fs-1 d-block mb-1"></i>
                            <div class="small fw-bold">Live Preview</div>
                        </div>
                        <img id="proPreview" src="" class="img-fluid d-none" style="object-fit: contain; max-height: 90%; max-width: 90%;">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 pt-4 border-top d-flex justify-content-end gap-3">
            <a href="{{ url('/productList') }}" class="btn btn-light px-4 rounded-pill border fw-semibold">
                Cancel
            </a>
            <button type="submit" class="btn btn-premium-primary px-5 rounded-pill">
                <i class="bi bi-cloud-check me-1"></i> Save Product
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
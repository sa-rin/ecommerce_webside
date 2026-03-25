@extends('layouts.admin')
@section('title', 'Edit Category')
@section('subtitle', 'Update category name and replace image if necessary')

@section('actions')
    <a href="{{ route('category.list') }}" class="btn btn-light rounded-pill px-4 shadow-sm border">
        <i class="bi bi-arrow-left me-1"></i> Back to List
    </a>
@endsection

@section('content')
<div class="p-4 p-md-5">
    <form action="/categoryEdit" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="id" value="{{ $Category->id }}">
        <input type="hidden" name="oldCategoryImage" value="{{ $Category->CategoryImage }}">

        <div class="mb-4">
            <label class="form-label fw-bold">Category Name <span class="text-danger">*</span></label>
            <input type="text" name="categoryName" value="{{ $Category->CategoryName }}" class="form-control form-control-lg bg-light" required>
        </div>

        <div class="row mb-4">
            <div class="col-md-6 mb-4 mb-md-0">
                <label class="form-label fw-bold">Current Image</label>
                <div class="p-3 border rounded-3 bg-light text-center h-100 d-flex align-items-center justify-content-center">
                    @if($Category->CategoryImage)
                        <img src="{{ asset('img/product/'.$Category->CategoryImage) }}" class="img-fluid rounded shadow-sm" style="max-height: 140px;">
                    @else
                        <div class="text-muted"><i class="bi bi-image fs-1 opacity-25 d-block mb-2"></i> No Image Provided</div>
                    @endif
                </div>
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-bold">Change Image (optional)</label>
                <div class="p-3 border rounded-3 bg-light text-center h-100 d-flex flex-column align-items-center justify-content-center">
                    <input type="file" name="fileCategoryImage" class="form-control mb-3" accept="image/*" onchange="previewImg(event,'catEditPreview')">
                    <img id="catEditPreview" src="" class="img-fluid rounded shadow-sm d-none" style="max-height: 100px;">
                </div>
            </div>
        </div>

        <hr class="my-4 text-muted">
        
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('category.list') }}" class="btn btn-light px-4">Cancel</a>
            <button type="submit" class="btn btn-dark px-4 shadow-sm" style="background: var(--gradient); border: none;">Save Changes</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function previewImg(event, id){
    const img = document.getElementById(id);
    const file = event.target.files?.[0];
    if(!file){ img.classList.add('d-none'); img.src=""; return; }
    img.src = URL.createObjectURL(file);
    img.classList.remove('d-none');
}
</script>
@endpush

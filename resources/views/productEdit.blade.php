@extends('layouts.admin')
@section('title', 'Edit Product')
@section('subtitle', 'Update product information and replace image if needed')

@section('actions')
    <a href="{{ url('/productList') }}" class="btn btn-light rounded-pill px-4 shadow-sm border">
        <i class="bi bi-arrow-left me-1"></i> Back to List
    </a>
@endsection

@section('content')
<div class="p-4 p-md-5">
    <form action="{{ url('/productEdit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $Product->id }}">

        <div class="row mb-4">
            <div class="col-md-8 mb-4 mb-md-0">
                <label class="form-label fw-bold">Product Name <span class="text-danger">*</span></label>
                <input type="text" name="productName" value="{{ $Product->ProductName }}" class="form-control form-control-lg bg-light" required>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Price <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">$</span>
                    <input type="text" name="price" value="{{ $Product->Price }}" class="form-control form-control-lg bg-light border-start-0" required>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
            <select name="CategoryID" class="form-select form-select-lg bg-light">
                @foreach($Categories as $Category)
                    <option value="{{ $Category->id }}"
                        {{ $Product->CategoryID == $Category->id ? 'selected' : '' }}>
                        {{ $Category->CategoryName }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row mb-4">
            <div class="col-md-6 mb-4 mb-md-0">
                <label class="form-label fw-bold">Current Image</label>
                <div class="p-3 border rounded-3 bg-light text-center h-100 d-flex align-items-center justify-content-center">
                    @if(!empty($Product->ProductImage))
                        <img src="{{ asset('img/product/'.$Product->ProductImage) }}" class="img-fluid rounded shadow-sm" style="max-height: 140px;">
                    @else
                        <div class="text-muted"><i class="bi bi-image fs-1 opacity-25 d-block mb-2"></i> No Image Provided</div>
                    @endif
                </div>
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-bold">Change Image (optional)</label>
                <div class="p-3 border rounded-3 bg-light text-center h-100 d-flex flex-column align-items-center justify-content-center">
                    <input type="file" name="productImage" class="form-control mb-3" accept="image/*" onchange="previewImg(event,'proEditPreview')">
                    <img id="proEditPreview" src="" class="img-fluid rounded shadow-sm d-none" style="max-height: 100px;">
                </div>
            </div>
        </div>

        <hr class="my-4 text-muted">
        
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ url('/productList') }}" class="btn btn-light px-4">Cancel</a>
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
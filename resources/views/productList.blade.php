@extends('layouts.admin')
@section('title', 'Products')
@section('subtitle', 'View, edit, or remove products')

@section('actions')
    <a href="{{ url('/product') }}" class="btn btn-premium-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Add Product
    </a>
@endsection

@section('content')
<div class="table-responsive">
    <table class="table table-premium align-middle">
        <thead>
            <tr>
                <th style="width: 80px;">ID</th>
                <th>Product Information</th>
                <th style="width: 180px;">Category</th>
                <th style="width: 120px;">Price</th>
                <th class="text-center" style="width: 120px;">Image</th>
                <th class="text-center" style="width: 180px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($Products as $Product)
                <tr>
                    <td class="text-muted fw-bold">#{{ $Product->id }}</td>
                    <td>
                        <div class="fw-bold text-dark" style="font-size: 1rem;">{{ $Product->ProductName }}</div>
                        <div class="small text-muted">SKU-{{ str_pad($Product->id, 5, '0', STR_PAD_LEFT) }}</div>
                    </td>
                    <td>
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill small fw-semibold">
                            {{ $Product->category->CategoryName ?? 'Uncategorized' }}
                        </span>
                    </td>
                    <td>
                        <div class="fw-bold text-dark" style="font-size: 1.1rem;">${{ number_format($Product->Price, 2) }}</div>
                    </td>
                    <td class="text-center">
                        @if(!empty($Product->ProductImage))
                            <img src="{{ asset('img/product/'.$Product->ProductImage) }}" 
                                 class="rounded-3 shadow-sm border border-light" 
                                 style="width: 60px; height: 60px; object-fit: contain; background: #fff;">
                        @else
                            <div class="ratio ratio-1x1 rounded-3 bg-light border d-flex align-items-center justify-content-center mx-auto" style="width: 60px;">
                                <i class="bi bi-image text-muted opacity-50"></i>
                            </div>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a class="btn btn-sm btn-light rounded-pill px-3 border shadow-sm" href="{{ url('productEdit/'.$Product->id) }}">
                                <i class="bi bi-pencil-square text-warning me-1"></i> Edit
                            </a>
                            <a class="btn btn-sm btn-light rounded-pill px-3 border shadow-sm" href="{{ url('productDelete/'.$Product->id) }}"
                               onclick="return confirm('Are you sure you want to delete this product?')">
                                <i class="bi bi-trash3 text-danger me-1"></i> Delete
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-5">
                        <i class="bi bi-box-seam fs-1 d-block mb-3 opacity-25"></i>
                        <h6 class="fw-bold">No products found</h6>
                        <p class="small mb-0 text-muted">Start by adding your first product to the catalog.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
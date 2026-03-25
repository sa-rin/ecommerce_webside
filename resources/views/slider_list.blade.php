@extends('layouts.admin')
@section('title', 'Sliders')
@section('subtitle', 'Upload and organize homepage hero sliders')

@section('actions')
    <a href="{{ route('slider.create') }}" class="btn btn-premium-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Add Slider
    </a>
@endsection

@section('content')
<div class="table-responsive">
    <table class="table table-premium align-middle">
        <thead>
            <tr>
                <th style="width: 70px;">ID</th>
                <th>Hero Details</th>
                <th class="text-center" style="width: 100px;">Order</th>
                <th class="text-center" style="width: 120px;">Status</th>
                <th class="text-center" style="width: 160px;">Image</th>
                <th class="text-center" style="width: 180px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($Sliders as $s)
                <tr>
                    <td class="text-muted fw-bold">#{{ $s->id }}</td>
                    <td>
                        <div class="fw-bold text-dark">{{ $s->Title ?? 'Hero Slide' }}</div>
                        @if($s->SubTitle)
                            <div class="small text-muted mt-1">{{ $s->SubTitle }}</div>
                        @endif
                    </td>
                    <td class="text-center">
                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-bold">{{ $s->SortOrder }}</span>
                    </td>
                    <td class="text-center">
                        @if($s->IsActive)
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill small">
                                <i class="bi bi-check-circle-fill me-1"></i> Active
                            </span>
                        @else
                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-2 rounded-pill small">
                                <i class="bi bi-x-circle-fill me-1"></i> Inactive
                            </span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($s->SliderImage)
                            <img src="{{ asset('img/slider/'.$s->SliderImage) }}" 
                                 class="rounded-3 shadow-sm border border-light" 
                                 style="width: 120px; height: 60px; object-fit: cover;">
                        @else
                            <div class="ratio ratio-16x9 rounded-3 bg-light border d-flex align-items-center justify-content-center mx-auto" style="width: 120px;">
                                <i class="bi bi-image text-muted opacity-50"></i>
                            </div>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a class="btn btn-sm btn-light rounded-pill px-3 border shadow-sm" href="{{ route('slider.edit', $s->id) }}">
                                <i class="bi bi-pencil-square text-warning me-1"></i> Edit
                            </a>
                            <a class="btn btn-sm btn-light rounded-pill px-3 border shadow-sm" href="{{ route('slider.delete', $s->id) }}"
                               onclick="return confirm('Are you sure you want to delete this slider?')">
                                <i class="bi bi-trash3 text-danger me-1"></i> Delete
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-5">
                        <i class="bi bi-view-carousel fs-1 d-block mb-3 opacity-25"></i>
                        <h6 class="fw-bold">No sliders found</h6>
                        <p class="small mb-0 text-muted">Create a stunning hero section by adding your first slider.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
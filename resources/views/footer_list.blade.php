@extends('layouts.admin')
@section('title', 'Footer Records')
@section('subtitle', 'Manage different versions of footer information')

@section('content')
<div class="table-responsive">
    <table class="table table-premium align-middle">
        <thead>
            <tr>
                <th style="width: 70px;">ID</th>
                <th>Company & Contact</th>
                <th>Social Links</th>
                <th class="text-center" style="width: 120px;">Status</th>
                <th class="text-center" style="width: 180px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($Footers as $f)
                <tr>
                    <td class="text-muted fw-bold">#{{ $f->id }}</td>
                    <td>
                        <div class="fw-bold text-dark">{{ $f->CompanyName ?? 'N/A' }}</div>
                        <div class="small text-muted"><i class="bi bi-envelope me-1"></i> {{ $f->Email }}</div>
                        <div class="small text-muted"><i class="bi bi-telephone me-1"></i> {{ $f->Phone }}</div>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            @if($f->Facebook) <i class="bi bi-facebook text-primary" title="Facebook"></i> @endif
                            @if($f->Telegram) <i class="bi bi-telegram text-info" title="Telegram"></i> @endif
                            @if($f->Youtube) <i class="bi bi-youtube text-danger" title="Youtube"></i> @endif
                        </div>
                        <div class="small text-muted mt-1 text-truncate" style="max-width: 200px;">
                            {{ $f->Copyright }}
                        </div>
                    </td>
                    <td class="text-center">
                        @if($f->IsActive)
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill small">
                                <i class="bi bi-eye-fill me-1"></i> Public
                            </span>
                        @else
                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-2 rounded-pill small">
                                <i class="bi bi-eye-slash-fill me-1"></i> Hidden
                            </span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a class="btn btn-sm btn-light rounded-pill px-3 border shadow-sm" href="{{ route('footer.edit', $f->id) }}">
                                <i class="bi bi-pencil-square text-warning me-1"></i> Edit
                            </a>
                            <a class="btn btn-sm btn-light rounded-pill px-3 border shadow-sm" href="{{ route('footer.delete', $f->id) }}"
                               onclick="return confirm('Are you sure you want to delete this record?')">
                                <i class="bi bi-trash3 text-danger me-1"></i> Delete
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-5">
                        <i class="bi bi-layout-text-window-reverse fs-1 d-block mb-3 opacity-25"></i>
                        <h6 class="fw-bold">No footer records</h6>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
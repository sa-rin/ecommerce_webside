@extends('layouts.admin')
@section('title', 'Category List')

@section('content')
    <div class="table-responsive">
        <table class="table table-premium align-middle">
            <thead>
                <tr>
                    <th style="width:80px;">ID</th>
                    <th>Category Name</th>
                    <th class="text-center">Image</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $c)
                    <tr>
                        <td class="text-muted fw-bold">#{{ $c->id }}</td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $c->CategoryName }}</div>
                        </td>
                        <td class="text-center">
                            @if($c->CategoryImage)
                                <img src="{{ asset('img/product/' . $c->CategoryImage) }}" 
                                     class="rounded-3 shadow-sm border border-light" 
                                     style="width: 60px; height: 45px; object-fit: cover;">
                            @else
                                <span class="badge bg-light text-muted border py-2 px-3 fw-normal">No Image</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a class="btn btn-sm btn-light rounded-pill px-3 border shadow-sm" href="{{ url('categoryEdit/' . $c->id) }}">
                                    <i class="bi bi-pencil-square text-warning me-1"></i> Edit
                                </a>
                                <a class="btn btn-sm btn-light rounded-pill px-3 border shadow-sm" href="{{ url('categoryDelete/' . $c->id) }}"
                                   onclick="return confirm('Are you sure you want to delete this category?')">
                                    <i class="bi bi-trash3 text-danger me-1"></i> Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-1 d-block mb-2 opacity-25"></i>
                            No categories found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
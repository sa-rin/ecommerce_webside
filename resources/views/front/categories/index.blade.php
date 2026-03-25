@extends('layouts.app')

@section('title', 'Categories')
@section('hero_title', 'Browse Categories')
@section('hero_subtitle', 'Choose a category to explore products')
@section('hero_action')
  <a class="btn btn-dark pill px-4" href="#">
    <i class="bi bi-lightning-charge me-1"></i> Shop Now
  </a>
@endsection

@section('breadcrumb')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Categories</li>
    </ol>
  </nav>
@endsection

@section('content')
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-3">
    <h3 class="m-0 fw-bold">Categories</h3>

    <div class="d-flex gap-2">
      <a class="btn btn-outline-dark pill px-3" href="{{ route('home') }}">
        <i class="bi bi-arrow-left me-1"></i> Back to Products
      </a>
    </div>
  </div>

  <div class="row g-4">
    @forelse($categories as $c)
      <div class="col-6 col-md-4 col-lg-3">
        <a href="{{ url('/category/' . $c->id . '/products') }}" class="text-decoration-none group">
          <div class="card soft-card h-100 border-0 shadow-sm overflow-hidden" 
               style="background: rgba(255,255,255,0.8); backdrop-filter: blur(10px); transition: all 0.4s ease;">
            
            {{-- Image Section --}}
            <div class="position-relative overflow-hidden" style="height: 200px;">
              @if($c->CategoryImage)
                <img src="{{ asset('img/product/' . $c->CategoryImage) }}" 
                     class="w-100 h-100 pro-img" 
                     style="object-fit: cover; transition: transform 0.6s ease;" 
                     alt="{{ $c->CategoryName }}">
              @else
                <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center text-muted">
                  <i class="bi bi-collection fs-1 opacity-25"></i>
                </div>
              @endif
            </div>

            <div class="card-body p-3">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="m-0 fw-bold text-dark text-truncate">{{ $c->CategoryName }}</h6>
                <span class="badge rounded-pill shadow-sm py-1 px-3" 
                      style="background: var(--gradient); color: white; border: none; font-size: 0.7rem;">
                  VIEW
                </span>
              </div>
              <div class="d-flex align-items-center text-muted x-small">
                 <span class="opacity-75">Explore products</span>
                 <i class="bi bi-arrow-right ms-auto transition-transform group-hover-translate"></i>
              </div>
            </div>
          </div>
        </a>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-light border rounded-4 p-4">
          <div class="fw-bold">No categories found.</div>
          <div class="text-muted">Please add categories from admin panel.</div>
        </div>
      </div>
    @endforelse
  </div>

  <style>
    .group:hover .soft-card {
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(99, 102, 241, 0.15) !important;
      border-color: rgba(168, 85, 247, 0.2) !important;
    }
    .group:hover .pro-img { transform: scale(1.1); }
    .group:hover .group-hover-translate { transform: translateX(5px); }
    .x-small { font-size: 0.75rem; }
    .transition-transform { transition: transform 0.3s ease; }
  </style>
@endsection
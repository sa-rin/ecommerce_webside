@extends('layouts.app')

@section('title', 'Register at MyShop')

@section('content')
<div class="row justify-content-center pt-3 pb-5">
  <div class="col-12 col-sm-10 col-md-8 col-lg-5">
    
    <div class="card soft-card p-4 p-md-5 border-0">
      
      <div class="text-center mb-4">
        <div class="d-inline-flex justify-content-center align-items-center rounded-circle mb-3" 
             style="width: 64px; height: 64px; background: rgba(99, 102, 241, 0.1); color: var(--primary);">
          <i class="bi bi-person-plus fs-1" style="background: var(--gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
        </div>
        <h3 class="fw-bold mb-1">Create an Account</h3>
        <p class="text-muted small">Join us to get the best shopping experience</p>
      </div>

      {{-- Global Error Handling for failed auth, if any --}}
      @if($errors->any())
        <div class="alert alert-danger rounded-4 border-0 mb-4" style="background: rgba(244, 63, 94, 0.1); color: #e11d48;">
          <ul class="mb-0 ps-3 small">
            @foreach($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ url('/register') }}">
        @csrf
        
        <div class="mb-3">
          <label class="form-label small fw-semibold text-muted mb-1">Full Name</label>
          <div class="input-group">
            <span class="input-group-text border-0" style="border-radius: 16px 0 0 16px; padding-left: 1.25rem;">
              <i class="bi bi-person text-muted"></i>
            </span>
            <input type="text" name="name" class="form-control border-0 @error('name') is-invalid @enderror" 
                   value="{{ old('name') }}" placeholder="John Doe" required 
                   style="border-radius: 0 16px 16px 0; padding-left: 0.5rem; border-left: 0;">
          </div>
          @error('name')
            <div class="small text-danger mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label small fw-semibold text-muted mb-1">Email Address</label>
          <div class="input-group">
            <span class="input-group-text border-0" style="border-radius: 16px 0 0 16px; padding-left: 1.25rem;">
              <i class="bi bi-envelope text-muted"></i>
            </span>
            <input type="email" name="email" class="form-control border-0 @error('email') is-invalid @enderror" 
                   value="{{ old('email') }}" placeholder="name@example.com" required 
                   style="border-radius: 0 16px 16px 0; padding-left: 0.5rem; border-left: 0;">
          </div>
          @error('email')
            <div class="small text-danger mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4">
          <label class="form-label small fw-semibold text-muted mb-1">Password</label>
          <div class="input-group">
            <span class="input-group-text border-0" style="border-radius: 16px 0 0 16px; padding-left: 1.25rem;">
              <i class="bi bi-shield-lock text-muted"></i>
            </span>
            <input type="password" name="password" class="form-control border-0 @error('password') is-invalid @enderror" 
                   placeholder="Create a password" required 
                   style="border-radius: 0 16px 16px 0; padding-left: 0.5rem; border-left: 0;">
          </div>
          @error('password')
            <div class="small text-danger mt-1">{{ $message }}</div>
          @enderror
        </div>
        
        <button type="submit" class="btn btn-dark w-100 py-3 mb-4 text-uppercase" style="border-radius: 16px; font-size: 0.9rem; letter-spacing: 0.5px;">
          Create Account
        </button>

        <div class="text-center small text-muted">
          Already have an account? 
          <a href="{{ url('/login') }}" class="text-decoration-none fw-bold ms-1" style="color: var(--primary); transition: 0.3s;">Log in here</a>
        </div>
      </form>
      
    </div>
  </div>
</div>
@endsection
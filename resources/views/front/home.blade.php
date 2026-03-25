
@extends('layouts.app')

@section('title','Home')
@section('hero_title','All Products')
@section('hero_subtitle','Search, filter, sort, and add to cart easily')
@section('hero_action')
  <a class="btn btn-dark pill px-4" href="{{ route('front.categories.index') }}">
    <i class="bi bi-grid me-1"></i> Browse Categories
  </a>
@endsection

@section('breadcrumb')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Products</li>
    </ol>
  </nav>
@endsection

@section('content')

  {{-- Filters --}}
  <form method="GET" class="card soft-card p-3 p-md-4 mb-3">
    <div class="row g-2 align-items-end">

      {{-- Search --}}
      <div class="col-md-4">
        <label class="form-label small text-muted mb-1">Search</label>
        <input type="text" name="q" value="{{ request('q') }}" class="form-control pill" placeholder="Search product name...">
      </div>

      {{-- Category --}}
      <div class="col-md-3">
        <label class="form-label small text-muted mb-1">Category</label>
        <select name="category" class="form-select pill">
          <option value="">-- All Categories --</option>
          @foreach($categories as $c)
            <option value="{{ $c->id }}" @selected(request('category')==$c->id)>
              {{ $c->CategoryName }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Price --}}
      <div class="col-md-3">
        <label class="form-label small text-muted mb-1">Price Range</label>
        <div class="d-flex gap-2">
          <input type="number" name="min_price" value="{{ request('min_price') }}" class="form-control pill" placeholder="Min">
          <input type="number" name="max_price" value="{{ request('max_price') }}" class="form-control pill" placeholder="Max">
        </div>
      </div>

      {{-- Sort + Buttons --}}
      <div class="col-md-2">
        <label class="form-label small text-muted mb-1">Sort</label>
        <select name="sort" class="form-select pill">
          <option value="">Default</option>
          <option value="latest"     @selected(request('sort')=='latest')>Latest</option>
          <option value="price_asc"  @selected(request('sort')=='price_asc')>Price ↑</option>
          <option value="price_desc" @selected(request('sort')=='price_desc')>Price ↓</option>
          <option value="name_asc"   @selected(request('sort')=='name_asc')>Name A→Z</option>
          <option value="name_desc"  @selected(request('sort')=='name_desc')>Name Z→A</option>
        </select>
      </div>

      <div class="col-12 d-flex gap-2 mt-2">
        <button class="btn btn-dark pill px-4">
          <i class="bi bi-funnel me-1"></i> Apply Filters
        </button>
        <a class="btn btn-outline-dark pill px-4" href="{{ route('home') }}">
          Reset
        </a>
      </div>

      {{-- Results summary --}}
      <div class="col-12">
        <div class="text-muted small mt-2">
          Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }}
          of {{ $products->total() }} results
        </div>
      </div>

    </div>
  </form>

  {{-- Products Grid --}}
  @if($products->count() == 0)
    <div class="alert alert-light border rounded-4 p-4">
      <div class="fw-bold">No products found.</div>
      <div class="text-muted">Try different filters.</div>
    </div>
  @else
    <div class="row g-3">
      @foreach($products as $p)
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card soft-card h-100">

            @if($p->ProductImage)
              <img src="{{ asset('img/product/'.$p->ProductImage) }}" class="thumb" alt="Product">
            @else
              <div class="noimg"><span class="small">No Image</span></div>
            @endif

            <div class="card-body d-flex flex-column">
              <div class="fw-bold line-clamp-2 mb-1">{{ $p->ProductName }}</div>
              <div class="text-muted small mb-2">Fast delivery • Best price</div>

              <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="fw-bold">${{ number_format($p->Price,2) }}</span>
                <span class="badge bg-light text-dark border pill">Hot</span>
              </div>

              <div class="mt-auto d-flex gap-2 align-items-stretch">
                <a class="btn btn-dark pill flex-grow-1 btn-sm py-2"
                  href="{{ route('products.show',$p->id) }}">
                  Detail
                </a>

                {{-- AJAX button (no need form) --}}
                <button type="button"
                        class="btn btn-success pill btn-sm py-2 px-3 flex-shrink-0 js-add-to-cart"
                        data-url="{{ route('cart.add',$p->id) }}"
                        data-name="{{ $p->ProductName }}">
                  + Add
                </button>
              </div>

            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-4 d-flex justify-content-center">
      {{ $products->links() }}
    </div>
  @endif

@endsection

@push('scripts')
<script>
  document.querySelectorAll('.js-add-to-cart').forEach(btn => {
    btn.addEventListener('click', async () => {
      const url = btn.dataset.url;
      const name = btn.dataset.name || "Item";

      btn.disabled = true;
      const oldHtml = btn.innerHTML;
      btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Adding';

      try {
        const res = await fetch(url, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: new URLSearchParams({ qty: 1 })
        });

        const data = await res.json().catch(() => ({}));
        if (!res.ok || !data.ok) throw new Error(data.message || 'Request failed');

        showCartToast(data.message || `✅ ${name} added to cart!`);

        // optional badge
        // document.getElementById('cartCount').innerText = data.cart_count;

      } catch (e) {
        showCartToast(`⚠️ ${e.message || 'Cannot add to cart. Please try again.'}`);
      } finally {
        btn.disabled = false;
        btn.innerHTML = oldHtml;
      }
    });
  });
</script>
@endpush
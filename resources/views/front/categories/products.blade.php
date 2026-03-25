
@extends('layouts.app')

@section('title', 'Products')
@section('hero_title', 'Products in '.$category->CategoryName)
@section('hero_subtitle', 'Filter and sort products easily')
@section('hero_action')
  <a class="btn btn-outline-dark pill px-4" href="{{ route('front.categories.index') }}">
    <i class="bi bi-grid me-1"></i> All Categories
  </a>
@endsection

@section('breadcrumb')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('front.categories.index') }}" class="text-decoration-none">Categories</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $category->CategoryName }}</li>
    </ol>
  </nav>
@endsection

@section('content')
  {{-- Toolbar: Filter + Sort --}}
  <form method="GET" class="card soft-card p-3 p-md-4 mb-3">
    <div class="row g-2 align-items-end">
      <div class="col-md-4">
        <label class="form-label small text-muted mb-1">Filter by price</label>
        <div class="d-flex gap-2">
          <input type="number" name="min_price" value="{{ request('min_price') }}" class="form-control pill" placeholder="Min">
          <input type="number" name="max_price" value="{{ request('max_price') }}" class="form-control pill" placeholder="Max">
        </div>
      </div>

      <div class="col-md-4">
        <label class="form-label small text-muted mb-1">Sort</label>
        <select name="sort" class="form-select pill">
          <option value="">-- Default --</option>
          <option value="latest"     @selected(request('sort')=='latest')>Latest</option>
          <option value="price_asc"  @selected(request('sort')=='price_asc')>Price: Low → High</option>
          <option value="price_desc" @selected(request('sort')=='price_desc')>Price: High → Low</option>
          <option value="name_asc"   @selected(request('sort')=='name_asc')>Name: A → Z</option>
          <option value="name_desc"  @selected(request('sort')=='name_desc')>Name: Z → A</option>
        </select>
      </div>

      <div class="col-md-4 d-flex gap-2">
        <button class="btn btn-dark pill w-100">
          <i class="bi bi-funnel me-1"></i> Apply
        </button>
        <a class="btn btn-outline-dark pill w-100"
           href="{{ url('/category/'.$category->id.'/products') }}">
          Reset
        </a>
      </div>
    </div>
  </form>

  @if($products->count() == 0)
    <div class="alert alert-light border rounded-4 p-4">
      <div class="fw-bold">No products in this category.</div>
      <div class="text-muted">Try another filter or category.</div>
    </div>
  @else
    <div class="row g-3">
      @foreach($products as $p)
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card soft-card h-100">
            {{-- Image --}}
            @if($p->ProductImage)
              <img src="{{ asset('img/product/'.$p->ProductImage) }}" class="thumb" alt="Product">
            @else
              <div class="noimg"><span class="small">No Image</span></div>
            @endif

            <div class="card-body d-flex flex-column">
              <h6 class="fw-bold line-clamp-2 mb-1">{{ $p->ProductName }}</h6>
              <div class="text-muted small mb-2">In stock • Fast delivery</div>

              <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="fw-bold">${{ number_format($p->Price,2) }}</span>
                <span class="badge bg-light text-dark border pill">Popular</span>
              </div>

              <div class="mt-auto d-flex gap-2">
                <a class="btn btn-dark pill w-100" href="{{ route('products.show', $p->id) }}">
                  Detail
                </a>

                {{-- Add to Cart (AJAX + Toast) --}}
                <button type="button"
                        class="btn btn-success pill w-100 js-add-to-cart"
                        data-url="{{ route('cart.add',$p->id) }}"
                        data-name="{{ $p->ProductName }}">
                  + Add
                </button>

                {{-- Fallback normal form (if JS disabled) --}}
                <form method="POST" action="{{ route('cart.add',$p->id) }}" class="d-none">
                  @csrf
                  <input type="hidden" name="qty" value="1">
                </form>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-4 d-flex justify-content-center">
      {{-- keep query string when paginate --}}
      {{ $products->appends(request()->query())->links() }}
    </div>
  @endif
@endsection

@push('scripts')
<script>
  // AJAX Add to cart + Toast
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

        // If your route returns redirect/html, this still may be ok.
        if (!res.ok) throw new Error('Request failed');

        showCartToast(`${name} added to cart!`);
      } catch (e) {
        showCartToast(' Cannot add to cart. Please try again.');
      } finally {
        btn.disabled = false;
        btn.innerHTML = oldHtml;
      }
    });
  });
</script>
@endpush

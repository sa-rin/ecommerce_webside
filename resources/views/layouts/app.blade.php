
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','My Shop')</title>

  {{-- Bootstrap 5 --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  {{-- Optional icons --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  {{-- Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  {{-- Professional UI CSS --}}
  <style>
    :root {
      --primary: #6366f1; /* Indigo 500 */
      --primary-hover: #4f46e5;
      --accent: #ec4899; /* Pink 500 */
      --secondary: #64748b; 
      --bg: #f8fafc;
      --card-bg: rgba(255, 255, 255, 0.85);
      --border: rgba(99, 102, 241, 0.12);
      --soft-shadow: 0 10px 40px -10px rgba(99, 102, 241, 0.12);
      --soft-shadow-hover: 0 20px 40px -12px rgba(99, 102, 241, 0.25);
      --radius: 20px;
      --gradient: linear-gradient(135deg, #6366f1, #a855f7, #ec4899);
      --gradient-hover: linear-gradient(135deg, #4f46e5, #9333ea, #db2777);
    }
    body { 
      background: var(--bg);
      background-image: 
        radial-gradient(circle at 15% 40%, rgba(99, 102, 241, 0.08), transparent 30%),
        radial-gradient(circle at 85% 60%, rgba(236, 72, 153, 0.06), transparent 30%);
      background-attachment: fixed;
      font-family: 'Inter', sans-serif;
      color: #334155;
      -webkit-font-smoothing: antialiased;
    }
    .page-wrap { min-height: 70vh; }

    /* Buttons */
    .btn {
      font-weight: 600;
      letter-spacing: 0.02em;
      transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .btn-dark {
      background: var(--gradient) !important;
      border: none !important;
      color: white !important;
      box-shadow: 0 6px 15px -4px rgba(168, 85, 247, 0.5);
    }
    .btn-dark:hover {
      background: var(--gradient-hover) !important;
      transform: translateY(-3px) scale(1.02);
      box-shadow: 0 12px 20px -6px rgba(168, 85, 247, 0.6);
      color: white !important;
    }
    .btn-outline-dark {
      color: var(--primary);
      border: 2px solid var(--primary);
      background: transparent;
    }
    .btn-outline-dark:hover {
      background: var(--gradient);
      color: white;
      border-color: transparent;
      box-shadow: 0 8px 15px -5px rgba(99, 102, 241, 0.4);
      transform: translateY(-2px);
    }
    .btn-success {
      background: linear-gradient(135deg, #10b981, #059669);
      border: none;
      color: #fff;
      box-shadow: 0 6px 15px -4px rgba(16, 185, 129, 0.4);
    }
    .btn-success:hover {
      transform: translateY(-3px) scale(1.02);
      box-shadow: 0 12px 20px -6px rgba(16, 185, 129, 0.5);
      color: #fff;
    }
    .btn-outline-danger {
      color: #f43f5e;
      border: 2px solid rgba(244, 63, 94, 0.3);
      background: transparent;
    }
    .btn-outline-danger:hover {
      background: linear-gradient(135deg, #f43f5e, #e11d48);
      color: white;
      border-color: transparent;
      box-shadow: 0 8px 15px -5px rgba(244, 63, 94, 0.4);
      transform: translateY(-2px);
    }
    .pill { border-radius: 9999px !important; }

    /* Cards */
    .soft-card {
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--soft-shadow);
      background: var(--card-bg);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      overflow: hidden; 
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .soft-card:hover { 
      transform: translateY(-6px); 
      box-shadow: var(--soft-shadow-hover);
      border-color: rgba(168, 85, 247, 0.3);
    }

    /* Images */
    .thumb { height: 210px; width: 100%; object-fit: cover; }
    .noimg {
      height: 210px; display: flex; align-items: center; justify-content: center;
      background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
      color: #94a3b8; font-weight: 600; font-size: 0.9rem;
    }

    /* Typography Utilities */
    .fw-bold { font-weight: 800 !important; }
    .fw-semibold { font-weight: 600 !important; }
    .text-muted { color: var(--secondary) !important; }
    .text-primary { color: var(--primary) !important; }
    
    .line-clamp-2 {
      display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }

    /* Hero Section */
    .hero {
      background: var(--gradient);
      border: none;
      border-radius: 28px;
      box-shadow: 0 20px 40px -12px rgba(168, 85, 247, 0.4);
      position: relative;
      overflow: hidden;
    }
    .hero::before {
      content: '';
      position: absolute;
      top: -50%; left: -50%; width: 200%; height: 200%;
      background: radial-gradient(circle at center, rgba(255,255,255,0.15) 0%, transparent 50%);
      animation: rotate 25s linear infinite;
      pointer-events: none;
      z-index: 0;
    }
    @keyframes rotate { 100% { transform: rotate(360deg); } }
    .hero * { position: relative; z-index: 1; }
    .hero h1 { color: #ffffff !important; text-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    .hero p { color: rgba(255,255,255,0.9) !important; }

    /* Navigation */
    .nav-glass {
      backdrop-filter: blur(20px) saturate(200%);
      -webkit-backdrop-filter: blur(20px) saturate(200%);
      background: rgba(255, 255, 255, 0.75);
      border-bottom: 1px solid rgba(255,255,255, 0.6);
      box-shadow: 0 8px 32px rgba(99, 102, 241, 0.06);
      transition: all 0.3s ease;
    }
    .navbar-brand span {
      background: var(--gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-weight: 800;
      letter-spacing: -0.05em;
    }
    .navbar-brand .logo-icon {
      background: var(--gradient) !important;
      box-shadow: 0 4px 10px rgba(168, 85, 247, 0.4);
    }
    .nav-link { font-weight: 600; color: var(--secondary); transition: all 0.3s; position: relative; }
    .nav-link:hover { color: var(--primary); transform: translateY(-1px); }
    .nav-link::after {
      content: ''; position: absolute; width: 0; height: 3px;
      bottom: 2px; left: 50%; transform: translateX(-50%);
      background: var(--gradient);
      transition: width 0.3s ease;
      border-radius: 3px;
    }
    .nav-link:hover::after { width: 50%; }

    /* Footer */
    .footer {
      background: linear-gradient(to bottom, #0f172a, #020617);
      color: #94a3b8;
      border-top: 1px solid rgba(99, 102, 241, 0.15);
      position: relative;
    }
    .footer::before {
      content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
      background: var(--gradient);
      opacity: 0.6;
    }
    .footer-heading { 
      color: white; font-weight: 700; letter-spacing: 0.04em; 
      text-transform: uppercase; font-size: 0.9rem;
      background: var(--gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      display: inline-block;
    }
    .footer a { color: #94a3b8; text-decoration: none; transition: all 0.3s; }
    .footer a:hover { color: #fff; text-shadow: 0 0 10px rgba(168, 85, 247, 0.4); transform: translateX(2px); display: inline-block; }

    /* Pagination */
    .pagination .page-link {
      border: none; 
      box-shadow: 0 4px 10px rgba(99, 102, 241, 0.06);
      margin: 0 4px; border-radius: 12px; padding: 0.5rem 0.9rem;
      color: var(--primary); font-weight: 600;
      transition: all 0.3s;
    }
    .pagination .page-link:hover {
      background: white;
      transform: translateY(-2px);
      box-shadow: 0 8px 15px rgba(99, 102, 241, 0.15);
      color: var(--accent);
    }
    .pagination .active .page-link {
      background: var(--gradient); color: #fff;
      box-shadow: 0 6px 15px rgba(168, 85, 247, 0.3);
    }

    /* Badges */
    .badge { padding: 0.6em 1em; font-weight: 700; letter-spacing: 0.04em; border-radius: 8px; }
    .badge.bg-light { 
      background-color: rgba(99, 102, 241, 0.08) !important; 
      color: var(--primary) !important; 
      border: 1px solid rgba(99, 102, 241, 0.2) !important; 
    }
    
    /* Inputs */
    .form-control, .form-select {
      border: 2px solid transparent;
      background-color: rgba(99, 102, 241, 0.03);
      padding: 0.75rem 1.25rem;
      border-radius: 16px;
      font-weight: 500;
      transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .form-control:focus, .form-select:focus {
      background-color: white;
      border-color: var(--primary);
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
      transform: translateY(-1px);
    }
    .input-group-text { background: transparent; transition: all 0.3s; }

    /* Breadcrumbs */
    .breadcrumb {
      background: linear-gradient(90deg, rgba(99, 102, 241, 0.08), rgba(236, 72, 153, 0.05));
      backdrop-filter: blur(10px);
      padding: 0.6rem 1.5rem;
      border-radius: 50px;
      display: inline-flex;
      align-items: center;
      border: 1px solid rgba(99, 102, 241, 0.2);
      box-shadow: 0 4px 20px rgba(99, 102, 241, 0.08);
      margin-bottom: 2rem;
    }
    .breadcrumb-item + .breadcrumb-item::before {
      content: "\F285"; /* bi-chevron-right */
      font-family: transition-transform;
      font-family: "bootstrap-icons";
      font-size: 0.75rem;
      color: var(--primary);
      opacity: 0.6;
      padding-right: 0.8rem;
    }
    .breadcrumb-item a {
      color: var(--primary);
      font-weight: 700;
      font-size: 0.9rem;
      text-decoration: none;
      transition: all 0.3s;
    }
    .breadcrumb-item a:hover {
      color: var(--accent);
      transform: scale(1.05);
    }
    .breadcrumb-item.active {
      color: var(--accent);
      font-weight: 800;
      font-size: 0.9rem;
      letter-spacing: 0.02em;
    }
  </style>

  @stack('styles')
</head>

<body>
  {{-- NAVBAR --}}
  <nav class="navbar navbar-expand-lg nav-glass sticky-top py-3">
    <div class="container">
      <a class="navbar-brand fw-bold fs-4 d-flex align-items-center gap-2" href="{{ url('/') }}">
        <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: var(--primary);">
          <i class="bi bi-bag-heart-fill fs-5"></i>
        </div>
        <span style="letter-spacing: -0.5px;">MyShop<span style="color: #10b981;">.</span></span>
      </a>

      <button class="navbar-toggler border-0 shadow-none px-0" type="button" data-bs-toggle="collapse" data-bs-target="#topNav">
        <i class="bi bi-list fs-1 text-dark"></i>
      </button>

      <div class="collapse navbar-collapse" id="topNav">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-1 gap-lg-2">
          <li class="nav-item"><a class="nav-link px-3 rounded-pill" href="{{ route('front.categories.index') }}">Categories</a></li>
          <li class="nav-item"><a class="nav-link px-3 rounded-pill" href="{{ route('home', ['sort' => 'latest']) }}">New Arrival</a></li>
          <li class="nav-item"><a class="nav-link px-3 rounded-pill" href="{{ route('front.about') }}">About</a></li>
        </ul>

        {{-- Search Form --}}
        <form class="d-flex me-lg-3 my-2 my-lg-0" role="search" action="{{ url('/') }}" method="GET">
          <div class="input-group" style="min-width: 250px;">
            <button type="submit" class="input-group-text bg-white border-0" style="border-radius:20px 0 0 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); transition: transform 0.2s;">
              <i class="bi bi-search text-muted hover-lift"></i>
            </button>
            <input class="form-control border-0 bg-white" type="search" name="q" placeholder="Search products..."
              value="{{ request('q') }}"
              style="border-radius:0 20px 20px 0; box-shadow: 0 2px 8px rgba(0,0,0,0.04); font-size: 0.95rem;">
          </div>
        </form>

        {{-- Right actions --}}
        <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
          <a href="{{ url('/cart') }}" class="btn btn-outline-dark pill px-4 d-flex align-items-center gap-2">
            <i class="bi bi-cart3 fs-5"></i> 
            <span>Cart</span>
          </a>

          @auth
            <div class="dropdown">
              <button class="btn btn-dark pill px-4 dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=f1f5f9&color=0f172a" class="rounded-circle" width="22" height="22" alt="Avatar">
                {{ explode(' ', auth()->user()->name)[0] }}
              </button>
              <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-4 mt-3" style="min-width: 200px;">
                <li><a class="dropdown-item py-2" href="{{ url('/admin') }}"><i class="bi bi-person me-2 text-muted"></i>Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <a class="dropdown-item py-2 text-danger" href="{{ url('/logout') }}"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
                </li>
              </ul>
            </div>
          @else
            <a href="{{ url('login') }}" class="btn btn-dark pill px-4">Login</a>
          @endauth
        </div>
      </div>
    </div>
  </nav>

  {{-- HEADER / HERO --}}
  <header class="container mt-4 mb-2">
    <div class="p-4 p-md-5 hero">
      <div class="row align-items-center g-4 position-relative z-1">
        <div class="col-md-7">
          <h1 class="fw-bold mb-3 text-dark" style="letter-spacing: -1px; font-size: 2.5rem;">@yield('hero_title','Modern Shop UI')</h1>
          <p class="text-muted mb-0 fs-5" style="max-width: 500px;">@yield('hero_subtitle','Clean • Fast • Responsive')</p>
        </div>
        <div class="col-md-5 text-md-end">
          @yield('hero_action')
        </div>
      </div>
    </div>
  </header>

  {{-- BREADCRUMB --}}
  <section class="container mb-4">
    @yield('breadcrumb')
  </section>

  {{-- CONTENT --}}
  <main class="container mt-3 page-wrap">
    {{-- Flash message for toast fallback (optional) --}}
    @if(session('success'))
      <div class="alert alert-success rounded-4 border-0" style="box-shadow:var(--soft-shadow);">
        {{ session('success') }}
      </div>
    @endif

    @yield('content')
  </main>

  {{-- FOOTER --}}
  <footer class="footer mt-auto pt-5 pb-4 mt-5">
    <div class="container">
      <div class="row g-4 mb-5">
        <div class="col-md-5 pe-lg-5">
          <a class="text-white text-decoration-none fw-bold fs-4 d-flex align-items-center gap-2 mb-3" href="{{ url('/') }}">
            <div class="bg-white text-dark rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
              <i class="bi bi-bag-heart-fill fs-6"></i>
            </div>
            <span style="letter-spacing: -0.5px;">MyShop<span style="color: #10b981;">.</span></span>
          </a>
          <p class="small lh-lg" style="color: #94a3b8; max-width: 300px;">
            Your premium destination for modern shopping. Discover top quality products with fast and reliable delivery.
          </p>
        </div>

        <div class="col-6 col-md-3 pt-md-2">
          <div class="footer-heading mb-3">Quick Links</div>
          <div class="d-flex flex-column gap-2 small">
            <a href="{{ route('front.categories.index') }}">Categories</a>
            <a href="#">New Arrivals</a>
            <a href="#">Best Sellers</a>
            <a href="#">About Us</a>
          </div>
        </div>

        <div class="col-6 col-md-4 pt-md-2">
          <div class="footer-heading mb-3">Contact Us</div>
          <div class="d-flex flex-column gap-3 small" style="color: #94a3b8;">
            <div class="d-flex align-items-start gap-2">
              <i class="bi bi-geo-alt fs-6 text-white"></i> 
              <span>Phnom Penh, Cambodia</span>
            </div>
            <div class="d-flex align-items-start gap-2">
              <i class="bi bi-telephone fs-6 text-white"></i> 
              <span>+855 (0) 12 345 678</span>
            </div>
            <div class="d-flex align-items-start gap-2">
              <i class="bi bi-envelope fs-6 text-white"></i> 
              <span>support@myshop.com</span>
            </div>
          </div>
        </div>
      </div>

      <div class="border-top" style="border-color: #1e293b !important;"></div>
      
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-center small mt-4" style="color: #64748b;">
        <span class="mb-3 mb-md-0">© {{ date('Y') }} MyShop. All rights reserved.</span>
        <div class="d-flex gap-3">
          <a href="#" class="text-white bg-dark rounded-circle d-flex align-items-center justify-content-center hover-lift" style="width:36px; height:36px; transition: 0.3s; background-color: rgba(255,255,255,0.05) !important;">
            <i class="bi bi-facebook"></i>
          </a>
          <a href="#" class="text-white bg-dark rounded-circle d-flex align-items-center justify-content-center hover-lift" style="width:36px; height:36px; transition: 0.3s; background-color: rgba(255,255,255,0.05) !important;">
            <i class="bi bi-telegram"></i>
          </a>
          <a href="#" class="text-white bg-dark rounded-circle d-flex align-items-center justify-content-center hover-lift" style="width:36px; height:36px; transition: 0.3s; background-color: rgba(255,255,255,0.05) !important;">
            <i class="bi bi-instagram"></i>
          </a>
        </div>
      </div>
    </div>
  </footer>

  {{-- TOAST (Add to cart popup) --}}
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="cartToast" class="toast align-items-center text-bg-dark border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
           Added to cart!
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  </div>

  {{-- SweetAlert2 --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  {{-- Bootstrap JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  {{-- Toast helper --}}
  <script>
    function showCartToast(message = " Added to cart!") {
      const el = document.getElementById('cartToast');
      el.querySelector('.toast-body').innerText = message;
      const toast = new bootstrap.Toast(el, { delay: 1800 });
      toast.show();
    }

    // If backend sets session('cart_toast'), show automatically
    @if(session('cart_toast'))
      document.addEventListener('DOMContentLoaded', () => {
        showCartToast(@json(session('cart_toast')));
      });
    @endif
  </script>

  @stack('scripts')
</body>
</html>

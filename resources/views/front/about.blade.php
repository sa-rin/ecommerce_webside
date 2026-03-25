@extends('layouts.app')

@section('title', 'About Us - MyShop')

@section('hero_title', 'About MyShop')
@section('hero_subtitle', 'Premium Quality • Trusted Service • Modern Experience')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">About Us</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container py-5">
    <div class="row g-5 align-items-center">
        <div class="col-lg-6">
            <div class="soft-card p-5">
                <h2 class="fw-bold mb-4 gradient-text">Our Story</h2>
                <p class="text-muted lh-lg mb-4">
                    Founded with a passion for excellence, MyShop has grown to become a leading destination for premium products. We believe that shopping should be an experience, not just a transaction.
                </p>
                <p class="text-muted lh-lg">
                    Our team is dedicated to sourcing the finest products from across the globe, ensuring each item meets our rigorous standards for quality and design.
                </p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row g-3">
                <div class="col-6">
                    <div class="soft-card p-4 text-center">
                        <i class="bi bi-star-fill text-warning fs-1 mb-2"></i>
                        <h4 class="fw-bold mb-0">4.9/5</h4>
                        <p class="small text-muted mb-0">Customer Rating</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="soft-card p-4 text-center">
                        <i class="bi bi-truck text-primary fs-1 mb-2"></i>
                        <h4 class="fw-bold mb-0">1-2 Days</h4>
                        <p class="small text-muted mb-0">Fast Delivery</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="soft-card p-4 text-center">
                        <i class="bi bi-shield-check text-success fs-1 mb-2"></i>
                        <h4 class="fw-bold mb-0">100%</h4>
                        <p class="small text-muted mb-0">Genuine Products</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="soft-card p-4 text-center">
                        <i class="bi bi-headset text-danger fs-1 mb-2"></i>
                        <h4 class="fw-bold mb-0">24/7</h4>
                        <p class="small text-muted mb-0">Expert Support</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .gradient-text {
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endsection

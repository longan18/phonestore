@extends('client.layouts.app')

@section('title')
    {{ __('Trang chủ') }}
@endsection

@section('style_css')
    @vite('resources/scss/client/item-product.scss')
@endsection

@section('content')
    @include('client.home.filter_product_home')
{{--    @include('client.home.brand_slide')--}}
    <section class="featured spad">
        <div class="container">
            <div class="listproduct">
               @foreach($products as $item)
                   <x-product-shop-item :product="$item"/>
               @endforeach
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="{{ asset('client_assets/js/home.js') }}"></script>
@endsection

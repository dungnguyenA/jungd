@extends('client.layouts.app')
@section('content')
    <div class="banner">
        <div class="banner-content">
            <img src="{{ asset('clients/images/b/1.jpg') }}" alt="">
        </div>
    </div>
    <div class="main-container left-slidebar">
        <div class="container">
            <div class="row">
                <div class="main-content col-sm-8 col-md-9">
                    <div class="shop-top">
                        <div class="shop-top-left">
                            <div class="breadcrumbs">
                                <a href="{{ url('/') }}">Home</a>
                                <span>Shop</span>
                            </div>
                        </div>

                    </div>
                    <ul id="shopList" class="product-list-grid desktop-columns-3 tablet-columns-2 mobile-columns-1 row">
                        @foreach ($list_products as $product)
                            <li class="product-item col-sm-6 col-md-4">
                                <div class="product-inner">
                                    <div class="product-thumb has-back-image">
                                        @if (count($product->image) > 0)
                                            <a href="{{ route('product_detail', $product->id) }}">
                                                <img src="{{ $product->image[0]->image_name ? '' . Storage::url($product->image[0]->image_name) : '' }}"
                                                    alt="">
                                            </a>
                                        @endif
                                        @if (count($product->image) > 1)
                                            <a class="back-image" href="{{ route('product_detail', $product->id) }}">
                                                <img src="{{ $product->image[1]->image_name ? '' . Storage::url($product->image[1]->image_name) : '' }}"
                                                    alt="">
                                            </a>
                                        @endif
                                        <div class="gorup-button">
                                            <a href="#" class="wishlist"><i class="fa fa-heart"></i></a>
                                            <a href="#" class="compare"><i class="fa fa-exchange"></i></a>
                                            <a href="{{ route('product_detail', $product->id) }}" class="quick-view"><i
                                                    class="fa fa-search"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-name">
                                            <a
                                                href="{{ route('product_detail', $product->id) }}">{{ $product->product_name }}</a>
                                        </h3>
                                        <span class="price">
                                            <ins
                                                style="text-decoration: line-through">{{ number_format($product->discount_price) }}vnđ</ins>
                                            <ins> {{ number_format($product->price) }}vnđ</ins>
                                        </span>
                                        <a href="" class="button add-to-cart"
                                            data-product-id="{{ $product->id }}">ADD TO CART</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="pagination">
                        {{ $list_products->links() }}
                    </div>

                </div>
                <div class="col-sm-4 col-md-3 sidebar">
                    <!-- Product category -->
                    <div class="widget widget_product_categories">
                        <h2 class="widget-title">Categories</h2>
                        <ul class="product-categories">
                            @foreach ($categories as $cate)
                                <li><a href="" data-category-id="{{ $cate->id }}">
                                    {{ $cate->category_name }}
                                    <span class="count">(100)</span></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- ./Product category -->
                    <!-- Product tags -->
                    <div class="widget widget_product_tag_cloud style2">
                        <h2 class="widget-title">BRANDS</h2>
                        <div class="tagcloud">
                            @foreach ($brands as $brand)
                                <a href="" data-brand-id="{{ $brand->id }}">{{ $brand->brand_name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <!-- ./Product tags -->
                    <!-- Filter price -->
                    <div class="widget widget_price_filter">
                        <h2 class="widget-title">Price Range</h2>
                        <div class="price_slider_wrapper">
                            <div class="amount-range-price">Price: 50,000<span class="currency-symbol">đ</span> - 1,000,000<span class="currency-symbol">đ</span></div>
                            <div data-label-reasult="Price:" data-min="50000" data-max="1000000" data-unit="đ" class="slider-range-price" data-value-min="50000" data-value-max="1000000"></div>
                        </div>
                    </div>
                    <!-- ./Filter price -->

                    <div class="widget widget_recent_product">
                        <h2 class="widget-title">TOP FAVORITE</h2>
                        <ul class="product-categories">
                            @foreach ($top_favorites as $fav)
                                <li>
                                    <div class="product-thumb">
                                        @if (count($fav->image) > 0)
                                            <a href="{{ route('product_detail', $fav->id) }}">
                                                <img src="{{ $fav->image[0]->image_name ? '' . Storage::url($fav->image[0]->image_name) : '' }}"
                                                    alt="">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-name"><a
                                                href="{{ route('product_detail', $fav->id) }}">{{ $fav->product_name }}</a>
                                        </h3>
                                        <span class="price">
                                            <ins
                                                style="text-decoration: line-through">{{ number_format($fav->discount_price) }}vnđ</ins>
                                            <ins> {{ number_format($fav->price) }}vnđ</ins>
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="margin-top-0 margin-bottom-0">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <div class="element-icon style2">
                            <div class="icon"><i class="flaticon flaticon-origami28"></i></div>
                            <div class="content">
                                <h4 class="title">FREE SHIPPING WORLD WIDE</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="element-icon style2">
                            <div class="icon"><i class="flaticon flaticon-curvearrows9"></i></div>
                            <div class="content">
                                <h4 class="title">MONEY BACK GUARANTEE</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="element-icon style2">
                            <div class="icon"><i class="flaticon flaticon-headphones54"></i></div>
                            <div class="content">
                                <h4 class="title">ONLINE SUPPORT 24/7</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // $(document).ready(function() {
        //     $('.button').click(function() {
        //         var minPrice = 0;
        //         var maxPrice = 500000;

        //         $.ajax({
        //             url: '{{ route('filter_price') }}',
        //             type: 'GET',
        //             data: { minPrice: minPrice, maxPrice: maxPrice },
        //             success: function(response) {
        //                 // Xử lý kết quả trả về từ máy chủ
        //                 console.log(response);
        //             },
        //             error: function(xhr) {
        //                 // Xử lý lỗi
        //                 console.log(xhr.responseText);
        //             }
        //         });
        //     });
        // });
    </script>
@endsection

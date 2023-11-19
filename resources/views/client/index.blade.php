@extends('client.layouts.app')
@section('content')
    <div class="owl-carousel nav-style4 nav-center-center " data-nav="true" data-dots="false" data-loop="true"
        data-autoplay="false" data-margin="0" data-responsive='{"0":{"items":1},"600":{"items":2},"1000":{"items":4}}'>
        <div class="banner-text style4">
            <div class="image">
                <a href="#"><img src="{{ asset('clients/images/slides/11-1.png') }}" alt=""></a>
            </div>
            <div class="content-text">
                <h4 class="subtitle">Trending</h4>
                <h3 class="title">Men fashion</h3>
                <a class="shop-now" href="#">shop now!</a>
            </div>
        </div>
        <div class="banner-text style4">
            <div class="image">
                <a href="#"><img src="{{ asset('clients/images/slides/11-2.png') }}" alt=""> </a>
            </div>
            <div class="content-text">
                <h4 class="subtitle">Trending</h4>
                <h3 class="title">autumn fashion</h3>
                <a class="shop-now" href="#">shop now!</a>
            </div>
        </div>
        <div class="banner-text style4">
            <div class="image">
                <a href="#"><img src="{{ asset('clients/images/slides/11-3.png') }}" alt=""></a>
            </div>
            <div class="content-text">
                <h4 class="subtitle">Trending</h4>
                <h3 class="title">autumn fashion</h3>
                <a class="shop-now" href="#">shop now!</a>
            </div>
        </div>
        <div class="banner-text style4">
            <div class="image">
                <a href="#"><img src="{{ asset('clients/images/slides/11-4.png') }}" alt=""></a>
            </div>
            <div class="content-text">
                <h4 class="subtitle">Trending</h4>
                <h3 class="title">Shoe fashion</h3>
                <a class="shop-now" href="#">shop now!</a>
            </div>
        </div>
    </div>
    <div class="margin-top-50">
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
    <div class="container">
        <span class="line margin-top-30"></span>
    </div>
    <div class="margin-top-55">
        <div class="container">
            <div class="tab-product tab-product-fade-effect">
                <ul class="box-tabs nav-tab">
                    <li class="active"><a data-animated="" data-toggle="tab" href="#tab-1">New Arrivals</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-container">
                        <div id="tab-1" class="tab-panel active">
                            <ul class="product-list-grid2 tab-list owl-carousel-mobile" data-nav="false" data-dots="false"
                                data-margin="0" data-loop="true" data-items="1">
                                @foreach ($list_products as $product)
                                    <li class="product-item style3 mobile-slide-item col-sm-4 col-md-3">
                                        <div class="product-inner">
                                            <div class="product-thumb has-back-image">
                                                @if (count($product->image) > 0)
                                                    <a href="{{ route('product_detail',$product->id) }}">
                                                        <img src="{{ $product->image[0]->image_name ? '' . Storage::url($product->image[0]->image_name) : '' }}"
                                                            alt="">
                                                    </a>
                                                @endif
                                                @if (count($product->image) > 1)
                                                    <a class="back-image" href="{{ url('/product-detail',$product->id) }}">
                                                        <img src="{{ $product->image[1]->image_name ? '' . Storage::url($product->image[1]->image_name) : '' }}"
                                                            alt="">
                                                    </a>
                                                @endif
                                                <div class="gorup-button">
                                                    <a href="#" class="wishlist"><i class="fa fa-heart"></i></a>
                                                    <a href="#" class="compare"><i class="fa fa-exchange"></i></a>
                                                    <a href="{{ route('product_detail',$product->id) }}" class="quick-view"><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>

                                            <div class="product-info">
                                                <h3 class="product-name">
                                                    <a href="{{ route('product_detail',$product->id) }}">{{ $product->product_name }}</a>
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-brand-slide margin-bottom-70">
        <div class="container">
            <div class="brands-slide owl-carousel nav-center-center nav-style7" data-nav="true" data-dots="false"
                data-loop="true" data-margin="60"
                data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":5}}'>
                <a href="#"><img src="{{ asset('clients/images/brands/brand1.png') }}" alt=""></a>
                <a href="#"><img src="{{ asset('clients/images/brands/brand2.png') }}" alt=""></a>
                <a href="#"><img src="{{ asset('clients/images/brands/brand3.png') }}" alt=""></a>
                <a href="#"><img src="{{ asset('clients/images/brands/brand4.png') }}" alt=""></a>
                <a href="#"><img src="{{ asset('clients/images/brands/brand5.png') }}" alt=""></a>
            </div>
        </div>
    </div>
    <div class="container">
        <span class="line margin-top-60"></span>
    </div>
    <div class="margin-top-60 section-lasttest-blog no-border">
        <div class="container">
            <div class="section-title text-center">
                <h3>Our BLog</h3>
            </div>
            <div class="lastest-blog owl-carousel nav-center-center nav-style7" data-nav="true" data-dots="false"
                data-loop="true" data-margin="30"
                data-responsive='{"0":{"items":1},"600":{"items":1},"1000":{"items":2}}'>
                <div class="item-blog">
                    <div class="left">
                        <div class="blog-date">
                            <span class="day">7</span>
                            <span class="month">/SEP</span><br>
                            <span class="year">2015</span>
                        </div>
                        <h3 class="blog-title"><a href="#">We're the best Designers from UK</a></h3>
                        <div class="meta">
                            <span class="author">John Doe</span>
                            <span class="comment"><i class="fa fa-comment"></i> 36 comments</span>
                        </div>
                    </div>
                    <div class="right">
                        <a class="banner-border" href="#"><img src="{{ asset('clients/images/blogs/1.jpg') }}"
                                alt=""></a>
                    </div>
                </div>
                <div class="item-blog">
                    <div class="left">
                        <div class="blog-date">
                            <span class="day">7</span>
                            <span class="month">/SEP</span><br>
                            <span class="year">2015</span>
                        </div>
                        <h3 class="blog-title"><a href="#">We're the best Designers from UK</a></h3>
                        <div class="meta">
                            <span class="author">John Doe</span>
                            <span class="comment"><i class="fa fa-comment"></i> 36 comments</span>
                        </div>
                    </div>
                    <div class="right">
                        <a class="banner-border" href="#"><img src="{{ asset('clients/images/blogs/2.jpg') }}"
                                alt=""></a>
                    </div>
                </div>
                <div class="item-blog">
                    <div class="left">
                        <div class="blog-date">
                            <span class="day">7</span>
                            <span class="month">/SEP</span><br>
                            <span class="year">2015</span>
                        </div>
                        <h3 class="blog-title"><a href="#">We're the best Designers from UK</a></h3>
                        <div class="meta">
                            <span class="author">John Doe</span>
                            <span class="comment"><i class="fa fa-comment"></i> 36 comments</span>
                        </div>
                    </div>
                    <div class="right">
                        <a class="banner-border" href="#"><img src="{{ asset('clients/images/blogs/1.jpg') }}"
                                alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="text-border margin-bottom-60">
            <p>FREE UK DELIVERY + RETURN OVER £85.00 (EXCLUDING HOMEWARE)| FREE UK COLLECT FROM STORE</p>
        </div>
    </div>
@endsection

@extends('client.layouts.app')
@section('content')
    <div class="container">
        <div class="shop-banner">
            <img src="{{ asset('clients/images/slides/slider-cat2.jpg') }}" alt="">
        </div>
        <div class="breadcrumbs style2">
            <a href="#">Home</a>
            <span>Product Detail</span>
        </div>
        <div class="row">
            <div class="main-content col-sm-12">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="product-detail-image style2">

                            <div class="main-image-wapper">
                                <img class="main-image"
                                    src="{{ $product_detail->image_name ? Storage::url($product_detail->image_name) : '' }}"
                                    alt="">
                            </div>
                            <div class="thumbnails owl-carousel nav-center-center nav-style3"
                                data-responsive='{"0":{"items":3},"481":{"items":4},"600":{"items":3},"1000":{"items":4}}'
                                data-autoplay="true" data-loop="true" data-items="4" data-dots="false" data-nav="true"
                                data-margin="20">
                                @foreach ($image as $item)
                                    <a data-url="{{ $item->image_name ? Storage::url($item->image_name) : '' }}"
                                        class="active" href="#"><img
                                            src="{{ $item->image_name ? Storage::url($item->image_name) : '' }}"
                                            alt=""></a>
                                    <a data-url="{{ $item->image_name ? Storage::url($item->image_name) : '' }}"
                                        class="active" href="#"><img
                                            src="{{ $item->image_name ? Storage::url($item->image_name) : '' }}"
                                            alt=""></a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="product-details-right style2">
                            <h3 class="product-name">{{ $product_detail->product_name }}</h3>
                            <span class="price">
                                <ins>{{ number_format($product_detail->price) }} vnđ</ins>
                                <del>{{ number_format($product_detail->discount_price) }} vnđ</del>
                            </span>
                            <div class="meta">
                                <span>Only 15 left 3</span>
                                <span>Availalbe: <span class="text-primary">In Stock</span></span>
                            </div>
                            <div class="short-descript">
                                {{ $product_detail->description }}
                            </div>
                            <a href="" class="button add-to-cart" data-product-id="{{ $product_detail->id }}">ADD TO
                                CART</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-slide upsell-products">
        <div class="section-title text-center">
            <h3>UPSELL PRODUCTS</h3>
        </div>
        <ul class="owl-carousel" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'
            data-autoplay="true" data-loop="true" data-items="4" data-dots="false" data-nav="false" data-margin="30">
            @foreach ($similar_products as $simpro)
                <li class="product-item">
                    <div class="product-inner">
                        <div class="product-thumb">
                            @if (count($simpro->image) > 0)
                                <a href="{{ route('product_detail', $simpro->id) }}">
                                    <img src="{{ $simpro->image[0]->image_name ? '' . Storage::url($simpro->image[0]->image_name) : '' }}"
                                        alt="">
                                </a>
                            @endif
                            <div class="gorup-button">
                                <a href="#" class="wishlist"><i class="fa fa-heart"></i></a>
                                <a href="#" class="compare"><i class="fa fa-exchange"></i></a>
                                <a href="{{ route('product_detail', $simpro->id) }}" class="quick-view"><i
                                        class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3 class="product-name"><a
                                    href="{{ route('product_detail', $simpro->id) }}">{{ $simpro->product_name }}</a></h3>
                            <span class="price">
                                <ins>{{ number_format($simpro->price) }} vnđ</ins>
                                <del>{{ number_format($simpro->discount_price) }} vnđ</del>
                            </span>
                            <a href="" class="button add-to-cart" data-product-id="{{ $simpro->id }}">ADD TO
                                CART</a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <!-- tab -->
    <div class="box-list-reviews">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12">
                    <div class="box-review">
                        <h4 class="title-border"><span class="text" >CUSTOMER REVIEWS</span><span class="subtext" id="countComment">
                            ({{ $count_comments }}Reviews )</span></h4>
                        <ol class="commentlist" id="listComment">
                            @foreach ($list_comments as $comment)
                                <li class="comment">
                                    <div class="comment_container">
                                        <div class="comment-info">
                                            <div class="meta">
                                                <span class="author">{{ $comment->name }}</span>
                                                <span class="date">{{ $comment->created_at }}</span>
                                            </div>
                                        </div>
                                        <div class="comment-text">
                                            <div class="comment-content">
                                                {{ $comment->content }}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-12">
                    <div class="box-review form-review">
                        <h4 class="title-border"><span class="text">ADD A REVIEW</span></h4>
                        <form id="commentForm" class="reviews" method="POST">
                            @csrf
                            <p>
                                <input type="text" name="name" value="{{ $user->name }}"
                                    placeholder="Your name" />
                            </p>
                            <p class="mt-5 mb-5">
                                <input type="email" name="email" value="{{ $user->email }}"
                                    placeholder="Your email" />
                            </p>
                            <p>
                                <textarea cols="40" id="content" name="content" placeholder="Your review"></textarea>
                            </p>
                            <input id="saveBtn" type="submit" class="button submit" value="ADD A REVIEW" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>> <!--END CONTAINER-->

    <!-- ./tab -->
    <div class="margin-top-60 margin-bottom-30">
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
    <script>
        $(function() {
            $('#saveBtn').on('click', function(e) {
                event.preventDefault();

                var formData = new FormData($('#commentForm')[0]);

                jQuery.ajax({
                    url: '{{ route('comment_product', $product_detail->id) }}',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        document.getElementById('countComment').innerHTML = '(' + response.count_comments + 'Reviews)';
                        $('#listComment').empty();

                        var commentArray = Object.values(response.list_comments);

                        commentArray.forEach(comment => {
                            var commentItemHtml =
                                `
                                <li class="comment">
                                    <div class="comment_container">
                                        <div class="comment-info">
                                            <div class="meta">
                                                <span class="author">${comment.name}</span>
                                                <span class="date">${comment.created_at}</span>
                                            </div>
                                        </div>
                                        <div class="comment-text">
                                            <div class="comment-content">
                                             ${comment.content}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            `;

                            $('#listComment').append(commentItemHtml);

                        });
                        $('#content').val('');
                    },
                    error: function(error) {
                        console.log('Lỗi');
                    }
                });
            });
        });
    </script>
@endsection

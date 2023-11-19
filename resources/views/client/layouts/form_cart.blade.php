<li class="mini_cart_wrapper">
    <a href="javascript:void(0)"><i class="zmdi zmdi-shopping-cart zmdi-hc-fw"></i>
        @php
            if (session()->has('cart')) {
                $cart = session('cart');
                $total = session('totalPrice');
                $totalQuantity = session('totalQuantity');
                $count = count($cart);
            } else {
                $count = 0;
            }
        @endphp
        <span class="item_count" id="number-cart">{{ $count }}</span></a>
    <!--mini cart-->
    <div class="mini_cart cart_scroll_box" id="show-cart">
        <div class="cart_gallery">
            @isset($cart)
                @if ($cart > 0)
                    @foreach ($cart as $c)
                        <div class="cart_item" data-delete-show-cart="{{ $c['product_id'] }}">
                            <div class="cart_img">
                                <a href="{{ route('shop.details', ['id' => $c['product_id']]) }}">
                                    <img src="{{ asset('storage/' . $c['image']) }}"></a>
                            </div>
                            <div class="cart_info">
                                <a href="{{ route('shop.details', ['id' => $c['product_id']]) }}">{{ $c['name'] }}</a>
                                <p><span> {{ number_format($c['total_price']) }} vnđ </span> X {{ $c['quantity'] }}</p>
                            </div>
                            <div class="cart_remove" data-delete-cart-id="{{ $c['product_id'] }}">
                                <a href="#"><i class="ion-android-close"></i></a>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endisset
        </div>
        <div class="mini_cart_table">
            <div class="cart_table_border">
                <div class="cart_total mt-10">
                    <span>Tổng số lượng:</span>
                    <span class="quantity-total fw-bold"
                        id="quantity-total">{{ number_format(isset($totalQuantity) > 0 ? $totalQuantity : 0) }} sản
                        phẩm</span>
                </div>
                <div class="cart_total mt-10">
                    <span>Tổng tiền:</span>
                    <span class="price" id="cart-total">{{ number_format(isset($total) > 0 ? $total : 0) }} vnđ</span>
                </div>
            </div>
        </div>
        <div class="mini_cart_footer">
            <div class="cart_button">
                <a href="{{ route('cart.list') }}">Giỏ hàng</a>
            </div>
            <div class="cart_button">
                <a href="{{ route('cart.checkOut') }}"> Tiến hành thanh toán</a>
            </div>
        </div>
    </div>
    <!--mini cart end-->
</li>

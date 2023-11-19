<div id="box-mobile-menu" class="box-mobile-menu full-height full-width">
    <div class="box-inner">
        <span class="close-menu"><span class="icon pe-7s-close"></span></span>
    </div>
</div>
{{-- <div id="header-ontop" class="is-sticky">

</div> --}}
<header id="header" class="header style3">
    <div class="container">
        <div class="topbar">
            <ul class="boutique-nav topbar-menu right">
                <li class="menu-item-has-children">
                    @if (Route::has('login'))
                        @auth
                            <ul>
                                <li>
                                    <x-app-layout>

                                    </x-app-layout>
                                </li>
                            </ul>
                        @else
                            <a href=""><i class="fa fa-lock"></i> Account</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('login') }}"><i
                                            class="icon-lock-open icons"></i><span>Login</span></a></li>
                                <li><a href="{{ route('register') }}"><i
                                            class="icon-lock-open icons"></i><span>Register</span></a></li>
                            </ul>
                        @endauth
                    @endif
                </li>
            </ul>
        </div>

        <div class="main-menu-wapper">
            <div class="row">
                <div class="col-sm-12 col-md-3 logo-wapper">
                    <div class="logo">
                        <a href=""><img src="{{ asset('clients/images/logos/1.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9 menu-wapper">
                    <div class="top-header">
                        <span class="mobile-navigation"><i class="fa fa-bars"></i></span>
                        <div class="slogan">"Boutique is a reflection of you!"</div>
                        <div class="box-control">
                            <form class="box-search">
                                <div class="inner" style="margin-right: 130px">
                                    <input type="text" class="search" placeholder="Search here...">
                                    <button class="button-search" style="margin-right: 80px"><span
                                            class="pe-7s-search"></span></button>
                                </div>
                            </form>
                            <div class="mini-cart cart-icon">

                                    @if (isset($pathUrl) != 'view-cart')
                                        <a class="cart-link" href="">
                                            <span class="icon pe-7s-cart cart "></span>
                                            <span class="count" id="number-cart">{{ count(session('cart', [])) }}</span>
                                        </a>
                                        <div class="show-shopping-cart">
                                            <h3 class="title">YOU HAVE <span class="text-primary"
                                                    id="number-items">({{ count(session('cart', [])) }}) ITEMS</span> IN
                                                YOUR CART
                                            </h3>
                                            <ul class="list-product" id="mini-cart-items">
                                                @isset($carts)
                                                    @if ($carts > 0)
                                                        @foreach ($carts as $cart)
                                                            <li>
                                                                <div class="thumb">
                                                                    <img src="{{ asset('storage/' . $cart['image']) }}"
                                                                        alt="">
                                                                </div>
                                                                <div class="info">
                                                                    <h4 class="product-name">
                                                                        <a href="">{{ $cart['product_name'] }}
                                                                        </a>
                                                                    </h4>
                                                                    <span
                                                                        class="price">{{ $cart['quantity'] }}x{{ number_format($cart['price']) }}
                                                                        vnđ</span>
                                                                    <div id="delete-cart" class="remove-item"
                                                                        data-delete-cart-id="{{ $cart['id'] }}">
                                                                        <i class="fa fa-close"></i>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                @endisset
                                            </ul>

                                            <div class="sub-total">
                                                <div id="cart-total">Subtotal: <span
                                                        id="subtotal-value">{{ number_format(session('totalPrice')) }}</span>
                                                    vnđ</div>
                                            </div>

                                            <div class="group-button">
                                                <a href="{{ route('view_cart') }}" class="button">Shopping Cart</a>
                                                <a href="{{ route('check_out') }}" class="check-out button">CheckOut</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <ul class="boutique-nav main-menu clone-main-menu">
                            <li class="active menu-item-has-children item-megamenu">
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="">Pages</a>
                                <span class="arow"></span>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('view-cart') }}">Cart</a></li>
                                    <li><a href="{{ route('my_order') }}">My Orders</a></li>
                                    <li><a href="{{ route('order_history') }}">Orders History</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children item-megamenu">
                                <a href="{{ url('/shop') }}">Shop</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ url('/blog') }}">BLOG</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ url('/contact') }}">CONTACT</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

@extends('client.layouts.app')
@section('content')
    <div class="main-container no-sidebar">
        <div class="container">
            <div class="main-content">
                <div class="page-title">
                    <h3>SHOPPING CART</h3>
                </div>
                <form id="updateCartForm" action="{{ route('update_cart') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="cart-table-container col-sm-12 col-md-8">
                            <table class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Qty</th>
                                        <th class="product-subtotal">Total</th>
                                        <th class="product-remove">&nbsp;</th>
                                    </tr>
                                </thead>
                                @php $subTotal = 0 @endphp
                                <tbody>
                                    @foreach ($cart as $item)
                                        <input type="hidden" name="products[{{ $loop->index }}][productId]" value="{{ $item['id'] }}">
                                        @php $subTotal += $item['total_price'] @endphp
                                        <tr>
                                            <td class="product-thumbnail">
                                                @if (isset($item['image']))
                                                    <img src="{{ Storage::url($item['image']) }}" alt="">
                                                @endif
                                            </td>
                                            <td class="product-name"><a href="#">{{ $item['product_name'] }}</a></td>
                                            <td>{{ number_format($item['price']) }} vnđ</td>
                                            <td><input class="qty" id="quantity_{{ $item['id'] }}" name="products[{{ $loop->index }}][quantity]" type="number" value="{{ $item['quantity'] }}"></td>
                                            <td id="totalPrice_{{ $item['id'] }}">{{ number_format($item['total_price']) }} vnđ</td>
                                            <td class="product-remove">
                                                <a id="checkDelete" href="{{ route('destroy_cart',$item['id']) }}">
                                                    <i class="fa fa-close"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="box-cart-total">
                                <h2 class="title">Cart Totals</h2>
                                <table>
                                    <tr>
                                        <td>Subtotal</td>
                                        <td><span id="total" class="price">{{ number_format($subTotal) }} vnđ</span></td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td>
                                            <label><input name="shipping" type="radio" checked>Free Shipping</label>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <td>Total</td>
                                        <td><span id="totals" class="price">{{ number_format($subTotal) }} vnđ</span></td>
                                    </tr>
                                </table>
                                <button class="button medium">UPDATE CART</button>
                                <a href="{{ route('check_out') }}" id="checkoutButton" class="button btn-primary medium checkout-button">PROCEED TO CHECKOUT</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="margin-top-60">
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
@endsection

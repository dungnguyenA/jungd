@extends('client.layouts.app')
@section('content')
    <div class="main-container no-sidebar">
        <div class="container">
            <div class="main-content">
                <div class="page-title">
                    <h3>CHECKOUT</h3>
                </div>
                <div class="alert alert-success" style="display: none;">
                    @if (session()->has('success'))
                        <span>{{ session()->get('success') }}</span>
                    @endif
                </div>
                <form id="place-order-form" action="{{ route('place_order') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-checkout">
                                <h5 class="form-title">BILLING ADDRESS</h5>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p><input type="text" value="{{ $dataUser->name }}" name="name"
                                                placeholder="Name"></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p><input type="text" value="{{ $dataUser->email }}" name="email"
                                                placeholder="Email"></p>
                                    </div>
                                </div>
                                <p><input type="text" value="{{ $dataUser->phone }}" name="phone" placeholder="Phone">
                                </p>
                                <p><input type="text" value="{{ $dataUser->address }}" name="address"
                                        placeholder="Address"></p>
                            </div>
                            <div class="form-checkout checkout-payment"></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-checkout order">
                                <h5 class="form-title">YOUR ORDER</h5>
                                <table class="shop-table order">
                                    <thead>
                                        <tr>
                                            <th class="product-name">PRODUCT</th>
                                            <th class="qty">Quantity</th>
                                            <th class="total">TOTAL</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($cart_CheckOut as $cart)
                                            <tr class="remove">
                                                <td class="product-name">{{ $cart['product_name'] }}</td>
                                                <td class="qty">{{ $cart['quantity'] }}</td>
                                                <td class="total"><span
                                                        class="price">{{ number_format($cart['total_price']) }} vnđ</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="subtotal">Subtotal</td>
                                            <td></td>
                                            <td class="total"><span class="price">{{ number_format($totalPrice) }}
                                                    vnđ</span></td>
                                        </tr>
                                        <tr>
                                            <td class="subtotal">Coupon Discount</td>
                                            <td></td>
                                            <td class="total">0%</td>
                                        </tr>
                                        <tr class="order-total">
                                            <td class="subtotal">ORDER TOTAL</td>
                                            <td></td>
                                            <td class="total"><span class="price">{{ number_format($totalPrice) }}
                                                    vnđ</span></td>
                                        </tr>

                                    </tbody>

                                </table>
                            </div>
                            <div class="form-checkout checkout-payment">
                                <h5 class="form-title">YOUR PAYMENT</h5>
                                <div class="payment_methods">
                                    <div class="payment_method">
                                        <label><input name="payment_method" type="radio">CASH ON DELIVERY</label>
                                    </div>
                                </div>
                                <button type="submit" class="button btn-primary medium">PROCEED TO CHECKOUT</button>
                            </div>
                    </form>
                <div class="form-checkout checkout-payment">
                    <div class="payment_methods">
                        @include('client.stripe')
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="margin-top-10">
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
        // Place Order
        $('#place-order-form').submit(function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: '{{ route('place_order') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.success,
                        showConfirmButton: false,
                        timer: 1500
                    })

                    // Đặt giá trị giỏ hàng thành 0
                    document.getElementById("number-cart").innerHTML = response.cartCount;
                    document.getElementById("number-items").innerHTML = response.cartCount;
                    document.getElementById("subtotal-value").innerHTML = response.totalPrice;
                    $('#mini-cart-items').empty();

                    // Xóa các sản phẩm trong giỏ hàng
                    $('.remove').empty();
                    $('.form-checkout.order .total .price').text('0 vnđ');
                    $('.form-checkout.order .order-total .price').text('0 vnđ');

                    // Xóa thông tin giỏ hàng trong session
                    sessionStorage.removeItem('cart');
                },
                error: function(xhr) {
                    // Xử lý lỗi
                    console.log(xhr.responseText);
                    // Hiển thị thông báo lỗi
                }
            });
        });
    </script>
@endsection

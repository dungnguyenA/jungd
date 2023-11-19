<!DOCTYPE html>
<html lang="en">

<head>
    @include('client.layouts.style')
</head>
@php $carts = session('cart', []); @endphp
@php use Illuminate\Support\Facades\Auth; @endphp
<body class="home">
    @include('client.layouts.header')

    @yield('content')

    @include('client.layouts.footer')

    @include('client.layouts.footer-js')

</body>

<!-- Mirrored from html.kutethemes.com/boutique/html/index11.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 29 Jun 2023 15:05:38 GMT -->

</html>

@extends('client.layouts.app')
@section('content')
    <div class="container">
        <p style="font-size: 25px">My Order Detail</p>
        @php
            $count = 0;
        @endphp
        <table class=" table">
            <tr>
                <th class="th-qty"></th>
                <th class="th-qty">Image</th>
                <th class="th-qty">Product Name</th>
                <th class="th-qty">Quantity</th>
                <th class="th-qty">Price</th>
            </tr>
            @foreach ($myOrder_Detail as $order)
                <tr>
                    <td class="th-qty">{{ ++$count }}</td>
                    <td class="th-qty"><img src="{{ $order->image_name ? ''. Storage::url($order->image_name) : '' }}" alt="" style="width: 80px"> </td>
                    <td class="th-qty">{{ $order->product_name }}</td>
                    <td class="th-qty">{{ $order->quantity}}</td>
                    <td class="th-qty">{{number_format( $order->price)}} vnđ</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

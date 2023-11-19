@extends('client.layouts.app')
@section('content')
    <div class="container">
        @if(session()->has('success'))
            <span class="alert alert-danger mx-5">{{ session()->get('success') }}</span>
        @endif
        @if(session()->has('error'))
            <span class="alert alert-danger mx-5">{{ session()->get('error') }}</span>
        @endif
        <p style="font-size: 25px;margin-top: 20px">My Orders</p>
        @php
            $count = 0;
        @endphp
       
        <table class="group-product table mt-10">
            <tr>
                <th class="th-qty">Order</th>
                <th class="th-qty">Status</th>
                <th class="th-qty">Payment_Status</th>
                <th class="th-qty">Time Order</th>
                <th class="th-qty">Total</th>
                <th class="th-qty">Action</th>
            </tr>
            @foreach ($myOrder as $order)
                <tr>
                    <td class="th-qty">{{ ++$count }}</td>
                    <td class="th-qty">{{ $order->status }}</td>
                    <td class="th-qty">{{ $order->payment_status }}</td>
                    <td class="th-qty">{{ $order->created_at }}</td>
                    <td class="th-qty">{{ number_format($order->total) }} vnđ</td>
                    <td class="th-qty">
                         <a href="{{route('my_order_detail',$order->id ) }}" class="btn btn-success">View</a>
                         <a href="{{route('cancel_order',$order->id ) }}" class="btn btn-danger">Cancel Order</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

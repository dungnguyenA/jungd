<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function list_order()
    {
        $list_order = Order::paginate(8);

        return view('admin.order.list_order', compact('list_order'));
    }

    public function order_detail(Request $request, $id)
    {

        $orderDetail = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->leftJoin('images', function ($join) {
                $join->on('products.id', '=', 'images.product_id')
                    ->whereRaw('images.id = (SELECT id FROM images WHERE product_id = products.id LIMIT 1)');
            })
            ->select('orders.*', 'products.product_name as product_name', 'order_details.*', 'images.image_name')
            ->where('orders.id', $id)
            ->get();

        return view('admin.order.order_detail', compact('orderDetail'));
    }

    public function update_status(REQUEST $request, $id)
    {
        $update_status = Order::find($id);

        if ($update_status) {

            $update_status->status = $request->status;
            $update_status->save();

        }

        // return response()->json(['success' => 'Update Status thành công']);
        return redirect()->back();
    }
}

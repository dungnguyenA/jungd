<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Brand;
use App\Models\Categories;
use App\Models\Comment;
use App\Models\Images;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Products;
use App\Models\User;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class HomeController extends Controller
{
    public function index(REQUEST $request)
    {
        $list_products = Products::with('image')->take(8)->get();

        return view('client.index', compact('list_products'));
    }

    public function product_detail(REQUEST $request, $id)
    {

        $user = User::where('id', Auth::user()->id)->first();

        $product_detail = Products::join('images', 'products.id', '=', 'images.product_id')
            ->select('products.*', 'images.image_name')
            ->where('products.id', $id)
            ->first();
        $product_detail->view += 1;

        $image = Images::where('product_id', $id)->get();

        $similar_products = Products::with('image')
            ->where('category_id', $product_detail->category_id)
            ->where('id', '!=', $id)
            ->get();

        $product_detail->save();

        $list_comments = DB::table('comments')
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->select('comments.*', 'users.name')
            ->orderBy('comments.created_at', 'desc')
            ->where('comments.product_id', $id)
            ->get();
        $count_comments = Comment::where('product_id', $id)->count();

        return view('client.product_detail', compact(
            'product_detail',
            'image',
            'similar_products',
            'user',
            'list_comments',
            'count_comments'
        ));
    }

    public function comment(Request $request, $id)
    {
        $user = User::where('id', Auth::user()->id)->first();

        $product = Products::find($id);

        $comment = new Comment();

        $comment->content = $request->input('content');
        $comment->user_id = $user->id;
        $comment->product_id = $product->id;

        $comment->save();

        $list_comments = DB::table('comments')
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->select('comments.*', 'users.name')
            ->orderBy('comments.created_at', 'desc')
            ->where('comments.product_id', $id)
            ->get();

        $count_comments = $list_comments->count();

        return response()->json([
            'list_comments' => $list_comments,
            'count_comments' => $count_comments
        ]);
    }

    public function add_cart(REQUEST $request)
    {
        $productId = $request->productId;

        $product = DB::table('products as A')
            ->join('images as B', 'B.product_id', '=', 'A.id')
            ->where('A.id', $productId)
            ->select('A.id as product_id', 'A.product_name', 'A.price', 'B.image_name')
            ->first();

        $cart = session()->get('cart', []);

        if (array_key_exists($productId, $cart)) {
            $cart[$productId]['quantity'] += 1;
            $cart[$productId]['total_price'] = $cart[$productId]['quantity'] * $cart[$productId]['price'];
        } else {
            $cart[$productId] = [
                'id' => $product->product_id,
                'product_name' => $product->product_name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image_name,
                'total_price' => $product->price,
            ];
        }

        $request->session()->put('cart', $cart);

        $cartCount = count($cart);

        $totalPrice = 0;

        foreach ($cart as $item) {
            $totalPrice += $item['total_price'];
        }

        $request->session()->put('totalPrice', $totalPrice);

        return response()->json([
            'message' => 'Thêm sản phẩm thành công',
            'cartCount' => $cartCount,
            'cartItems' => $cart,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function view_cart(REQUEST $request)
    {
        $cart = $request->session()->get('cart', []);
        $pathUrl = $request->segment(1);

        return view('client.cart', compact('cart', 'pathUrl'));
    }

    public function delete_cart(Request $request)
    {
        $productId = $request->productId;

        $cart = session()->get('cart', []);

        if (array_key_exists($productId, $cart)) {

            unset($cart[$productId]);
            $request->session()->put('cart', $cart);

            $cartCount = count($cart);

            $totalPrice = 0;

            foreach ($cart as $item) {
                $totalPrice += $item['total_price'];
            }

            $request->session()->put('totalPrice', $totalPrice);
            return response()->json([
                'message' => 'Xoá sản phẩm thành công',
                'cartCount' => $cartCount,
                'cartItems' => $cart,
                'totalPrice' => $totalPrice,
            ]);
        }

        return response()->json([
            'message' => 'Sản phẩm không tồn tại trong giỏ hàng',
        ], 404);
    }
    
    public function destroy_cart(Request $request, $id)
    {
        $cart = $request->session()->get('cart', []);

        if (array_key_exists($id, $cart)) {
            unset($cart[$id]);
            $request->session()->put('cart', $cart);

            $cartCount = count($cart);

            // $totalPrice = 0;

            // foreach ($cart as $item) {
            //     $totalPrice += $item['total_price'];
            // }
            // Tính toán lại tổng giá trị của giỏ hàng
            $totalPrice = array_sum(array_column($cart, 'total_price'));


            $request->session()->put('totalPrice', $totalPrice);
        }

        return redirect()->back();
    }

    public function update_cart(REQUEST $request)
    {
        $products = $request->input('products');

        $cart = session()->get('cart', []);
        if (is_array($products) || is_object($products)) {
            foreach ($products as $product) {
                $productId = $product['productId'];
                $quantity = $product['quantity'];

                if (isset($cart[$productId])) {
                    $cart[$productId]['quantity'] = $quantity;
                    $cart[$productId]['total_price'] = $cart[$productId]['quantity'] * $cart[$productId]['price'];
                }
            }
        }
        $request->session()->put('cart', $cart);

        $cartCount = count($cart);

        $totalPrice = 0;

        foreach ($cart as $item) {
            $totalPrice += $item['total_price'];
        }

        $request->session()->put('totalPrice', $totalPrice);

        return response()->json([
            'message' => 'Cập nhật sản phẩm thành công',
            'cartCount' => $cartCount,
            'cartItems' => $cart,
            'totalPrice' => $totalPrice,
        ]);
    }


    public function place_order(Request $request)
    {

        $user_name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');

        $carts = $request->session()->get('cart', []);
        $userId = Auth::user()->id;

        $order = new Order();

        $order->user_name = $user_name;
        $order->email = $email;
        $order->phone = $phone;
        $order->address = $address;

        $order->user_id = $userId;
        $order->payment_status = 'CASH ON DELIVERY';
        $order->status = 'Processing';
        $order->total = 0;
        $order->save();

        $total = 0;

        foreach ($carts as $cart_order) {

            $quantity = $cart_order['quantity'];
            $price = $cart_order['price'];
            $productId = $cart_order['id'];

            $total += $quantity * $price;

            $orderDetail = new Order_detail();

            $orderDetail->quantity = $quantity;
            $orderDetail->price = $price;
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $productId;

            $orderDetail->save();
        }

        $order->total = $total;

        $order->save();
        $request->session()->forget('cart');

        $request->session()->put('totalPrice', 0);

        $cartCount = count($request->session()->get('cart', []));

        $totalPrice = $request->session()->get('totalPrice', 0);
        return response()->json([
            'success' => 'Đặt hàng thành công',
            'cartCount' => $cartCount,
            'totalPrice' => $totalPrice
        ]);
    }


    public function shop()
    {
        $list_products = Products::with('image')->paginate(9);
        $brands = Brand::all();
        $categories = Categories::all();

        $top_favorites = Products::with('image')
            ->orderBy('view', 'desc')->take(5)
            ->get();
        return view('client.shop', compact('list_products', 'brands', 'categories', 'top_favorites'));
    }


    public function filter_product(REQUEST $request)
    {
        $categoryId = $request->input('category_id');
        $brandId = $request->input('brand_id');

        $query = Products::with('image');

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($brandId) {
            $query->where('brand_id', $brandId);
        }

        $products = $query->get();

        return response()->json(['products' => $products]);
    }

    public function filter_price(REQUEST $request)
    {

        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');

        $products = Products::with('image')
            ->whereBetween('price', [$minPrice, $maxPrice])->get();

        return response()->json(['products' => $products]);
    }

    public function blog()
    {
        return view('client.blog');
    }

    public function check_out(REQUEST $request)
    {
        $dataUser = User::where('id', '=', Auth::user()->id)->first();

        $cart_CheckOut = $request->session()->get('cart', []);

        $totalPrice = 0;

        foreach ($cart_CheckOut as $item) {
            $totalPrice += $item['total_price'];
        }

        return view('client.checkout', compact('dataUser', 'cart_CheckOut', 'totalPrice'));
    }

    public function my_order()
    {

        $myOrder = Order::where('user_id', '=', Auth::user()->id)
            ->where('status', '!=', 'Delivered successfully')
            ->get();
        return view('client.myorder', compact('myOrder'));
    }

    public function order_history()
    {

        $orderHistory = Order::where('user_id', '=', Auth::user()->id)
            ->where('status', '=', 'Delivered successfully')
            ->get();
        return view('client.order_history', compact('orderHistory'));
    }

    public function my_order_detail(Request $request, $id)
    {

        $myOrder_Detail = DB::table('orders')
            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->leftJoin('images', function ($join) {
                $join->on('products.id', '=', 'images.product_id')
                    ->whereRaw('images.id = (SELECT id FROM images WHERE product_id = products.id LIMIT 1)');
            })
            ->select('orders.*', 'products.product_name as product_name', 'order_details.*', 'images.image_name')
            ->where('orders.id', $id)
            ->get();

        return view('client.myorder_detail', compact('myOrder_Detail'));
    }

    public function cancel_order(Request $request, $id)
    {

        $cancel = Order::find($id);

        if ($cancel->status !== 'Processing') {

            return redirect()->back()->with('error', 'Bạn không thể huỷ đơn hàng này');
        }

        $cancel->status = 'cancelled';
        $cancel->save();

        return redirect()->back()->with('success', 'Huỷ đơn hàng thành công');
    }

    public function stripe_order(Request $request, $total)
    {
        $idUser = Auth::user()->id;
        $dataUser = User::where('id', '=', $idUser)->first();
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentIntent = PaymentIntent::create([
            'amount' => $total,
            'currency' => 'vnd',
            'payment_method_data' => [
                'type' => 'card',
                'card' => [
                    'token' => $request->stripeToken,
                ],
            ],
            'description' => 'Thank for payment.'
        ]);

        $paymentIntent->confirm();

        $user_name = $dataUser->name;
        $email = $dataUser->email;
        $phone = $dataUser->phone;
        $address = $dataUser->address;

        $carts = $request->session()->get('cart', []);
        $userId = Auth::user()->id;

        $order = new Order();

        $order->user_name = $user_name;
        $order->email = $email;
        $order->phone = $phone;
        $order->address = $address;

        $order->user_id = $userId;
        $order->payment_status = 'PAID';
        $order->status = 'Processing';
        $order->total = 0;
        $order->save();

        $total = 0;

        foreach ($carts as $cart_order) {

            $quantity = $cart_order['quantity'];
            $price = $cart_order['price'];
            $productId = $cart_order['id'];

            $total += $quantity * $price;

            $orderDetail = new Order_detail();

            $orderDetail->quantity = $quantity;
            $orderDetail->price = $price;
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $productId;

            $orderDetail->save();
        }

        $order->total = $total;

        $order->save();
        $request->session()->forget('cart');

        $request->session()->put('totalPrice', 0);

        $cartCount = count($request->session()->get('cart', []));

        $totalPrice = $request->session()->get('totalPrice', 0);

        // return response()->json([
        //     'success' => 'Đặt hàng thành công',
        //     'cartCount' => $cartCount,
        //     'totalPrice' => $totalPrice
        // ]);

        return redirect()->back()->with('success', 'Thanh toán thành công');
    }

    public function contact()
    {
        return view('client.contact');
    }
}

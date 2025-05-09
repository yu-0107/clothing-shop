<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // 顯示結帳頁
    public function checkout()
    {
        $cart = session('cart', []);
        $cartProducts = \App\Models\Product::whereIn('id', array_keys($cart))->get();
        $total = 0;
        foreach ($cartProducts as $product) {
            $total += $product->price * $cart[$product->id];
        }
        return view('orders.checkout', compact('cart', 'cartProducts', 'total'));
    }

    // 建立訂單
    public function store(Request $request)
    {
        $cart = session('cart', []);
        $cartProducts = \App\Models\Product::whereIn('id', array_keys($cart))->get();
        $total = 0;
        foreach ($cartProducts as $product) {
            $total += $product->price * $cart[$product->id];
        }

        $order = \App\Models\Order::create([
            'user_id' => auth()->id(),
            'receiver_name' => $request->receiver_name,
            'receiver_phone' => $request->receiver_phone,
            'receiver_address' => $request->receiver_address,
            'total' => $total,
            'status' => 'pending'
        ]);

        // 清空購物車
        session()->forget('cart');

        // 加入成功提示訊息
        return redirect()->route('orders.user')->with('success', '訂單已成功送出！');
    }

    public function userOrders()
    {
        $orders = \App\Models\Order::where('user_id', auth()->id())->latest()->paginate(10);
        return view('orders.user', compact('orders'));
    }
}

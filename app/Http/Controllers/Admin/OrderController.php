<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('user', 'items.product')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', '訂單已更新');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', '訂單已刪除');
    }

    public function checkout()
    {
        $cart = session('cart', []);
        $cartProducts = \App\Models\Product::whereIn('id', array_keys($cart))->get();
        $total = 0;
        foreach ($cartProducts as $product) {
            $total += $product->price * $cart[$product->id];
        }
        return view('order.checkout', compact('cart', 'cartProducts', 'total'));
    }
} 
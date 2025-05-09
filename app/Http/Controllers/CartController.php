<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // 顯示購物車內容
    public function index()
    {
        $cart = session()->get('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();
        return view('cart.index', compact('cart', 'products'));
    }

    // 加入購物車
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }
        session(['cart' => $cart]);
        return redirect()->route('cart.index')->with('success', '已加入購物車');
    }

    // 更新購物車數量
    public function update(Request $request)
    {
        $quantities = $request->input('quantities', []);
        $cart = session()->get('cart', []);
        foreach ($quantities as $productId => $qty) {
            $qty = max(1, intval($qty));
            if (isset($cart[$productId])) {
                $cart[$productId] = $qty;
            }
        }
        session(['cart' => $cart]);
        // 這裡可以直接導向結帳頁
        return redirect('/checkout');
    }

    // 移除購物車
    public function remove(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session(['cart' => $cart]);
        return redirect()->route('cart.index')->with('success', '已移除商品');
    }
}

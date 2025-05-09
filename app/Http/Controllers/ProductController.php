<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 商品列表
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Product::with('category');

        // 可加上分類篩選
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->paginate(12);
        return view('home.index', compact('products', 'categories'));
    }

    // 商品詳情
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('product.show', compact('product'));
    }

    public function categoryProducts(Category $category)
    {
        $categories = Category::all();
        $products = $category->products()->latest()->paginate(10);
        return view('home.index', [
            'categories' => $categories,
            'products' => $products,
            'currentCategory' => $category,
        ]);
    }
}

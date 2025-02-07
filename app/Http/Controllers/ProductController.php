<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Category;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('creator', 'store', 'category')->get();
        if (auth()->user()->role != 'admin') {
            $products = $products->where('created_by', auth()->user()->id);
        }
        return view('marchent.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stores = Store::get();
        if (auth()->user()->role != 'admin') {
            $stores->where('created_by', auth()->user()->id);
        }
        return view('marchent.product.create', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'store_id' => 'required|exists:stores,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            $product = new Product();
            $product->store_id = $request->store_id;
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->created_by = auth()->id();
            $product->save();

            return redirect()->route('product.list')->with('success', 'Product Added Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! ' . $e->getMessage()); 
        }
    }
    public function getProductsByCategory(Request $request) {
        $categoryId = $request->category_id;
        $category = Category::with('products')->find($categoryId);

        $html = '';
        if ($category && $category->products->count() > 0) {
            foreach ($category->products as $product) {
                $html .= '<div class="col-md-3 mb-3 product-card">
                            <div class="card">
                                <div class="card-icon"><i class="fas fa-box-open"></i></div>
                                <div class="card-body">
                                    <h5 class="card-title">'.$product->name.'</h5>
                                    <p class="card-text"><strong>Price:</strong> $'.$product->price.'</p>
                                </div>
                            </div>
                          </div>';
            }
        } else {
            $html = '<p class="text-center">No products available in this category.</p>';
        }

        return response()->json($html);
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}

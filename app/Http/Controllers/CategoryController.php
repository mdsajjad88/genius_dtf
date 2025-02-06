<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('creator', 'store')->get();
        if (auth()->user()->role != 'admin') {
            $categories = $categories->where('created_by', auth()->user()->id);
        }
        return view('marchent.category.index', compact('categories'));
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
        return view('marchent.category.create', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'store_id' => 'required',
        ]);

        try {
            $category = new Category();
            $category->store_id = $request->store_id;
            $category->name = $request->name;
            $category->created_by = auth()->id();
            $category->save();
            return redirect()->route('category.list')->with('success', 'Category Added Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
    public function getCategoriesByStore(Request $request)
    {
        $categories = Category::where('store_id', $request->store_id)->get();
        return response()->json($categories);
    }

}

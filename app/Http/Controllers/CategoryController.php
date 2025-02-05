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

        return view('marchent.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stores = Store::get();
        if(auth()->user()->role != 'admin'){
            $stores->where('created_by', auth()->user()->id);
        }
        return view('marchent.category.create', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
}

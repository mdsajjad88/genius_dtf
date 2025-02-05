<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Session;
class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::with('creator')->get();
        if(auth()->user()->role != 'admin'){
            $stores = $stores->where('created_by', auth()->user()->id);
        }
        return view('marchent.store.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('marchent.store.create', );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate request
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    try {
        // Create and save the store
        $store = new Store();
        $store->name = $request->name;
        $store->created_by = auth()->id();
        $store->save();

        // Redirect with success message if store is added successfully
        return redirect()->route('store.list')->with('success', 'Store Added Successfully');
    } catch (\Exception $e) {
        // Redirect back with error message if something goes wrong
        return redirect()->back()->with('error', 'Something went wrong! Please try again.');
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

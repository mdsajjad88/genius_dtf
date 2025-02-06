@extends('layouts.app2')

@section('title', 'product List')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <h4 class="text-center">product List</h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Store Name</th>
                            <th>Category Name</th>
                            <th>Product Name</th>
                            <th>Created By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{$product->store->name}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->creator->name}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No Products</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

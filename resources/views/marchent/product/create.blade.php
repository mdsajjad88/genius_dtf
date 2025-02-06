@extends('layouts.app2')

@section('title', 'Create Product')
@section('content')
<div class="container-fluid d-flex justify-content-center mt-4">
    <div class="col-md-6">
        {{-- Display general error message (for try-catch errors) --}}
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- Display validation error messages --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">Create New Product</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('product.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="">Select Store</label>
                        <select name="store_id" id="" class="form-control">
                            <option value="">Select Store</option>
                            @foreach ($stores as $store)
                            <option value="{{$store->id}}">{{$store->name}}</option>
                            @endforeach
                        </select>
                        <label for="">Select Category</label>
                        <select name="category_id" id="category_id" class="form-control">

                        </select>
                        <label for="name" class="form-label">Product Name</label>

                        <input type="text" class="form-control"
                               id="name" name="name" placeholder="Enter Product Name" value="{{ old('name') }}" required>

                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@extends('layouts.app2')

@section('title', 'Create Store')
@section('content')
<div class="container-fluid d-flex justify-content-center mt-4">
    <div class="col-md-6">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">Create New Store</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('store.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Store Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Store Name" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Save Store</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


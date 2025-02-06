@extends('layouts.app2')

@section('title', 'Category List')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <h4 class="text-center">Category List</h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Store Name</th>
                            <th>category Name</th>
                            <th>Created By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{$category->store->name}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->creator->name}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No Category</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

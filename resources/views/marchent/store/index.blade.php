@extends('layouts.app2')

@section('title', 'Store List')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <h4 class="text-center">Store List</h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Store Name</th>
                            <th>Created By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stores as $store)
                            <tr>
                                <td> {{$store->name}} </td>
                                <td> {{$store->creator->name??''}} </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center">No Store</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

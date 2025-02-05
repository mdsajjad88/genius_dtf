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

                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

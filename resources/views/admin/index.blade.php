@extends('layouts.app2')
@section('title', 'Admin Dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h4 class="text-center">Merchant List</h4>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Merchant Name</th>
                        <th>Merchant Email</th>

                        <th>Merchant Role</th>
                        <th>Shop Name</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($marchents as $marchent)
                        <tr>
                            <td>{{$marchent->name}}</td>
                            <td>{{$marchent->email}}</td>
                            <td>{{$marchent->role}}</td>
                            <td>{{$marchent->shop_name}}</td>
                        </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

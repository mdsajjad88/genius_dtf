@extends('layouts.app2')
@section('content')
<div class="container-fluid">
    <div class="row">
       <h2 class="text-center">Welcome, Dear {{auth()->user()->name}}</h2>

        <!-- Main Content -->

    </div>
</div>
@endsection

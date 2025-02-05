@extends('layouts.app2')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 sidebar">
            <h4>Marchent Dashboard</h4>
            <a href="#" class="tab-link active-tab" data-target="store_list_tab">Store List</a>
            <a href="#" class="tab-link" data-target="create_store_tab">Create Store</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 p-4">
            <div class="d-flex justify-content-between">
                <h3>Welcome, {{ Auth::user()->name }}</h3>
                <div class="dropdown">
                    <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Logout
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout to click here</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <hr>

            <!-- Tab Content -->
            <div class="tab-content">
                <div id="store_list_tab" class="tab-pane active">
                    <h4>📊 Dashboard Overview</h4>
                    <p>This is the main dashboard where you can see statistics and reports.</p>
                </div>

                <div id="create_store_tab" class="tab-pane" style="display: none;">
                    <h4>👤 Profile</h4>
                    <p>Name: {{ Auth::user()->name }}</p>
                    <p>Email: {{ Auth::user()->email }}</p>
                </div>


            </div>

        </div>
    </div>
</div>
@endsection

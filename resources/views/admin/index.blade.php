<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .sidebar {
            height: 100vh;
            background: #343a40;
            color: white;
            padding: 20px;
        }
        .sidebar a {
            display: block;
            padding: 10px;
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #495057;
            border-radius: 5px;
        }
        .active-tab {
            background: #007bff;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 sidebar">
            <h4>Admin Dashboard</h4>
            <a href="#" class="tab-link active-tab" data-target="dashboard-tab">User Manage</a>
            <a href="#" class="tab-link" data-target="profile-tab">Profile</a>
            <a href="#" class="tab-link" data-target="settings-tab">Settings</a>
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
                <div id="dashboard-tab" class="tab-pane active">
                    <h2 class="text-center">Marchent List</h2>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>User Email</th>

                                <th>User Role</th>
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

                <div id="profile-tab" class="tab-pane" style="display: none;">
                    <h4>👤 Profile</h4>
                    <p>Name: {{ Auth::user()->name }}</p>
                    <p>Email: {{ Auth::user()->email }}</p>
                </div>

                <div id="settings-tab" class="tab-pane" style="display: none;">
                    <h4>⚙ Settings</h4>
                    <p>Manage your preferences here.</p>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $(".tab-link").click(function(e) {
            e.preventDefault();

            // Remove active class from all links
            $(".tab-link").removeClass("active-tab");
            $(this).addClass("active-tab");

            // Hide all tabs
            $(".tab-pane").hide();

            // Show the clicked tab
            $("#" + $(this).data("target")).show();
        });
    });
</script>

</body>
</html>

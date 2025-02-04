<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .container {
            margin-top: 80px;
        }
        .btn-toggle {
            width: 48%;
        }
    </style>
</head>
<body class="bg-light">


    <div class="container">
        <div class="row justify-content-center">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

                @if (session('status'))
                <div class="alert alert-info mb-4">
                    {{ session('status') }}
                </div>

                @endif
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header text-center bg-primary text-white">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <!-- Login Form -->
                        <form action="{{ url('login') }}" method="POST">
                            @csrf
                            <input type="hidden" id="userType" name="user_type" value="admin">

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter admin email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Login</button>
                           <a href="{{'register'}}">Registration, If Not registered!</a>

                        </form>

                        <!-- Toggle Buttons -->
                        <div class="text-center mt-3">
                            <button class="btn btn-primary btn-toggle active" id="adminBtn">Login as Admin</button>
                            <button class="btn btn-secondary btn-toggle" id="merchantBtn">Login as Merchant</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#adminBtn').click(function() {
                $('#userType').val('admin');

                $('#adminBtn').addClass('btn-primary active').removeClass('btn-secondary');
                $('#merchantBtn').addClass('btn-secondary').removeClass('btn-primary active');
                $("#email").attr("placeholder", "Use admin email");

            });

            $('#merchantBtn').click(function() {
                $('#userType').val('marchent');
                $('#merchantBtn').addClass('btn-primary active').removeClass('btn-secondary');
                $('#adminBtn').addClass('btn-secondary').removeClass('btn-primary active');
                $("#email").attr("placeholder", "Use merchant email");

            });
        });
    </script>

</body>
</html>

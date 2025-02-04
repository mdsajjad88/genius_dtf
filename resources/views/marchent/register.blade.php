<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Merchant Register</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header text-center">
                        <h3>Merchant Register</h3>
                    </div>
                    <div class="card-body">
                        <form id="registrationForm" action="{{ route('marchent.store') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter your name" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" required>
                            </div>

                            <div class="mb-3">
                                <label for="shop_name" class="form-label">Shop Name</label>
                                <input type="text" class="form-control" id="shop_name" name="shop_name"
                                    placeholder="Enter your shop name" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter your shop password" required>
                            </div>

                            <button type="submit" class="btn btn-danger w-100">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
    $(document).on('submit', 'form#registrationForm', function(e) {
        e.preventDefault(); // Prevent default form submission
        var form = $(this);
        var data = form.serialize(); // Serialize form data
        var url = form.attr('action'); // Get form action URL

        $.ajax({
            method: 'POST',
            url: url,
            dataType: 'json',
            data: data,
            beforeSend: function() {
                form.find('button[type="submit"]').prop('disabled', true); // Disable button
            },
            success: function(response) {
                if (response.success === true) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        $('#registrationForm')[0].reset();
                        window.location.href = '{{ route('login') }}';
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr) {
                let errorMsg = "Something went wrong. Please try again.";

                // Check if validation errors are returned
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    errorMsg = '';
                    // Loop through validation errors and display them
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        errorMsg += value[0] + "\n"; // Combine all error messages
                    });
                }

                Swal.fire({
                    title: 'Validation Error!',
                    text: errorMsg,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });

                form.find('button[type="submit"]').prop('disabled', false); // Re-enable button
            }
        });
    });
});

    </script>

</body>

</html>

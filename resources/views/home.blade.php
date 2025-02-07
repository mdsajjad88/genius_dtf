<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .card-icon {
            font-size: 40px;
            color: #007bff;
            text-align: center;
            padding-top: 10px;
        }

        /* Fade-in effect */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease-in-out forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                    @endguest
                </ul>

            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center mb-4">Choose your product</h2>

        <!-- Category Tabs -->
        <ul class="nav nav-tabs justify-content-center" id="categoryTabs">
            @foreach($categories as $key => $category)
                <li class="nav-item">
                    <a class="nav-link {{ $key == 0 ? 'active' : '' }}" data-category="{{ $category->id }}" href="#">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>

        <!-- Product Display -->
        <div class="row mt-3" id="productContainer">
            <!-- Products will be loaded here via AJAX with fade-in effect -->
        </div>
    </div>

    <script>
        $(document).ready(function(){
    function loadProducts(categoryId) {
        $.ajax({
            url: "{{ route('products.byCategory') }}",
            type: "GET",
            data: { category_id: categoryId },
            success: function(response) {
                $('#productContainer').html(response);

                // Apply fade-in effect to each product card
                $('.product-card').each(function(index) {
                    $(this).delay(100 * index).queue(function(next) {
                        $(this).addClass('fade-in');
                        next();
                    });
                });
            }
        });
    }

    // Load first category products by default
    var firstCategory = $('#categoryTabs .nav-link.active').data('category');
    if (firstCategory) {
        loadProducts(firstCategory);
    }

    // Handle category click event, but EXCLUDE other links
    $('.nav-link[data-category]').click(function(e){
        e.preventDefault();  // Prevent default only for category links
        $('.nav-link').removeClass('active');
        $(this).addClass('active');
        var categoryId = $(this).data('category');
        loadProducts(categoryId);
    });
});

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

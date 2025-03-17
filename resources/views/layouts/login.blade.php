<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Amazon Clone</title>
    <!-- Bootstrap CSS từ CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Font Awesome -->
    <style>
        body {
            background-color: #f3f3f3; /* Màu nền nhẹ */
        }
        .card {
            border: none; /* Bỏ viền cho card */
            border-radius: 8px; /* Bo góc card */
        }
        .btn-primary {
            background-color: #ff9900; /* Màu nền giống Amazon */
            border: none; /* Bỏ viền cho nút */
        }
        .btn-primary:hover {
            background-color: #e68a00; /* Màu hover cho nút */
        }
        .footer {
            text-align: center; 
            margin-top: 20px; 
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>

    <!-- jQuery và Bootstrap JS từ CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

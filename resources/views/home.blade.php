<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery App - Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8fafc;
        }
        .hero {
            background-color: #0d6efd;
            color: white;
            padding: 60px 0;
            text-align: center;
        }
        .stats {
            padding: 40px 0;
        }
        .cta {
            background-color: #e9ecef;
            padding: 40px;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">🚚 DeliveryApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Deliveries</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Drivers</a></li>
                    <li class="nav-item"><a class="btn btn-primary ms-3" href="">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="display-4 fw-bold">Welcome to DeliveryApp</h1>
            <p class="lead">Track your deliveries, manage drivers, and simplify logistics.</p>
            <a href="" class="btn btn-light text-primary fw-bold mt-3">Get Started</a>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats text-center bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2 class="text-primary">1,200+</h2>
                    <p>Successful Deliveries</p>
                </div>
                <div class="col-md-4">
                    <h2 class="text-primary">300+</h2>
                    <p>Registered Drivers</p>
                </div>
                <div class="col-md-4">
                    <h2 class="text-primary">24/7</h2>
                    <p>Real-Time Tracking</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta">
        <h2>Ready to simplify your delivery process?</h2>
        <p class="mb-3">Join now and manage your deliveries with ease!</p>
        <a href="" class="btn btn-primary">Create an Account</a>
    </section>

    <!-- Footer -->
    <footer class="text-center py-4 text-muted">
        &copy; {{ now()->year }} DeliveryApp. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

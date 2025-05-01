<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeliveryApp | Reliable Logistics Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #004466;
            --accent-color: #ffaa00;
            --bg-light: #f4f6f9;
            --text-dark: #1d1f21;
            --text-muted: #6c757d;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
        }
        .top-bar {
            background-color: var(--primary-color);
            color: white;
            font-size: 14px;
            padding: 0.5rem 1rem;
        }
        .top-bar a {
            color: #ffffff;
            text-decoration: none;
            margin-left: 1rem;
            transition: color 0.3s ease;
        }
        .top-bar a:hover {
            color: var(--accent-color);
        }
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
        }
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color);
        }
        .hero {
            background: linear-gradient(to right, #004466, #002b3d);
            color: white;
            padding: 120px 0;
            text-align: center;
        }
        .hero h1 {
            font-size: 3.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .hero p {
            font-size: 1.25rem;
            color: #dee2e6;
        }
        .stats {
            padding: 80px 0;
        }
        .stat-box {
            background-color: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.04);
            transition: transform 0.2s;
        }
        .carousel img {
    max-height: 500px;
    object-fit: cover;
}

        .stat-box:hover {
            transform: translateY(-5px);
        }
        .stat-box h2 {
            font-size: 2.5rem;
            color: var(--primary-color);
        }
        .stat-box p {
            margin-top: 10px;
            color: var(--text-muted);
            font-size: 1rem;
        }
        footer {
            background-color: #ffffff;
            padding: 30px 0;
            text-align: center;
            font-size: 14px;
            color: var(--text-muted);
        }
    </style>
</head>
<body>

    <!-- Top Bar -->
    <div class="top-bar d-flex justify-content-end">
        <div>
            <a href="/about">About</a>
            <a href="/app">Driver Login</a>
            <a href="/cpanel">Admin Login</a>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">🚚 {{ $settings->app_name ?? 'DeliveryApp' }}</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Logistics Made Seamless</h1>
            <p>Monitor deliveries. Manage drivers. Stay efficient — all from one elegant dashboard.</p>
        </div>
    </section>

    <!-- Carousel Section -->
<section class="py-5 bg-white">
    <div class="container-fluid">
        <div id="vehicleCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner rounded-4 shadow-sm">
                <div class="carousel-item active">
                    <img src="{{asset('images/car-1.jpg')}}" class="d-block w-100" alt="Car 1">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('images/car-2.jpg')}}" class="d-block w-100" alt="Truck 1">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('images/car-3.jpg')}}" class="d-block w-100" alt="Van">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('images/car-4.jpg')}}" class="d-block w-100" alt="Van">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('images/car-3.jpg')}}" class="d-block w-100" alt="Van">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#vehicleCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#vehicleCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stat-box text-center">
                        <h2>12,840</h2>
                        <p>Deliveries Completed</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-box text-center">
                        <h2>1,325</h2>
                        <p>Drivers Onboard</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-box text-center">
                        <h2>98.9%</h2>
                        <p>Customer Satisfaction</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        &copy; {{ now()->year }} {{ $settings->app_name ?? 'DeliveryApp' }} — Crafted for efficient logistics.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

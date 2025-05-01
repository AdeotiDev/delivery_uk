<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | {{ $settings->app_name ?? 'DeliveryApp' }}</title>
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
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
        }
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color);
        }
        .about-hero {
            background: linear-gradient(to right, #004466, #002b3d);
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .about-hero h1 {
            font-size: 3rem;
            font-weight: 700;
        }
        .section {
            padding: 60px 0;
        }
        .section h2 {
            color: var(--primary-color);
            margin-bottom: 20px;
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

    <!-- Navbar -->
    <nav class="navbar navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/">🚚 {{ $settings->app_name ?? 'DeliveryApp' }}</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="about-hero">
        <div class="container">
            <h1>About {{ $settings->app_name ?? 'DeliveryApp' }}</h1>
            <p class="lead">Revolutionizing logistics with smart, efficient, and scalable delivery solutions.</p>
        </div>
    </section>
    
    <!-- Contact or Address -->
    <section class="section bg-white">
        <div class="container">
            <h2>Contact Information</h2>
            <ul class="list-unstyled">
                <li><strong>Phone:</strong> {{ $settings->app_phone ?? 'N/A' }}</li>
                <li><strong>Email:</strong> {{ $settings->app_email ?? 'N/A' }}</li>
                <li><strong>Address:</strong> {{ $settings->app_address ?? 'N/A' }}</li>
            </ul>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="section bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="{{ asset('images/about-us.jpg') }}" class="img-fluid rounded-4 shadow-sm" alt="Our Mission">
                </div>
                <div class="col-md-6">
                    <h2>Our Mission</h2>
                    <p class="text-muted">
                        At {{ $settings->app_name ?? 'DeliveryApp' }}, our mission is simple: to provide a smarter and more reliable way to move goods across cities and regions. We believe that logistics shouldn't be a bottleneck — it should be a bridge.
                    </p>
                    <p class="text-muted">
                        Whether you're delivering a package or managing a fleet, we equip you with the technology and tools to streamline operations, save time, and deliver excellence.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="section bg-light">
        <div class="container">
            <h2 class="text-center mb-5">What We Stand For</h2>
            <div class="row text-center">
                <div class="col-md-4">
                    <h4 class="fw-bold text-primary">Innovation</h4>
                    <p class="text-muted">We build cutting-edge tools to make logistics seamless and smart.</p>
                </div>
                <div class="col-md-4">
                    <h4 class="fw-bold text-primary">Reliability</h4>
                    <p class="text-muted">Our system is built to handle real-world delivery needs 24/7.</p>
                </div>
                <div class="col-md-4">
                    <h4 class="fw-bold text-primary">Customer Focus</h4>
                    <p class="text-muted">Every decision we make starts with you — the user — in mind.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="section bg-white text-center">
        <div class="container">
            <h2>Join the Movement</h2>
            <p class="text-muted">Thousands of packages delivered. Hundreds of businesses empowered. One platform.</p>
            <a href="/register" class="btn btn-primary mt-3">Get Started</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        &copy; {{ now()->year }} {{ $settings->app_name ?? 'DeliveryApp' }} — Designed for next-gen logistics.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

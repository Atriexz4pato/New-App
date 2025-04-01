<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard Attachment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
            overflow: hidden;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        .navbar {
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            height: 60px;
        }
        .dashboard-container {
            display: flex;
            flex-grow: 1;
            padding-top: 60px;
            overflow: hidden;
        }
        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding-top: 20px;
            height: 100%;
            overflow-y: auto;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }
        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
            padding: 10px 15px;
        }
        .sidebar .nav-link.active {
            color: #007bff;
            background-color: rgba(0, 123, 255, 0.1);
        }
        .sidebar .nav-link i {
            margin-right: 10px;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: #f1f3f5;
        }
        .dashboard-content {
            max-height: calc(100vh - 120px);
            overflow-y: auto;
        }
        .footer {
            background-color: white;
            color: rgb(8, 1, 1);
            padding: 10px 0;
            text-align: center;
            height: 40px;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: static;
            }
            .dashboard-container {
                flex-direction: column;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <i class="fas fa-graduation-cap me-2"></i>Kisii University
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link active" href="{{route('student.dashboard')}}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <form method="post" action="{{route('logout')}}">
                        @csrf
                        <button type="button" class="nav-link active" style="border: none; background: none; color: inherit;">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Dashboard Container -->
<div class="dashboard-container">
    <!-- Sidebar -->
    <nav class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{route('student.dashboard')}}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('student.my_assessors')}}">
                    <i class="fas fa-book"></i> My Assessors
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('student.assessments')}}">
                    <i class="fas fa-file-alt"></i> Assessments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('upload.documents')}}">
                    <i class="fas fa-chart-bar"></i> Upload Docs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#profile">
                    <i class="fas fa-user-cog"></i> Profile Settings
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    @yield('content')
</div>

<!-- Footer -->
<footer class="footer">
    <div class="container-fluid">
        <p class="mb-0">© 2025 Kisii University. All Rights Reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

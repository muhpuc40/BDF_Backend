<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BDF')</title>
    <link rel="icon" href="/BDF.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { padding-top: 56px; }
        .sidebar { min-height: calc(100vh - 56px); }
        .nav-link { padding: 0.75rem 1rem; color: #333; }
        .nav-link:hover { background-color: #e9ecef; }
        .offcanvas-start { width: 280px; }
        .logout-form { display: inline; }
    </style>
</head>

<body>
    <!-- Fixed Navbar -->
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand ms-2" href="/dashboard">Bangladesh Debate Federation</a>

            <!-- Desktop logout -->
            <form method="POST" action="{{ route('logout') }}" class="logout-form d-none d-lg-block">
                @csrf
                <button type="submit" class="btn btn-outline-light">
                    <i class="fas fa-sign-out-alt me-1"></i>Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Mobile Offcanvas Menu -->
    <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="mobileMenu">
        <div class="offcanvas-header bg-dark text-white">
            <h5 class="offcanvas-title">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0">
            <div class="p-3">
                <h6>EVENT</h6>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="/events/create"><i class="fas fa-plus-circle me-2"></i>Add Event</a></li>
                    <li class="nav-item"><a class="nav-link" href="/events"><i class="fas fa-calendar-alt me-2"></i>View Event</a></li>
                    <li class="nav-item"><a class="nav-link" href="/directory/create"><i class="fas fa-plus-circle me-2"></i>Add Club</a></li>
                    <li class="nav-item"><a class="nav-link" href="/directory"><i class="fas fa-address-book me-2"></i>View Club</a></li>
                </ul>
                <h6 class="mt-4">COMMITTEE</h6>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="/committees/create"><i class="fas fa-user-plus me-2"></i>Add Committee Member</a></li>
                    <li class="nav-item"><a class="nav-link" href="/committees"><i class="fas fa-users me-2"></i>View Committee</a></li>
                    <li class="nav-item"><a class="nav-link" href="/hall/create"><i class="fas fa-user-plus me-2"></i>Add Hall of Fame</a></li>
                    <li class="nav-item"><a class="nav-link" href="/hall"><i class="fas fa-trophy me-2"></i>View Hall of Fame</a></li>
                </ul>
                <h6 class="mt-4">NEWS & ANNOUNCEMENTS</h6>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="/news/create"><i class="fas fa-plus-circle me-2"></i>Add News</a></li>
                    <li class="nav-item"><a class="nav-link" href="/news"><i class="fas fa-newspaper me-2"></i>View News</a></li>
                    <li class="nav-item"><a class="nav-link" href="/announcements/create"><i class="fas fa-bullhorn me-2"></i>Add Announcement</a></li>
                    <li class="nav-item"><a class="nav-link" href="/announcements"><i class="fas fa-exclamation-circle me-2"></i>View Announcements</a></li>
                </ul>
                <h6 class="mt-4">EMAIL MANAGEMENT</h6>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="/emails"><i class="fas fa-inbox me-2"></i>View Contact Emails</a></li>
                </ul>
                <!-- Mobile logout -->
                <div class="mt-4 pt-3 border-top">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-dark w-100">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Desktop Sidebar -->
            <div class="col-lg-3 d-none d-lg-block bg-light sidebar">
                <div class="p-3">
                    <h5>EVENT</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="/events/create"><i class="fas fa-plus-circle me-2"></i>Add Event</a></li>
                        <li class="nav-item"><a class="nav-link" href="/events"><i class="fas fa-calendar-alt me-2"></i>View Event</a></li>
                        <li class="nav-item"><a class="nav-link" href="/directory/create"><i class="fas fa-plus-circle me-2"></i>Add Club</a></li>
                        <li class="nav-item"><a class="nav-link" href="/directory"><i class="fas fa-address-book me-2"></i>View Club</a></li>
                    </ul>
                    <h5 class="mt-4">COMMITTEE</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="/committees/create"><i class="fas fa-user-plus me-2"></i>Add Committee Member</a></li>
                        <li class="nav-item"><a class="nav-link" href="/committees"><i class="fas fa-users me-2"></i>View Committee</a></li>
                        <li class="nav-item"><a class="nav-link" href="/hall/create"><i class="fas fa-user-plus me-2"></i>Add Hall of Fame</a></li>
                        <li class="nav-item"><a class="nav-link" href="/hall"><i class="fas fa-trophy me-2"></i>View Hall of Fame</a></li>
                    </ul>
                    <h5 class="mt-4">NEWS & ANNOUNCEMENTS</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="{{ route('news.create') }}"><i class="fas fa-plus-circle me-2"></i>Add News</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('news.index') }}"><i class="fas fa-newspaper me-2"></i>View News</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('announcements.create') }}"><i class="fas fa-bullhorn me-2"></i>Add Announcement</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('announcements.index') }}"><i class="fas fa-exclamation-circle me-2"></i>View Announcements</a></li>
                    </ul>
                    <h5 class="mt-4">EMAIL MANAGEMENT</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="/emails"><i class="fas fa-inbox me-2"></i>View Contact Emails</a></li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-lg-9 col-12 p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const offcanvas = document.getElementById('mobileMenu');
            if (offcanvas) {
                const offcanvasInstance = new bootstrap.Offcanvas(offcanvas);
                document.querySelectorAll('#mobileMenu .nav-link').forEach(link => {
                    link.addEventListener('click', () => offcanvasInstance.hide());
                });
            }
        });
    </script>
</body>

</html>
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
        body {
            padding-top: 56px;
            font-family: 'Segoe UI', sans-serif;
        }

        /* ── Sidebar ── */
        .sidebar {
            height: calc(100vh - 56px);
            position: sticky;
            top: 56px;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: thin;
            scrollbar-color: #dee2e6 transparent;
        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #dee2e6;
            border-radius: 4px;
        }

        /* ── Section headers (collapsible) ── */
        .sidebar-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            user-select: none;
            padding: 0.5rem 0.25rem;
            border-radius: 6px;
            transition: background 0.15s;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            color: #6c757d;
            margin-top: 1.25rem;
            margin-bottom: 0.15rem;
        }

        .sidebar-section-header:first-child {
            margin-top: 0.25rem;
        }

        .sidebar-section-header:hover {
            background: #e9ecef;
            color: #343a40;
        }

        .sidebar-section-header .chevron {
            font-size: 0.6rem;
            transition: transform 0.25s ease;
            color: #adb5bd;
        }

        .sidebar-section-header.collapsed .chevron {
            transform: rotate(-90deg);
        }

        /* ── Nav links ── */
        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.55rem 0.75rem;
            color: #343a40;
            border-radius: 6px;
            font-size: 0.875rem;
            transition: background 0.15s, color 0.15s, padding-left 0.15s;
            position: relative;
        }

        .sidebar-nav .nav-link:hover {
            background: #e9ecef;
            padding-left: 1rem;
            color: #000;
        }

        .sidebar-nav .nav-link .nav-icon {
            width: 16px;
            text-align: center;
            flex-shrink: 0;
            font-size: 0.8rem;
            color: #868e96;
            transition: color 0.15s;
        }

        .sidebar-nav .nav-link:hover .nav-icon {
            color: #343a40;
        }

        /* ── Section collapse animation ── */
        .sidebar-section-body {
            overflow: hidden;
            transition: max-height 0.3s ease, opacity 0.25s ease;
            max-height: 500px;
            opacity: 1;
        }

        .sidebar-section-body.collapsed {
            max-height: 0;
            opacity: 0;
        }

        /* ── Offcanvas ── */
        .offcanvas-start {
            width: 280px;
        }

        /* ── Navbar ── */
        .logout-form {
            display: inline;
        }
    </style>
</head>

<body>
    <!-- Fixed Navbar -->
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#mobileMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand ms-2" href="/dashboard">Bangladesh Debate Federation</a>

            <!-- Desktop logout -->
            <form method="POST" action="{{ route('logout') }}" class="logout-form d-none d-lg-block">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">
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

                <div class="sidebar-section-header" onclick="toggleSection(this)">
                    <span>EVENT</span><i class="fas fa-chevron-down chevron"></i>
                </div>
                <div class="sidebar-section-body">
                    <ul class="nav flex-column sidebar-nav">
                        <li class="nav-item"><a class="nav-link" href="/events/create"><i
                                    class="nav-icon fas fa-plus-circle"></i>Add Event</a></li>
                        <li class="nav-item"><a class="nav-link" href="/events"><i
                                    class="nav-icon fas fa-calendar-alt"></i>View Events</a></li>
                        <li class="nav-item"><a class="nav-link" href="/directory/create"><i
                                    class="nav-icon fas fa-plus-circle"></i>Add Club</a></li>
                        <li class="nav-item"><a class="nav-link" href="/directory"><i
                                    class="nav-icon fas fa-address-book"></i>View Clubs</a></li>
                    </ul>
                </div>

                <div class="sidebar-section-header" onclick="toggleSection(this)">
                    <span>COMMITTEE</span><i class="fas fa-chevron-down chevron"></i>
                </div>
                <div class="sidebar-section-body">
                    <ul class="nav flex-column sidebar-nav">
                        <li class="nav-item"><a class="nav-link" href="/committees/create"><i
                                    class="nav-icon fas fa-user-plus"></i>Add Member</a></li>
                        <li class="nav-item"><a class="nav-link" href="/committees"><i
                                    class="nav-icon fas fa-users"></i>View Committee</a></li>
                        <li class="nav-item"><a class="nav-link" href="/hall/create"><i
                                    class="nav-icon fas fa-user-plus"></i>Add Hall of Fame</a></li>
                        <li class="nav-item"><a class="nav-link" href="/hall"><i class="nav-icon fas fa-trophy"></i>View
                                Hall of Fame</a></li>
                    </ul>
                </div>

                <div class="sidebar-section-header" onclick="toggleSection(this)">
                    <span>NEWS</span><i class="fas fa-chevron-down chevron"></i>
                </div>
                <div class="sidebar-section-body">
                    <ul class="nav flex-column sidebar-nav">
                        <li class="nav-item"><a class="nav-link" href="/news/create"><i
                                    class="nav-icon fas fa-plus-circle"></i>Add News</a></li>
                        <li class="nav-item"><a class="nav-link" href="/news"><i
                                    class="nav-icon fas fa-newspaper"></i>View News</a></li>
                    </ul>
                </div>



                <div class="sidebar-section-header" onclick="toggleSection(this)">
                    <span>ANNOUNCEMENTS</span><i class="fas fa-chevron-down chevron"></i>
                </div>
                <div class="sidebar-section-body">
                    <ul class="nav flex-column sidebar-nav">
                        <li class="nav-item"><a class="nav-link" href="/announcements/create"><i
                                    class="nav-icon fas fa-bullhorn"></i>Add Announcement</a></li>
                        <li class="nav-item"><a class="nav-link" href="/announcements"><i
                                    class="nav-icon fas fa-exclamation-circle"></i>View Announcements</a></li>
                    </ul>
                </div>

                <div class="sidebar-section-header" onclick="toggleSection(this)">
                    <span>ADVISORS Panel</span><i class="fas fa-chevron-down chevron"></i>
                </div>
                <div class="sidebar-section-body">
                    <ul class="nav flex-column sidebar-nav">
                        <li class="nav-item"><a class="nav-link" href="/advisors/create"><i
                                    class="nav-icon fas fa-user-plus"></i>Add Advisor</a></li>
                        <li class="nav-item"><a class="nav-link" href="/advisors"><i
                                    class="nav-icon fas fa-users"></i>View Advisors</a></li>
                    </ul>
                </div>


                <div class="sidebar-section-header" onclick="toggleSection(this)">
                    <span>PRESIDIUM Member</span><i class="fas fa-chevron-down chevron"></i>
                </div>
                <div class="sidebar-section-body">
                    <ul class="nav flex-column sidebar-nav">
                        <li class="nav-item"><a class="nav-link" href="/presidium/create"><i
                                    class="nav-icon fas fa-user-plus"></i>Add Presidium Member</a></li>
                        <li class="nav-item"><a class="nav-link" href="/presidium"><i
                                    class="nav-icon fas fa-users"></i>View Presidium Members</a></li>
                    </ul>
                </div>

                <div class="sidebar-section-header" onclick="toggleSection(this)">
                    <span>New Member</span><i class="fas fa-chevron-down chevron"></i>
                </div>
                <div class="sidebar-section-body">
                    <ul class="nav flex-column sidebar-nav">
                        <li class="nav-item"><a class="nav-link" href="/users"><i
                                    class="nav-icon fas fa-user-plus"></i>View New Member</a></li>
                    </ul>

                </div>

                <div class="sidebar-section-header" onclick="toggleSection(this)">
                    <span>EMAIL</span><i class="fas fa-chevron-down chevron"></i>
                </div>
                <div class="sidebar-section-body">
                    <ul class="nav flex-column sidebar-nav">
                        <li class="nav-item"><a class="nav-link" href="/emails"><i
                                    class="nav-icon fas fa-inbox"></i>View Contact Emails</a></li>
                    </ul>
                </div>

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
            <div class="col-lg-2 d-none d-lg-block bg-light sidebar">
                <div class="p-3">

                    <div class="sidebar-section-header" onclick="toggleSection(this)">
                        <span>EVENT</span><i class="fas fa-chevron-down chevron"></i>
                    </div>
                    <div class="sidebar-section-body">
                        <ul class="nav flex-column sidebar-nav">
                            <li class="nav-item"><a class="nav-link" href="/events/create"><i
                                        class="nav-icon fas fa-plus-circle"></i>Add Event</a></li>
                            <li class="nav-item"><a class="nav-link" href="/events"><i
                                        class="nav-icon fas fa-calendar-alt"></i>View Events</a></li>
                            <li class="nav-item"><a class="nav-link" href="/directory/create"><i
                                        class="nav-icon fas fa-plus-circle"></i>Add Club</a></li>
                            <li class="nav-item"><a class="nav-link" href="/directory"><i
                                        class="nav-icon fas fa-address-book"></i>View Clubs</a></li>
                        </ul>
                    </div>



                    <div class="sidebar-section-header" onclick="toggleSection(this)">
                        <span>COMMITTEE</span><i class="fas fa-chevron-down chevron"></i>
                    </div>
                    <div class="sidebar-section-body">
                        <ul class="nav flex-column sidebar-nav">
                            <li class="nav-item"><a class="nav-link" href="/committees/create"><i
                                        class="nav-icon fas fa-user-plus"></i>Add Member</a></li>
                            <li class="nav-item"><a class="nav-link" href="/committees"><i
                                        class="nav-icon fas fa-users"></i>View Committee</a></li>
                            <li class="nav-item"><a class="nav-link" href="/hall/create"><i
                                        class="nav-icon fas fa-user-plus"></i>Add Hall of Fame</a></li>
                            <li class="nav-item"><a class="nav-link" href="/hall"><i
                                        class="nav-icon fas fa-trophy"></i>View Hall of Fame</a></li>
                        </ul>
                    </div>



                    <div class="sidebar-section-header" onclick="toggleSection(this)">
                        <span>NEWS</span><i class="fas fa-chevron-down chevron"></i>
                    </div>
                    <div class="sidebar-section-body">
                        <ul class="nav flex-column sidebar-nav">
                            <li class="nav-item"><a class="nav-link" href="{{ route('news.create') }}"><i
                                        class="nav-icon fas fa-plus-circle"></i>Add News</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('news.index') }}"><i
                                        class="nav-icon fas fa-newspaper"></i>View News</a></li>
                        </ul>
                    </div>



                    <div class="sidebar-section-header" onclick="toggleSection(this)">
                        <span>ANNOUNCEMENTS</span><i class="fas fa-chevron-down chevron"></i>
                    </div>
                    <div class="sidebar-section-body">
                        <ul class="nav flex-column sidebar-nav">
                            <li class="nav-item"><a class="nav-link" href="{{ route('announcements.create') }}"><i
                                        class="nav-icon fas fa-bullhorn"></i>Add Announcement</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('announcements.index') }}"><i
                                        class="nav-icon fas fa-exclamation-circle"></i>View Announcements</a></li>
                        </ul>
                    </div>

                    <div class="sidebar-section-header" onclick="toggleSection(this)">
                        <span>ADVISORS Panel</span><i class="fas fa-chevron-down chevron"></i>
                    </div>
                    <div class="sidebar-section-body">
                        <ul class="nav flex-column sidebar-nav">
                            <li class="nav-item"><a class="nav-link" href="/advisors/create"><i
                                        class="nav-icon fas fa-user-plus"></i>Add Advisor</a></li>
                            <li class="nav-item"><a class="nav-link" href="/advisors"><i
                                        class="nav-icon fas fa-users"></i>View Advisors</a></li>
                        </ul>
                    </div>

                    <div class="sidebar-section-header" onclick="toggleSection(this)">
                        <span>PRESIDIUM Member</span><i class="fas fa-chevron-down chevron"></i>
                    </div>
                    <div class="sidebar-section-body">
                        <ul class="nav flex-column sidebar-nav">
                            <li class="nav-item"><a class="nav-link" href="/presidium/create"><i
                                        class="nav-icon fas fa-user-plus"></i>Add Presidium Member</a></li>
                            <li class="nav-item"><a class="nav-link" href="/presidium"><i
                                        class="nav-icon fas fa-users"></i>View Presidium Members</a></li>
                        </ul>
                    </div>

                    <div class="sidebar-section-header" onclick="toggleSection(this)">
                        <span>New Member</span><i class="fas fa-chevron-down chevron"></i>
                    </div>
                    <div class="sidebar-section-body">
                        <ul class="nav flex-column sidebar-nav">
                            <li class="nav-item"><a class="nav-link" href="/users"><i
                                        class="nav-icon fas fa-user-plus"></i>View New Member</a></li>
                        </ul>
                    </div>





                    <div class="sidebar-section-header" onclick="toggleSection(this)">
                        <span>EMAIL</span><i class="fas fa-chevron-down chevron"></i>
                    </div>
                    <div class="sidebar-section-body">
                        <ul class="nav flex-column sidebar-nav">
                            <li class="nav-item"><a class="nav-link" href="/emails"><i
                                        class="nav-icon fas fa-inbox"></i>View Contact Emails</a></li>
                        </ul>
                    </div>

                </div>
            </div>

            <!-- Main Content -->
            <main class="col-lg-10 col-12 p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ── Collapsible sidebar sections ──
        function toggleSection(header) {
            const body = header.nextElementSibling;
            const isCollapsed = body.classList.contains('collapsed');
            body.classList.toggle('collapsed', !isCollapsed);
            header.classList.toggle('collapsed', !isCollapsed);

            // Persist state
            const key = 'sidebar_' + header.querySelector('span').textContent.trim();
            localStorage.setItem(key, isCollapsed ? 'open' : 'closed');
        }

        // Restore saved states on page load
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.sidebar-section-header').forEach(header => {
                const key = 'sidebar_' + header.querySelector('span').textContent.trim();
                const state = localStorage.getItem(key);
                if (state === 'closed') {
                    header.classList.add('collapsed');
                    header.nextElementSibling.classList.add('collapsed');
                }
            });

            // Mobile offcanvas: close on nav link click
            const offcanvas = document.getElementById('mobileMenu');
            if (offcanvas) {
                const offcanvasInstance = new bootstrap.Offcanvas(offcanvas);
                offcanvas.querySelectorAll('.nav-link').forEach(link => {
                    link.addEventListener('click', () => offcanvasInstance.hide());
                });
            }
        });
    </script>
</body>

</html>
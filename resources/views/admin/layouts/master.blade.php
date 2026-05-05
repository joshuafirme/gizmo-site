<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Gizmo System Solutions Inc.</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <style>
        :root {
            --primary-tech: #3080C4;
            --bg-main: #0a0e17;
            --bg-sidebar: #111827;
            --bg-card: #1f2937;
            --text-main: #f8f9fa;
            --text-muted: #9ca3af;
            --border-color: rgba(255, 255, 255, 0.05);
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-main);
            font-family: 'Segoe UI', sans-serif;
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        @yield('content')
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>

     @stack('script')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const currentUrl = window.location.href;
            const links = document.querySelectorAll('.sidebar-nav a');

            links.forEach(link => {
                if (link.href === currentUrl) {
                    const parentLi = link.parentElement;
                    parentLi.classList.add('active');

                    // If it's inside a submenu, open the submenu automatically
                    const collapseParent = link.closest('.collapse');
                    if (collapseParent) {
                        collapseParent.classList.add('show');
                        // Highlight the main parent dropdown as well
                        collapseParent.parentElement.classList.add('active');
                    }
                }
            });
        });
    </script>
</body>

</html>

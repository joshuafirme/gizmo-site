<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-tech: #0d6efd;
            /* Adjust if your theme uses a different primary hex */
            --bg-main: #121416;
            --bg-card: #1a1d21;
            --border-color: rgba(255, 255, 255, 0.1);
        }

        body {
            background-color: var(--bg-main);
            color: #fff;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: system-ui, -apple-system, sans-serif;
            background-image: radial-gradient(circle at 50% -20%, #2b3035 0%, #121416 60%);
        }

        .login-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
            padding: 2.5rem;
            animation: slideUp 0.5s ease-out;
        }

        .btn-tech {
            background-color: var(--primary-tech);
            color: #fff;
            font-weight: 500;
            padding: 0.6rem 1rem;
            transition: all 0.3s ease;
        }

        .btn-tech:hover {
            background-color: #0b5ed7;
            color: #fff;
            transform: translateY(-1px);
        }

        .form-control {
            background-color: #212529;
            border-color: #343a40;
            color: #fff;
            padding: 0.6rem 1rem;
        }

        .form-control:focus {
            background-color: #2b3035;
            border-color: var(--primary-tech);
            color: #fff;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .input-group-text {
            background-color: #212529;
            border-color: #343a40;
            color: #6c757d;
        }

        @keyframes slideUp {
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

    <div class="login-card">
        <div class="text-center mb-4">
            <div class="d-inline-block bg-dark p-3 rounded-circle border border-secondary mb-3">
                <i class="fa-solid fa-microchip fa-2x text-primary"></i>
            </div>
            <h4 class="fw-bold mb-1">Admin Portal</h4>
            <p class="text-muted small">Sign in to manage Gizmo Systems</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger bg-danger text-white border-0 py-2 small rounded">
                <i class="fa-solid fa-triangle-exclamation me-2"></i> Invalid credentials. Please try again.
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label small text-muted">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required
                        autofocus placeholder="admin@gizmosystems.com">
                </div>
            </div>

            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="form-label small text-muted mb-0">Password</label>
                </div>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" class="form-control" required placeholder="••••••••">
                </div>
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label small text-muted" for="remember">Remember me on this device</label>
            </div>

            <button type="submit" class="btn btn-tech w-100 rounded-pill mb-3">
                Secure Login <i class="fa-solid fa-arrow-right-to-bracket ms-2"></i>
            </button>
        </form>

        <div class="text-center mt-3">
            <span class="text-muted" style="font-size: 0.75rem;">&copy; {{ date('Y') }} Gizmo Systems. All rights
                reserved.</span>
        </div>
    </div>

</body>

</html>

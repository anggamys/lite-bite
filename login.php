<?php
session_start();
include 'config/koneksi.php';

if (isset($_SESSION['login_error'])) {
    $error = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lite Bite | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <style>
        :root {
            --litebite-primary: #2B321B;
            --litebite-accent: #CCD5AE;
            --litebite-font: 'Cooper Black', cursive;
        }

        body {
            background-color: #f9f8f4;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--litebite-primary);
        }

        .login-container {
            max-width: 400px;
            margin: 80px auto;
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .login-title {
            font-family: var(--litebite-font);
            color: var(--litebite-primary);
            text-align: center;
            margin-bottom: 30px;
        }

        .btn-login {
            background-color: var(--litebite-primary);
            color: white;
            border-radius: 50px;
            padding: 10px 30px;
            transition: background-color 0.3s ease;
        }

        .btn-login:hover {
            background-color: #6B774C;
        }

        .form-control:focus {
            border-color: var(--litebite-accent);
            box-shadow: 0 0 0 0.2rem rgba(204, 213, 174, 0.5);
        }

        .login-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .login-footer a {
            color: var(--litebite-primary);
            text-decoration: none;
            font-weight: bold;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php include 'components/navbar.php'; ?>

    <div class="login-container">
        <h2 class="login-title">Welcome Back</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="logic/auth/login_process.php">
            <div class="mb-3">
                <label for="username" class="form-label">Email or Username</label>
                <input type="text" class="form-control" id="username" name="username" required />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required />
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-login">Login</button>
            </div>
        </form>
        <div class="login-footer mt-4">
            Don't have an account? <a href="register.php">Sign up</a>
        </div>
    </div>
</body>

</html>
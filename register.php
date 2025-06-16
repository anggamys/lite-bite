<?php
session_start();
include 'config/koneksi.php';

if (isset($_SESSION['register_error'])) {
    $error = $_SESSION['register_error'];
    unset($_SESSION['register_error']);
}

if (isset($_SESSION['register_success'])) {
    $success = $_SESSION['register_success'];
    unset($_SESSION['register_success']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lite Bite | Sign Up</title>
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

        .register-container {
            max-width: 450px;
            margin: 80px auto;
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .register-title {
            font-family: var(--litebite-font);
            color: var(--litebite-primary);
            text-align: center;
            margin-bottom: 30px;
        }

        .btn-register {
            background-color: var(--litebite-primary);
            color: white;
            border-radius: 50px;
            padding: 10px 30px;
            transition: background-color 0.3s ease;
        }

        .btn-register:hover {
            background-color: #6B774C;
        }

        .form-control:focus {
            border-color: var(--litebite-accent);
            box-shadow: 0 0 0 0.2rem rgba(204, 213, 174, 0.5);
        }

        .register-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .register-footer a {
            color: var(--litebite-primary);
            text-decoration: none;
            font-weight: bold;
        }

        .register-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php include 'components/navbar.php'; ?>

    <div class="register-container">
        <h2 class="register-title">Create Your Account</h2>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST" action="logic/auth/register_process.php">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required />
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" required />
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Create Password</label>
                <input type="password" class="form-control" id="password" name="password" required minlength="6" />
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-register">Sign Up</button>
            </div>
        </form>

        <div class="register-footer mt-4">
            Already have an account? <a href="login.php">Login</a>
        </div>
    </div>
</body>

</html>
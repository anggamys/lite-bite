<?php
session_start();
include_once __DIR__ . '/../config/koneksi.php'; // adjust path if needed

$user = $_SESSION['user'] ?? null;
$cartCount = 0;

// If user is logged in, count cart items from DB
if ($user) {
    $stmt = $mysqli->prepare("SELECT SUM(quantity) AS total FROM cart WHERE user_id = ?");
    $stmt->bind_param("i", $user['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $cartCount = (int) ($row['total'] ?? 0);
    $stmt->close();
}
?>

<nav class="navbar navbar-expand-lg px-3">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="index">
            <img src="assets/images/logo-1.png" alt="Logo" width="50" height="50" class="me-2">
            Lite Bite
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarContent">
            <!-- Navigation Menu -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 nav-pills">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="menu.php">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="location.php">Location</a></li>
            </ul>

            <!-- Right Side: Cart & Auth -->
            <div class="d-flex align-items-center ms-lg-3 mt-3 mt-lg-0 gap-3">
                <!-- Cart Icon -->
                <a href="cart.php" class="btn btn-outline-secondary position-relative rounded-pill px-3">
                    <i class="bi bi-cart-fill"></i>
                    <?php if ($cartCount > 0): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?= $cartCount ?>
                        </span>
                    <?php endif; ?>
                </a>

                <!-- User Dropdown or Login Button -->
                <?php if ($user): ?>
                    <div class="dropdown">
                        <button class="btn btn-outline-success dropdown-toggle rounded-pill px-4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= htmlspecialchars($user['username']) ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php if ($user['role'] === 'admin'): ?>
                                <li><a class="dropdown-item" href="admins/dashboard.php">Admin Dashboard</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="users/dashboard.php">Dashboard</a></li>
                            <?php endif; ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="logic/auth/logout.php">Logout</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline-success rounded-pill px-4">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<?php
// Ensure page title is always set
$pageTitle = $pageTitle ?? 'Dashboard';
?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">
    <div class="container-fluid d-flex justify-content-between align-items-center">

        <!-- Left: Sidebar Toggle and Page Title -->
        <div class="d-flex align-items-center">
            <!-- Sidebar Toggle Button -->
            <button class="btn btn-link nav-link text-dark" data-widget="pushmenu" role="button">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Page Title -->
            <span class="ml-2 h5 mb-0 font-weight-bold"><?= htmlspecialchars($pageTitle) ?></span>
        </div>

        <!-- Right: Logout -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="../logic/auth/logout.php" class="nav-link text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
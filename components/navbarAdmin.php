<?php
// Set a default title if not provided
$pageTitle = $pageTitle ?? 'Dashboard';
?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <div class="container-fluid">
        <!-- Dynamic Page Title -->
        <span class="navbar-brand mb-0 h4 font-weight-bold"><?= htmlspecialchars($pageTitle) ?></span>

        <!-- Right Side Menu -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="../logic/auth/logout.php" class="nav-link text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
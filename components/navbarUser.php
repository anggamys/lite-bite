<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../index.php">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i> <?= htmlspecialchars($_SESSION['user']['username']) ?>
                <i class="fas fa-angle-down ml-1"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="profile.php" class="dropdown-item"><i class="fas fa-user-cog mr-2"></i> Profile</a>
                <div class="dropdown-divider"></div>
                <a href="../logic/auth/logout.php" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
            </div>
        </li>
    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
        <span class="brand-text font-weight-light ml-2">Lite Bite User</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'dashboard.php' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="menu.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'menu.php' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-utensils"></i>
                        <p>Browse Menu</p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="my_orders.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'my_orders.php' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-receipt"></i>
                        <p>My Orders</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="profile.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'profile.php' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Account Settings</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
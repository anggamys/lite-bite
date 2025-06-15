<?php
$current_page = basename($_SERVER['PHP_SELF']); // e.g. manage_products.php
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light ml-2">Lite Bite Admin</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link <?= $current_page === 'dashboard.php' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="manage_products.php" class="nav-link <?= $current_page === 'manage_products.php' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-hamburger"></i>
                        <p>Manage Products</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin_orders.php" class="nav-link <?= $current_page === 'admin_orders.php' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Manage Orders</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="manage_users.php" class="nav-link <?= $current_page === 'manage_users.php' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Manage Users</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<?php
session_start();
include '../config/koneksi.php';

// Role protection
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

// Dashboard metrics
$totalProducts = $mysqli->query("SELECT COUNT(*) as count FROM menu_items")->fetch_assoc()['count'];
$totalUsers = $mysqli->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
$totalOrders = $mysqli->query("SELECT COUNT(*) as count FROM orders")->fetch_assoc()['count'];

$pageTitle = 'Admin Dashboard';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $pageTitle ?></title>

    <!-- AdminLTE & Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar & Sidebar -->
        <?php include '../components/navbarAdmin.php'; ?>
        <?php include '../components/aside.php'; ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper p-4">
            <section class="content">
                <div class="container-fluid">

                    <!-- Welcome Message -->
                    <div class="alert alert-success shadow-sm">
                        <h4><i class="fas fa-user-shield mr-2"></i>Welcome, Admin!</h4>
                        <p>You are in the <strong>Lite Bite</strong> management panel. Monitor and manage with ease.</p>
                    </div>

                    <!-- Dashboard Stats -->
                    <div class="row">

                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="info-box bg-primary">
                                <span class="info-box-icon"><i class="fas fa-chart-line"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Orders</span>
                                    <span class="info-box-number"><?= $totalOrders ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="info-box bg-info">
                                <span class="info-box-icon"><i class="fas fa-hamburger"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Products</span>
                                    <span class="info-box-number"><?= $totalProducts ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="info-box bg-warning">
                                <span class="info-box-icon"><i class="fas fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Registered Users</span>
                                    <span class="info-box-number"><?= $totalUsers ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Tips or Upcoming Features -->
                    <div class="card mt-4 shadow-sm">
                        <div class="card-header bg-light">
                            <h3 class="card-title"><i class="fas fa-info-circle mr-1"></i> Quick Admin Tips</h3>
                        </div>
                        <div class="card-body">
                            <ul class="mb-0">
                                <li>Use <strong>Manage Products</strong> to add or edit menu items.</li>
                                <li>Check <strong>Orders</strong> regularly for incoming requests.</li>
                                <li>Review <strong>Users</strong> to monitor customer activity.</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer text-center small">
            <strong>&copy; <?= date('Y') ?> Lite Bite</strong> — All rights reserved.
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>
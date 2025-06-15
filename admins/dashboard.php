<?php
session_start();
include '../config/koneksi.php';

// Optional: Check for admin role
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

// Sample data (you can replace this with real queries)
$totalProducts = $mysqli->query("SELECT COUNT(*) as count FROM menu_items")->fetch_assoc()['count'];
$totalUsers = $mysqli->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
$categories = $mysqli->query("SELECT COUNT(DISTINCT category) as count FROM menu_items")->fetch_assoc()['count'];

$pageTitle = 'Admin Dashboard';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include '../components/navbarAdmin.php'; ?>

        <!-- Sidebar -->
        <?php include '../components/aside.php'; ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper p-4">

            <!-- Main Content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Welcome Message -->
                    <div class="alert alert-success shadow-sm">
                        <h4><i class="fas fa-user-shield mr-2"></i>Welcome, Admin!</h4>
                        <p>You are now in the <strong>Lite Bite</strong> management dashboard.</p>
                    </div>

                    <!-- Info Boxes -->
                    <div class="row">
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
                            <div class="info-box bg-success">
                                <span class="info-box-icon"><i class="fas fa-tags"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Categories</span>
                                    <span class="info-box-number"><?= $categories ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="info-box bg-warning">
                                <span class="info-box-icon"><i class="fas fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Users</span>
                                    <span class="info-box-number"><?= $totalUsers ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Placeholder for more panels -->
                    <div class="card mt-4 shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">Quick Tips</h3>
                        </div>
                        <div class="card-body">
                            <ul>
                                <li>Use <strong>Manage Products</strong> to edit or delete items.</li>
                                <li>Navigate to <strong>Orders</strong> to track customer purchases.</li>
                                <li>Keep content and categories fresh and up-to-date.</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer text-center">
            <strong>&copy; <?= date('Y') ?> Lite Bite.</strong> All rights reserved.
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>
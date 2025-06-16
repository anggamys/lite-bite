<?php
session_start();
include 'config/koneksi.php';

// Redirect if not logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard | Lite Bite</title>

    <!-- AdminLTE & Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />

    <style>
        .brand-link {
            background-color: #2B321B;
            color: #fff;
            font-weight: bold;
        }

        .content-header h1 {
            font-family: 'Cooper Black', cursive;
            color: #2B321B;
        }

        .info-box-icon {
            background-color: #CCD5AE !important;
            color: #2B321B !important;
        }

        .info-box-content span {
            font-weight: 600;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include '../components/navbarUser.php'; ?>

        <!-- Sidebar -->
        <?php include '../components/asideUser.php'; ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content-header px-4 py-2">
                <div class="container-fluid">
                    <h1 class="m-0">Welcome, <?= htmlspecialchars($user['username']) ?> 👋</h1>
                    <p class="text-muted">Manage your orders and explore delicious meals.</p>
                </div>
            </div>

            <section class="content px-4">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Browse Menu -->
                        <!-- <div class="col-md-6">
                            <div class="info-box shadow-sm">
                                <span class="info-box-icon"><i class="fas fa-utensils"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Browse Menu</span>
                                    <a href="menu.php" class="btn btn-sm btn-outline-success mt-2">Explore</a>
                                </div>
                            </div>
                        </div> -->

                        <!-- My Orders -->
                        <div class="col-md-6">
                            <div class="info-box shadow-sm">
                                <span class="info-box-icon"><i class="fas fa-receipt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">My Orders</span>
                                    <a href="my_orders.php" class="btn btn-sm btn-outline-primary mt-2">View Orders</a>
                                </div>
                            </div>
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
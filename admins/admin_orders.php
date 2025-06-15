<?php
session_start();
include '../config/koneksi.php';

// Ensure only admin can access
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

// Fetch order data
$orders = $mysqli->query("
    SELECT o.*, m.name AS product_name 
    FROM orders o 
    JOIN menu_items m ON o.product_id = m.id 
    ORDER BY o.created_at DESC
");

$pageTitle = "Manage Orders";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $pageTitle ?> | Admin</title>

    <!-- AdminLTE + Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar & Sidebar -->
        <?php include '../components/navbarAdmin.php'; ?>
        <?php include '../components/aside.php'; ?>

        <!-- Main Content -->
        <div class="content-wrapper p-4">
            <section class="content-header d-flex justify-content-between align-items-center mb-3">
                <!-- <h1 class="mb-0"><?= $pageTitle ?></h1> -->
            </section>

            <section class="content">
                <div class="card card-outline card-primary">
                    <div class="card-body table-responsive p-0">
                        <?php if ($orders->num_rows > 0): ?>
                            <table class="table table-hover text-nowrap table-striped table-bordered mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="width: 50px;">#</th>
                                        <th>Product</th>
                                        <th>Customer</th>
                                        <th>Phone</th>
                                        <th>Quantity</th>
                                        <th>Notes</th>
                                        <th>Ordered At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($order = $orders->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= $order['id'] ?></td>
                                            <td><?= htmlspecialchars($order['product_name']) ?></td>
                                            <td><?= htmlspecialchars($order['customer_name']) ?></td>
                                            <td><?= htmlspecialchars($order['phone']) ?></td>
                                            <td><?= $order['quantity'] ?></td>
                                            <td><?= $order['notes'] ? nl2br(htmlspecialchars($order['notes'])) : '<em class="text-muted">-</em>' ?></td>
                                            <td><?= date('d M Y, H:i', strtotime($order['created_at'])) ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="alert alert-info m-0 p-4">No orders have been placed yet.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer text-sm text-center">
            <strong>&copy; <?= date('Y') ?> Lite Bite</strong> — Admin Panel
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>
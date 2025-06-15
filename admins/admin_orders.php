<?php
session_start();
include '../config/koneksi.php';

// Optional: Admin access check
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

// Fetch orders with product info
$orders = $mysqli->query("
    SELECT o.*, m.name AS product_name 
    FROM orders o 
    JOIN menu_items m ON o.product_id = m.id 
    ORDER BY o.created_at DESC
");

$pageTitle = "View Orders";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin - View Orders | Lite Bite</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar & Sidebar -->
        <?php include '../components/navbarAdmin.php'; ?>
        <?php include '../components/aside.php'; ?>

        <div class="content-wrapper p-4">

            <section class="content">
                <div class="container-fluid">
                    <?php if ($orders->num_rows > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
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
                                            <td><?= nl2br(htmlspecialchars($order['notes'])) ?></td>
                                            <td><?= date('d M Y, H:i', strtotime($order['created_at'])) ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">No orders found.</div>
                    <?php endif; ?>
                </div>
            </section>
        </div>

        <footer class="main-footer text-center">
            <strong>&copy; <?= date('Y') ?> Lite Bite</strong> — Admin Panel
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>
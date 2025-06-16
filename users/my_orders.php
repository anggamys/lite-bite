<?php
session_start();
include '../config/koneksi.php';

// Ensure user is logged in
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}

$userName = $_SESSION['user']['name'];

// Fetch user's orders
$stmt = $mysqli->prepare("
    SELECT o.*, m.name AS product_name, m.image_url 
    FROM orders o 
    JOIN menu_items m ON o.product_id = m.id 
    WHERE o.customer_name = ?
    ORDER BY o.created_at DESC
");
$stmt->bind_param("s", $userName);
$stmt->execute();
$orders = $stmt->get_result();
$stmt->close();

$pageTitle = "My Orders";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title><?= $pageTitle ?> | Lite Bite</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- AdminLTE + Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include '../components/navbarUser.php'; ?>

        <!-- Sidebar -->
        <?php include '../components/asideUser.php'; ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper p-4">
            <div class="container-fluid">
                <h3 class="mb-4"><?= $pageTitle ?></h3>

                <?php if ($orders->num_rows > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Notes</th>
                                    <th>Ordered At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($order = $orders->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $order['id'] ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="../<?= htmlspecialchars($order['image_url']) ?>" alt="Product" width="50" class="mr-2">
                                                <?= htmlspecialchars($order['product_name']) ?>
                                            </div>
                                        </td>
                                        <td><?= $order['quantity'] ?></td>
                                        <td><?= nl2br(htmlspecialchars($order['notes'])) ?></td>
                                        <td><?= date('d M Y, H:i', strtotime($order['created_at'])) ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info text-center">You haven't placed any orders yet.</div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Footer -->
        <footer class="main-footer text-center">
            <strong>&copy; <?= date('Y') ?> Lite Bite</strong> — All rights reserved.
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>
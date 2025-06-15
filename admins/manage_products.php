<?php
session_start();
include '../config/koneksi.php';

// Optional: Check for admin role
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

// Fetch all menu items
$items = $mysqli->query("SELECT * FROM menu_items ORDER BY id DESC");

$pageTitle = 'Manage Products';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Products</title>

    <!-- AdminLTE + Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include '../components/navbarAdmin.php'; ?>

        <!-- Sidebar -->
        <?php include '../components/aside.php'; ?>

        <!-- Main Content -->
        <div class="content-wrapper p-4">
            <div class="content-header d-flex justify-content-between align-items-center mb-3">
                <a href="add_product.php" class="btn btn-success">
                    <i class="fas fa-plus-circle"></i> Add New Product
                </a>
            </div>

            <div class="content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="productsTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Nutrition</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($item = $items->fetch_assoc()): ?>
                                <tr id="row-<?= $item['id'] ?>">
                                    <td><?= $item['id'] ?></td>
                                    <td><?= htmlspecialchars($item['name']) ?></td>
                                    <td><?= ucfirst($item['category']) ?></td>
                                    <td>
                                        <small>Carb: <?= $item['carb'] ?>g | Protein: <?= $item['protein'] ?>g<br>Fat: <?= $item['fat'] ?>g | Calories: <?= $item['calories'] ?></small>
                                    </td>
                                    <td>
                                        <?php if ($item['image_url']): ?>
                                            <img src="../<?= $item['image_url'] ?>" alt="" width="50">
                                        <?php else: ?>
                                            <em>No image</em>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="add_edit_product.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" onclick="deleteProduct(<?= $item['id'] ?>)" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
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

    <script>
        function deleteProduct(id) {
            if (!confirm("Are you sure you want to delete this product?")) return;

            fetch('../logic/product/delete_product.php', {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: 'id=' + id
                })
                .then(res => res.json())
                .then(data => {
                    alert(data.message);
                    if (data.status === 'success') {
                        document.getElementById('row-' + id).remove();
                    }
                })
                .catch(err => {
                    alert('Error occurred while deleting.');
                });
        }
    </script>
</body>

</html>
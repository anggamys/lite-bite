<?php
session_start();
include '../config/koneksi.php';

// Secure: Only allow admin access
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$pageTitle = 'Manage Products';
$items = $mysqli->query("SELECT * FROM menu_items ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $pageTitle ?> | Admin</title>

    <!-- AdminLTE -->
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

        <!-- Main Content -->
        <div class="content-wrapper p-4">
            <!-- Header -->
            <section class="content-header d-flex justify-content-between align-items-center mb-3">
                <h1></h1>
                <a href="add_edit_product.php" class="btn btn-success">
                    <i class="fas fa-plus-circle mr-1"></i> Add Product
                </a>
            </section>

            <!-- Product Table -->
            <section class="content">
                <div class="card card-outline card-success">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-striped table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width: 50px;">#</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Nutritional Info</th>
                                    <th>Image</th>
                                    <th style="width: 120px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($items->num_rows > 0): ?>
                                    <?php $no = 1;
                                    while ($item = $items->fetch_assoc()): ?>
                                        <tr id="row-<?= $item['id'] ?>">
                                            <td><?= $no++ ?></td>
                                            <td><?= htmlspecialchars($item['name']) ?></td>
                                            <td><?= ucfirst($item['category']) ?></td>
                                            <td>
                                                <small>
                                                    Carb: <?= $item['carb'] ?>g<br>
                                                    Protein: <?= $item['protein'] ?>g<br>
                                                    Fat: <?= $item['fat'] ?>g<br>
                                                    Calories: <?= $item['calories'] ?>
                                                </small>
                                            </td>
                                            <td>
                                                <?php if (!empty($item['image_url'])): ?>
                                                    <img src="../<?= htmlspecialchars($item['image_url']) ?>" alt="Product Image" width="50" height="50" class="rounded shadow-sm">
                                                <?php else: ?>
                                                    <span class="text-muted"><em>No image</em></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="add_edit_product.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-primary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button onclick="deleteProduct(<?= $item['id'] ?>)" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No products found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer text-sm text-center">
            <strong>&copy; <?= date('Y') ?> Lite Bite</strong>. All rights reserved.
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <!-- Product Delete AJAX -->
    <script>
        function deleteProduct(id) {
            if (!confirm("Delete this product?")) return;

            fetch('../logic/product/delete_product.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
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
                .catch(() => alert("An error occurred. Please try again."));
        }
    </script>
</body>

</html>
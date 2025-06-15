<?php
session_start();
include '../config/koneksi.php';

// Redirect non-admin users
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

// Determine mode (add/edit)
$isEdit = isset($_GET['id']);
$product = null;

if ($isEdit) {
    $id = (int) $_GET['id'];
    $stmt = $mysqli->prepare("SELECT * FROM menu_items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();
}

// Show success message
$success = isset($_GET['success']) && $_GET['success'] === '1';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $isEdit ? 'Edit' : 'Add' ?> Product | Admin - Lite Bite</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include '../components/navbarAdmin.php'; ?>
        <?php include '../components/aside.php'; ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid d-flex justify-content-between align-items-center mb-2">
                    <h1 class="m-0"><?= $isEdit ? 'Edit' : 'Add New' ?> Product</h1>
                    <a href="manage_products.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Products
                    </a>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <?php if ($success): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            Product <?= $isEdit ? 'updated' : 'added' ?> successfully!
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    <?php endif; ?>

                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title"><?= $isEdit ? 'Edit' : 'Add' ?> Product Information</h3>
                        </div>

                        <form method="POST"
                            action="../logic/product/<?= $isEdit ? 'edit_product_process.php' : 'add_product_process.php' ?>"
                            enctype="multipart/form-data">
                            <div class="card-body">
                                <?php if ($isEdit): ?>
                                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                <?php endif; ?>

                                <div class="form-group">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" required
                                        value="<?= htmlspecialchars($product['name'] ?? '') ?>">
                                </div>

                                <div class="form-group">
                                    <label>Description <span class="text-danger">*</span></label>
                                    <textarea name="description" rows="3" class="form-control"
                                        required><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Category <span class="text-danger">*</span></label>
                                    <select name="category" class="form-control" required>
                                        <option value="">-- Select --</option>
                                        <?php
                                        $categories = ['salad', 'sandwich', 'dessert', 'drink'];
                                        foreach ($categories as $cat):
                                            $selected = (isset($product['category']) && $product['category'] === $cat) ? 'selected' : '';
                                            echo "<option value='$cat' $selected>" . ucfirst($cat) . "</option>";
                                        endforeach;
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Upload Image</label>
                                    <input type="file" name="image_file" class="form-control-file">
                                    <?php if (!empty($product['image_url'])): ?>
                                        <p class="mt-2"><strong>Current:</strong><br>
                                            <img src="../<?= $product['image_url'] ?>" alt="Current Image" width="100">
                                        </p>
                                    <?php endif; ?>
                                </div>

                                <div class="row">
                                    <?php
                                    $nutrition = ['carb' => 'Carbs (g)', 'protein' => 'Protein (g)', 'fat' => 'Fat (g)', 'calories' => 'Calories'];
                                    foreach ($nutrition as $field => $label): ?>
                                        <div class="col-md-3 mb-3">
                                            <input type="text" name="<?= $field ?>" class="form-control"
                                                placeholder="<?= $label ?>" value="<?= htmlspecialchars($product[$field] ?? '') ?>">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-<?= $isEdit ? 'save' : 'plus-circle' ?>"></i>
                                    <?= $isEdit ? 'Update' : 'Add' ?> Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>

        <footer class="main-footer text-center">
            <strong>&copy; <?= date('Y') ?> Lite Bite.</strong> All rights reserved.
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>
<?php
include 'config/koneksi.php';

// Validate and fetch product
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Invalid product ID.');
}

$product_id = (int) $_GET['id'];
$stmt = $mysqli->prepare("SELECT * FROM menu_items WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Product not found.');
}

$product = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title><?= htmlspecialchars($product['name']) ?> | Lite Bite</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/litebite_combined.css">
</head>

<body>
    <?php include 'components/navbar.php'; ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <img src="<?= htmlspecialchars($product['image_url']) ?>" class="img-fluid rounded-start" alt="<?= htmlspecialchars($product['name']) ?>">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h3 class="card-title text-success"><?= htmlspecialchars($product['name']) ?></h3>
                                <p class="card-text"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                                <ul class="list-group list-group-flush my-3">
                                    <li class="list-group-item">Carbohydrates: <strong><?= $product['carb'] ?>g</strong></li>
                                    <li class="list-group-item">Protein: <strong><?= $product['protein'] ?>g</strong></li>
                                    <li class="list-group-item">Fat: <strong><?= $product['fat'] ?>g</strong></li>
                                    <li class="list-group-item">Calories: <strong><?= $product['calories'] ?></strong></li>
                                </ul>
                                <a href="checkout.php?id=<?= $product['id'] ?>" class="btn btn-custom w-100 mt-3">Order Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="menu.php" class="btn btn-link mt-4 d-block text-center"><i class="bi bi-arrow-left-circle"></i> Back to Menu</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
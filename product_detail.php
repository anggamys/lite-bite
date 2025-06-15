<?php
include 'config/koneksi.php';

// Validate product ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    die('Invalid product ID.');
}

$product_id = (int) $_GET['id'];
$stmt = $mysqli->prepare("SELECT * FROM menu_items WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(404);
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/styles/litebite_combined.css" />
</head>

<body>

    <?php include 'components/navbar.php'; ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card mb-4 shadow-sm">
                    <div class="row g-0 flex-column flex-md-row">
                        <!-- Image -->
                        <div class="col-md-5 text-center p-3">
                            <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="img-fluid rounded shadow-sm" style="max-height: 300px; object-fit: contain;" />
                        </div>
                        <!-- Product Info -->
                        <div class="col-md-7">
                            <div class="card-body">
                                <h2 class="card-title fw-bold text-success"><?= htmlspecialchars($product['name']) ?></h2>
                                <p class="card-text"><?= nl2br(htmlspecialchars($product['description'])) ?></p>

                                <div class="my-4">
                                    <div class="row text-center">
                                        <div class="col-6 col-sm-3">
                                            <span class="badge bg-light text-dark w-100 py-2">Carbs<br><strong><?= $product['carb'] ?>g</strong></span>
                                        </div>
                                        <div class="col-6 col-sm-3">
                                            <span class="badge bg-light text-dark w-100 py-2">Protein<br><strong><?= $product['protein'] ?>g</strong></span>
                                        </div>
                                        <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                                            <span class="badge bg-light text-dark w-100 py-2">Fat<br><strong><?= $product['fat'] ?>g</strong></span>
                                        </div>
                                        <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                                            <span class="badge bg-success text-white w-100 py-2">Calories<br><strong><?= $product['calories'] ?></strong></span>
                                        </div>
                                    </div>
                                </div>

                                <a href="checkout.php?id=<?= $product['id'] ?>" class="btn btn-custom w-100 mt-3">
                                    <i class="bi bi-bag-check-fill"></i> Order Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Back Button -->
                <div class="text-center">
                    <a href="menu.php" class="btn btn-link text-decoration-none">
                        <i class="bi bi-arrow-left-circle me-1"></i> Back to Menu
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
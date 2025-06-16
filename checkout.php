<?php
include 'config/koneksi.php';
include 'logic/order/validate_product.php';
include 'logic/order/process_checkout.php';

// Validate product ID
$product_id = $_GET['id'] ?? null;
$product = getProductById($mysqli, $product_id);
if (!$product) {
  die('Invalid or missing product.');
}

// Handle submission
$orderData = processOrder($mysqli, $product['id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Checkout | <?= htmlspecialchars($product['name']) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/styles/litebite_combined.css" />
</head>

<body>
  <?php include 'components/navbar.php'; ?>

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-9">
        <?php if ($orderData['success']): ?>
          <div class="alert alert-success text-center shadow-sm">
            <h4 class="mb-3">Thank you, <?= htmlspecialchars($orderData['data']['name']) ?>!</h4>
            <p>Your order for <strong><?= $orderData['data']['quantity'] ?></strong> x <strong><?= htmlspecialchars($product['name']) ?></strong> has been placed.</p>
            <a href="menu.php" class="btn btn-outline-success mt-3">
              <i class="bi bi-arrow-left"></i> Back to Menu
            </a>
          </div>
        <?php else: ?>
          <div class="card shadow-sm">
            <div class="row g-0 flex-column flex-md-row">
              <div class="col-md-5 text-center p-3 bg-light">
                <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="img-fluid rounded shadow-sm" style="max-height: 300px; object-fit: contain;" />
                <p class="mt-3 small text-muted">
                  Calories: <?= $product['calories'] ?> |
                  Carb: <?= $product['carb'] ?>g |
                  Protein: <?= $product['protein'] ?>g |
                  Fat: <?= $product['fat'] ?>g
                </p>
              </div>
              <div class="col-md-7 p-4">
                <h4 class="text-success fw-bold mb-3"><?= htmlspecialchars($product['name']) ?></h4>

                <?php if ($orderData['message']): ?>
                  <div class="alert alert-danger"><?= $orderData['message'] ?></div>
                <?php endif; ?>

                <form method="POST" novalidate>
                  <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" name="name" id="name" class="form-control" required value="<?= htmlspecialchars($orderData['data']['name']) ?>">
                  </div>
                  <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="form-control" required value="<?= htmlspecialchars($orderData['data']['phone']) ?>">
                  </div>
                  <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity" id="quantity" min="1" class="form-control" required value="<?= $orderData['data']['quantity'] ?>">
                  </div>
                  <div class="mb-3">
                    <label for="notes" class="form-label">Additional Notes</label>
                    <textarea name="notes" id="notes" class="form-control" rows="3"><?= htmlspecialchars($orderData['data']['notes']) ?></textarea>
                  </div>
                  <button type="submit" class="btn btn-custom w-100">
                    <i class="bi bi-cart-fill me-2"></i>Confirm Order
                  </button>
                </form>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
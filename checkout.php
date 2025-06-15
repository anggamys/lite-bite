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

$order_success = false;

// Handle order form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $customer_name = trim($_POST['name']);
  $phone = trim($_POST['phone']);
  $notes = trim($_POST['notes']);
  $quantity = max(1, (int) $_POST['quantity']);

  // Insert into orders table
  $insert = $mysqli->prepare("INSERT INTO orders (product_id, customer_name, phone, quantity, notes) VALUES (?, ?, ?, ?, ?)");
  $insert->bind_param("issis", $product_id, $customer_name, $phone, $quantity, $notes);

  if ($insert->execute()) {
    $order_success = true;
  } else {
    echo "<div class='alert alert-danger'>Failed to place order. Please try again.</div>";
  }

  $insert->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Checkout | <?= htmlspecialchars($product['name']) ?></title>
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

        <?php if ($order_success): ?>
          <div class="alert alert-success text-center">
            <h4>Thank you, <?= htmlspecialchars($customer_name) ?>!</h4>
            <p>Your order for <strong><?= $quantity ?></strong> x <strong><?= htmlspecialchars($product['name']) ?></strong> has been received.</p>
            <a href="menu.php" class="btn btn-outline-success mt-3">Back to Menu</a>
          </div>
        <?php else: ?>

          <div class="card shadow-sm">
            <div class="row g-0">
              <div class="col-md-5">
                <img src="<?= htmlspecialchars($product['image_url']) ?>" class="img-fluid rounded-start" alt="<?= htmlspecialchars($product['name']) ?>">
              </div>
              <div class="col-md-7">
                <div class="card-body">
                  <h4 class="card-title text-success"><?= htmlspecialchars($product['name']) ?></h4>
                  <p class="small text-muted">Calories: <?= $product['calories'] ?> | Carb: <?= $product['carb'] ?>g | Protein: <?= $product['protein'] ?>g | Fat: <?= $product['fat'] ?>g</p>

                  <form method="POST" class="mt-4">
                    <div class="mb-3">
                      <label for="name" class="form-label">Your Name</label>
                      <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                      <label for="phone" class="form-label">Phone Number</label>
                      <input type="text" class="form-control" name="phone" required>
                    </div>
                    <div class="mb-3">
                      <label for="quantity" class="form-label">Quantity</label>
                      <input type="number" class="form-control" name="quantity" min="1" value="1" required>
                    </div>
                    <div class="mb-3">
                      <label for="notes" class="form-label">Additional Notes</label>
                      <textarea class="form-control" name="notes" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-custom w-100">
                      <i class="bi bi-cart-fill me-2"></i>Confirm Order
                    </button>
                  </form>

                </div>
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
<?php
session_start();
include 'config/koneksi.php';

// Ensure user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];

// Handle flash message from checkout
$checkoutMessage = $_SESSION['checkout_message'] ?? null;
unset($_SESSION['checkout_message']);

// Fetch cart items
$stmt = $mysqli->prepare("
    SELECT c.id AS cart_id, c.quantity, m.id AS product_id, m.name, m.calories, m.image_url 
    FROM cart c 
    JOIN menu_items m ON c.product_id = m.id 
    WHERE c.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$cartItems = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Calculate total items
$totalItems = array_sum(array_column($cartItems, 'quantity'));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Cart | Lite Bite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body>

    <?php include 'components/navbar.php'; ?>

    <div class="container py-5">
        <h2 class="mb-4">🛒 Your Cart (<?= $totalItems ?> items)</h2>

        <?php if ($checkoutMessage): ?>
            <div class="alert alert-info"><?= htmlspecialchars($checkoutMessage) ?></div>
        <?php endif; ?>

        <?php if (count($cartItems) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Calories</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartItems as $item): ?>
                            <tr>
                                <td>
                                    <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" width="60" class="me-2">
                                    <?= htmlspecialchars($item['name']) ?>
                                </td>
                                <td><?= $item['quantity'] ?></td>
                                <td><?= $item['calories'] * $item['quantity'] ?></td>
                                <td>
                                    <form method="POST" action="logic/cart/remove_from_cart.php" class="d-inline">
                                        <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                    <a href="logic/order/checkout_cart.php?cart_id=<?= $item['cart_id'] ?>" class="btn btn-sm btn-outline-primary ms-2">Checkout</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="text-end mt-4">
                <a href="logic/order/checkout_cart.php" class="btn btn-success px-4">Proceed to Checkout All</a>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">
                Your cart is currently empty. <a href="menu.php">Browse our menu</a> to add items!
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
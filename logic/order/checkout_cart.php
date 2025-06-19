<?php
session_start();
include '../../config/koneksi.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../../login.php');
    exit;
}

$user = $_SESSION['user'];
$user_id = $user['id'];

// Single item checkout
$cart_id = $_GET['cart_id'] ?? null;
$checkoutAll = !$cart_id;

// Query: Get cart items
if ($checkoutAll) {
    $stmt = $mysqli->prepare("SELECT * FROM cart WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
} else {
    $stmt = $mysqli->prepare("SELECT * FROM cart WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $cart_id, $user_id);
}
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['checkout_message'] = 'No items found in your cart.';
    header('Location: ../../cart.php');
    exit;
}

// Start transaction
$mysqli->begin_transaction();
$success = true;

while ($row = $result->fetch_assoc()) {
    $insert = $mysqli->prepare("INSERT INTO orders (user_id, product_id, quantity, notes) VALUES (?, ?, ?, ?)");
    $insert->bind_param("iiis", $row['user_id'], $row['product_id'], $row['quantity'], $row['notes']);

    if (!$insert->execute()) {
        $success = false;
        break;
    }

    // Delete from cart
    $delete = $mysqli->prepare("DELETE FROM cart WHERE id = ?");
    $delete->bind_param("i", $row['id']);
    $delete->execute();
}

if ($success) {
    $mysqli->commit();
    $_SESSION['checkout_message'] = 'Your order has been successfully placed!';
} else {
    $mysqli->rollback();
    $_SESSION['checkout_message'] = 'Failed to process your order. Please try again.';
}

header('Location: ../../cart.php');
exit;

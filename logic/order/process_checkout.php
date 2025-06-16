<?php
function processOrder(mysqli $mysqli, int $productId): array
{
    $data = [
        'name' => '',
        'phone' => '',
        'quantity' => 1,
        'notes' => '',
    ];
    $success = false;
    $message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize & trim input
        $data['name'] = trim($_POST['name'] ?? '');
        $data['phone'] = trim($_POST['phone'] ?? '');
        $data['quantity'] = max(1, (int) ($_POST['quantity'] ?? 1));
        $data['notes'] = trim($_POST['notes'] ?? '');

        // Validate input
        if (empty($data['name']) || empty($data['phone']) || $data['quantity'] < 1) {
            $message = 'Please fill in all required fields.';
        } else {
            // Insert into DB
            $stmt = $mysqli->prepare("INSERT INTO orders (product_id, customer_name, phone, quantity, notes) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issis", $productId, $data['name'], $data['phone'], $data['quantity'], $data['notes']);
            if ($stmt->execute()) {
                $success = true;
            } else {
                $message = 'Failed to place order. Please try again.';
            }
            $stmt->close();
        }
    }

    return [
        'success' => $success,
        'message' => $message,
        'data' => $data
    ];
}

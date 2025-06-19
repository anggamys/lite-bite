<?php
function processOrder(mysqli $mysqli, int $productId, array $user = []): array
{
    $data = [
        'name' => $user['username'] ?? '',
        'phone' => $user['email'] ?? '',
        'quantity' => 1,
        'notes' => '',
    ];

    $success = false;
    $message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize & trim input
        $data['quantity'] = max(1, (int) ($_POST['quantity'] ?? 1));
        $data['notes'] = trim($_POST['notes'] ?? '');

        // Ensure user is logged in
        if (empty($user['id']) || empty($data['name']) || empty($data['phone'])) {
            $message = 'You must be logged in to place an order.';
        } else {
            // Save to cart table
            $stmt = $mysqli->prepare("
                INSERT INTO cart (user_id, product_id, quantity, notes)
                VALUES (?, ?, ?, ?)
            ");
            $stmt->bind_param("iiis", $user['id'], $productId, $data['quantity'], $data['notes']);

            if ($stmt->execute()) {
                $success = true;
            } else {
                $message = 'Failed to add to cart. Please try again.';
            }

            $stmt->close();
        }
    }

    return [
        'success' => $success,
        'message' => $message,
        'data' => [
            'name' => $data['name'],
            'phone' => $data['phone'],
            'quantity' => $data['quantity'],
            'notes' => $data['notes']
        ]
    ];
}

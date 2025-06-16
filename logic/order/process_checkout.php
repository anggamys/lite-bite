<?php
function processOrder($mysqli, $product_id)
{
    $response = [
        'success' => false,
        'message' => '',
        'data' => [
            'name' => '',
            'phone' => '',
            'notes' => '',
            'quantity' => 1
        ]
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $response['data']['name'] = $name = trim($_POST['name']);
        $response['data']['phone'] = $phone = trim($_POST['phone']);
        $response['data']['notes'] = $notes = trim($_POST['notes']);
        $response['data']['quantity'] = $quantity = max(1, (int) $_POST['quantity']);

        $stmt = $mysqli->prepare("INSERT INTO orders (product_id, customer_name, phone, quantity, notes) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issis", $product_id, $name, $phone, $quantity, $notes);

        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['message'] = "Failed to submit order.";
        }

        $stmt->close();
    }

    return $response;
}

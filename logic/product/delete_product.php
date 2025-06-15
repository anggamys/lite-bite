<?php
session_start();
include '../../config/koneksi.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int) $_POST['id'];

    // Get image URL first to delete file if needed
    $stmt = $mysqli->prepare("SELECT image_url FROM menu_items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    // Delete image file (optional)
    if ($result && $result['image_url'] && file_exists('../../' . $result['image_url'])) {
        unlink('../../' . $result['image_url']);
    }

    // Delete from DB
    $stmt = $mysqli->prepare("DELETE FROM menu_items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Product deleted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Product not found']);
    }
    exit;
}

http_response_code(400);
echo json_encode(['status' => 'error', 'message' => 'Invalid request']);

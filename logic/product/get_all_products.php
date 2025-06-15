<?php
session_start();
include '../../config/koneksi.php';

// Optional: Restrict access to admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

header('Content-Type: application/json');

$query = "SELECT * FROM menu_items ORDER BY id DESC";
$result = $mysqli->query($query);

$menu = [];
while ($row = $result->fetch_assoc()) {
    $menu[] = $row;
}

echo json_encode($menu);

<?php
session_start();
include '../../config/koneksi.php';

// Access control
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../../login.php');
    exit;
}

// Validate POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id          = (int) $_POST['id'];
    $name        = $_POST['name'];
    $description = $_POST['description'];
    $category    = $_POST['category'];
    $carb        = $_POST['carb'] ?? null;
    $protein     = $_POST['protein'] ?? null;
    $fat         = $_POST['fat'] ?? null;
    $calories    = $_POST['calories'] ?? null;

    // Optional: handle image upload
    $image_path = null;
    if (!empty($_FILES['image_file']['name'])) {
        $upload_dir = '../../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
        $filename = uniqid('img_', true) . '.' . $ext;
        $target_file = $upload_dir . $filename;

        if (move_uploaded_file($_FILES['image_file']['tmp_name'], $target_file)) {
            $image_path = 'uploads/' . $filename;
        }
    }

    // Prepare query
    if ($image_path) {
        $stmt = $mysqli->prepare("UPDATE menu_items SET name=?, description=?, category=?, image_url=?, carb=?, protein=?, fat=?, calories=? WHERE id=?");
        $stmt->bind_param("ssssssssi", $name, $description, $category, $image_path, $carb, $protein, $fat, $calories, $id);
    } else {
        $stmt = $mysqli->prepare("UPDATE menu_items SET name=?, description=?, category=?, carb=?, protein=?, fat=?, calories=? WHERE id=?");
        $stmt->bind_param("sssssssi", $name, $description, $category, $carb, $protein, $fat, $calories, $id);
    }

    // Execute and redirect
    if ($stmt->execute()) {
        header("Location: ../../admins/add_edit_product.php?id=$id&success=1");
    } else {
        die("Error updating product.");
    }
    exit;
} else {
    header('Location: ../../admins/manage_products.php');
    exit;
}

<?php
session_start();
include '../../config/koneksi.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name        = $_POST['name'];
    $description = $_POST['description'];
    $category    = $_POST['category'];
    $carb        = $_POST['carb'];
    $protein     = $_POST['protein'];
    $fat         = $_POST['fat'];
    $calories    = $_POST['calories'];

    // Handle uploaded file
    $image_url = '';
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === 0) {
        $target_dir = "../../uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        $filename = basename($_FILES["image_file"]["name"]);
        $target_file = $target_dir . uniqid() . '_' . $filename;

        if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
            $image_url = str_replace('../../', '', $target_file); // Save relative path
        }
    }

    // Insert into DB
    $stmt = $mysqli->prepare("INSERT INTO menu_items (name, description, category, image_url, carb, protein, fat, calories) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $name, $description, $category, $image_url, $carb, $protein, $fat, $calories);
    $stmt->execute();

    $redirect_url = '../../admins/manage_products.php';
    header('Location: ' . $redirect_url . '?success=1');
    exit;
}

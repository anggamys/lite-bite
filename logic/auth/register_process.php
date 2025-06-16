<?php
session_start();
include '../../config/koneksi.php';

// Sanitize inputs
$username = trim($_POST['username']);
$email    = trim($_POST['email']);
$password = trim($_POST['password']);

// Basic validation
if (empty($username) || empty($email) || empty($password)) {
    $_SESSION['register_error'] = "All fields are required.";
    header("Location: ../../register.php");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['register_error'] = "Invalid email format.";
    header("Location: ../../register.php");
    exit;
}

// Check for duplicates
$stmt = $mysqli->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $_SESSION['register_error'] = "Username or email already exists.";
    $stmt->close();
    header("Location: ../../register.php");
    exit;
}
$stmt->close();

// Insert user directly (⚠️ password stored as plain text)
$role = 'user';
$insert = $mysqli->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
$insert->bind_param("ssss", $username, $email, $password, $role);

if ($insert->execute()) {
    $_SESSION['register_success'] = "Registration successful. You can now log in.";
    header("Location: ../../index.php?success=1");
} else {
    $_SESSION['register_error'] = "Failed to register. Please try again.";
    header("Location: ../../register.php?error=1");
}
$insert->close();

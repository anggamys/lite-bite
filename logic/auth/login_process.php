<?php
session_start();
include '../../config/koneksi.php';

function log_terminal($username, $status, $message)
{
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
    $log = sprintf(
        "[%s] LOGIN %s | User: %s | IP: %s | Msg: %s",
        date("Y-m-d H:i:s"),
        strtoupper($status),
        $username,
        $ip,
        $message
    );
    error_log($log);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if ($password === $user['password']) {
            $_SESSION['user'] = $user;

            log_terminal($username, 'success', 'Login successful');

            $redirect = ($user['role'] === 'admin') ? '../../admins/dashboard.php' : '../../users/dashboard.php';
            header("Location: $redirect");
            exit;
        } else {
            $_SESSION['login_error'] = "Invalid username or password.";
            log_terminal($username, 'failed', 'Incorrect password');
        }
    } else {
        $_SESSION['login_error'] = "User not found.";
        log_terminal($username, 'failed', 'User not found');
    }

    header("Location: ../../login.php");
    exit;
}

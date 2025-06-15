<?php
require_once __DIR__ . '/load_env.php'; // adjust path as needed
loadEnv(__DIR__ . '/../.env');

// Fetch from env
$host     = getenv('DB_HOST');
$port     = getenv('DB_PORT');
$database = getenv('DB_DATABASE');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');

// Create connection
$mysqli = new mysqli($host, $username, $password, $database, (int)$port);

// Check connection
if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

// Optional charset setup
$mysqli->set_charset("utf8mb4");

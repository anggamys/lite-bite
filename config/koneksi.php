<?php
// Database credentials
$host     = '127.0.0.1'; // ✅ Fix: use IP instead of localhost
$username = 'root';
$password = 'C0del@b08';
$database = 'db_eas_pemweb';
$port     = 3306;

// Create connection
$mysqli = new mysqli($host, $username, $password, $database, $port);

// Check connection
if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

// Set charset
if (!$mysqli->set_charset("utf8mb4")) {
  die("Error loading charset utf8mb4: " . $mysqli->error);
}

<?php
// Simple database initialization script
// Requires database.php for the PDO connection
require 'database.php';

// Create tables
$createUsers = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$pdo->exec($createUsers);

// Insert default admin user
$hash = password_hash('admin', PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role) ON DUPLICATE KEY UPDATE username=username");
$stmt->execute([
    ':username' => 'admin',
    ':password' => $hash,
    ':role' => 'admin'
]);

echo "Database setup complete. Please delete db-create.php now." . PHP_EOL;
?>

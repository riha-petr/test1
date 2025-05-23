<?php
// Simple database initialization script
// Requires database.php for the PDO connection
require 'database.php';

// Create tables
$createUsers = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL,
    nickname VARCHAR(255) DEFAULT NULL,
    about_me TEXT DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$pdo->exec($createUsers);

// Albums table
$createAlbums = "CREATE TABLE IF NOT EXISTS albums (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    cover_url VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$pdo->exec($createAlbums);

// Add new profile columns if they don't exist
function columnExists(PDO $pdo, string $table, string $column): bool {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? AND COLUMN_NAME = ?");
    $stmt->execute([$table, $column]);
    return $stmt->fetchColumn() > 0;
}

if (!columnExists($pdo, 'users', 'nickname')) {
    $pdo->exec("ALTER TABLE users ADD COLUMN nickname VARCHAR(255) DEFAULT NULL");
}

if (!columnExists($pdo, 'users', 'about_me')) {
    $pdo->exec("ALTER TABLE users ADD COLUMN about_me TEXT DEFAULT NULL");
}

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

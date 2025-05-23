<?php
// Simple database initialization script

// Update these settings to match your local database configuration
$host = 'localhost';
$dbname = 'travelapp';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

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

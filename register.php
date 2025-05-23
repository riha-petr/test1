<?php
session_start();
require 'database.php';

$errors = [];
$message = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm'] ?? '';

    if ($username === '' || $password === '' || $confirm === '') {
        $errors[] = 'All fields are required.';
    } elseif ($password !== $confirm) {
        $errors[] = 'Passwords do not match.';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare(
                'INSERT INTO users (username, password, role) VALUES (:username, :password, :role)'
            );
            $stmt->execute([
                ':username' => $username,
                ':password' => $hash,
                ':role' => 'user'
            ]);
            $message = 'Registration successful.';
            $username = '';
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                $errors[] = 'Username already exists.';
            } else {
                $errors[] = 'Database error: ' . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
        <title>Register</title>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Traveling-App</title>
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
    <link href="img/*" rel="shortcut icon" type="image/png">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<?php include 'header.php'; ?>
        <main class="content" style="padding:40px;">
                <h1>Register</h1>

                <?php if ($message): ?>
                    <p class="success"><?php echo htmlspecialchars($message); ?></p>
                <?php endif; ?>

                <?php if ($errors): ?>
                    <ul class="errors">
                        <?php foreach ($errors as $err): ?>
                            <li><?php echo htmlspecialchars($err); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <form method="post" action="register.php">
                        <div>
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                        </div>
                        <div>
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" required>
                        </div>
                        <div>
                                <label for="confirm">Confirm Password</label>
                                <input type="password" id="confirm" name="confirm" required>
                        </div>
                        <div>
                                <button type="submit">Register</button>
                        </div>
                </form>
        </main>
<?php include 'footer.php'; ?>

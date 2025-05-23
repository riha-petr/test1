<?php
session_start();
require 'database.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT id, password, role FROM users WHERE username = :username');
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

            header('Location: admin/index.php');
            exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
        <title>Sign in</title>
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
        <main class="content">
                <h1>Sign in</h1>
                <?php if ($error): ?>
                    <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
                <?php endif; ?>
                <form method="post" action="signin.php">
                        <div>
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" required>
                        </div>
                        <div>
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" required>
                        </div>
                        <button type="submit">Sign in</button>
                </form>
        </main>
<?php include 'footer.php'; ?>

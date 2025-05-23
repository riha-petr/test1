<?php
session_start();
require 'database.php';

// Redirect to sign-in page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit;
}

$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare('SELECT nickname, about_me FROM users WHERE id = :id');
$stmt->execute([':id' => $userId]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<?php include 'header.php'; ?>
<main class="content">
    <h1>Profile</h1>
    <p><strong>Nickname:</strong> <?php echo htmlspecialchars($user['nickname'] ?? ''); ?></p>
    <p><strong>About Me:</strong></p>
    <p><?php echo nl2br(htmlspecialchars($user['about_me'] ?? '')); ?></p>
    <p><a href="admin/edit_user.php?id=<?php echo $userId; ?>" class="button">Edit Profile</a></p>
</main>
<?php include 'footer.php'; ?>

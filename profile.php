<?php
session_start();
require 'database.php';

// Redirect to sign-in page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit;
}

$userId = $_SESSION['user_id'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nickname = $_POST['nickname'] ?? null;
    $aboutMe = $_POST['about_me'] ?? null;

    $stmt = $pdo->prepare('UPDATE users SET nickname = :nickname, about_me = :about_me WHERE id = :id');
    $stmt->execute([
        ':nickname' => $nickname,
        ':about_me' => $aboutMe,
        ':id' => $userId
    ]);

    $message = 'Profile updated.';
}

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
<main class="content" style="padding:40px;">
    <h1>Profile</h1>
    <?php if ($message): ?>
        <p class="success"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form method="post" action="profile.php">
        <div>
            <label for="nickname">Nickname</label>
            <input type="text" id="nickname" name="nickname" value="<?php echo htmlspecialchars($user['nickname'] ?? ''); ?>">
        </div>
        <div>
            <label for="about_me">About Me</label>
            <textarea id="about_me" name="about_me" rows="5"><?php echo htmlspecialchars($user['about_me'] ?? ''); ?></textarea>
        </div>
        <div>
            <button type="submit">Save</button>
        </div>
    </form>
</main>
<?php include 'footer.php'; ?>

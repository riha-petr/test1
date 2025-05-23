<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../signin.php');
    exit;
}
require '../database.php';

$userId = $_GET['id'] ?? null;
if (!$userId) {
    header('Location: index.php');
    exit;
}

if ($_SESSION['role'] !== 'admin' && $_SESSION['user_id'] != $userId) {
    header('Location: index.php');
    exit;
}

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

    $message = 'User updated.';
}

$stmt = $pdo->prepare('SELECT username, nickname, about_me FROM users WHERE id = :id');
$stmt->execute([':id' => $userId]);
$user = $stmt->fetch();
if (!$user) {
    die('User not found');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit User</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<?php include 'header.php'; ?>
<div class="admin-container">
    <h1>Edit User</h1>
    <?php if ($message): ?>
        <p class="success"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form method="post" action="edit_user.php?id=<?php echo $userId; ?>">
        <div>
            <label>Username</label>
            <input type="text" value="<?php echo htmlspecialchars($user['username']); ?>" disabled>
        </div>
        <div>
            <label for="nickname">Nickname</label>
            <input type="text" id="nickname" name="nickname" value="<?php echo htmlspecialchars($user['nickname'] ?? ''); ?>">
        </div>
        <div>
            <label for="about_me">About Me</label>
            <textarea id="about_me" name="about_me" rows="5"><?php echo htmlspecialchars($user['about_me'] ?? ''); ?></textarea>
        </div>
        <button type="submit">Save</button>
    </form>
</div>
<?php include 'footer.php'; ?>

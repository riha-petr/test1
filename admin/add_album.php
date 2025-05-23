<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../signin.php');
    exit;
}
require '../database.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $cover = trim($_POST['cover_url'] ?? '');
    if ($title !== '') {
        $stmt = $pdo->prepare("INSERT INTO albums (title, cover_url) VALUES (:title, :cover)");
        $stmt->execute([':title' => $title, ':cover' => $cover]);
        header('Location: albums.php');
        exit;
    } else {
        $message = 'Title is required.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Add Album</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<?php include 'header.php'; ?>
<h1>Add Album</h1>
<?php if ($message): ?><p class="error"><?php echo htmlspecialchars($message); ?></p><?php endif; ?>
<form method="post" action="add_album.php">
    <div>
        <label for="title">Title</label>
        <input type="text" id="title" name="title" required>
    </div>
    <div>
        <label for="cover_url">Cover URL</label>
        <input type="text" id="cover_url" name="cover_url">
    </div>
    <button type="submit">Create</button>
</form>
<?php include 'footer.php'; ?>

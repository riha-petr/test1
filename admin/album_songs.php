<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../signin.php');
    exit;
}
require '../database.php';

$album_id = $_GET['album_id'] ?? null;
if (!$album_id) {
    header('Location: albums.php');
    exit;
}

$stmt = $pdo->prepare("SELECT id, title FROM albums WHERE id = ?");
$stmt->execute([$album_id]);
$album = $stmt->fetch();
if (!$album) {
    die('Album not found');
}

$stmt = $pdo->prepare("SELECT id, title, file_url FROM songs WHERE album_id = ? ORDER BY id");
$stmt->execute([$album_id]);
$songs = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Manage Songs</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<?php include 'header.php'; ?>
<h1>Songs for <?php echo htmlspecialchars($album['title']); ?></h1>
<p><a href="add_song.php?album_id=<?php echo $album['id']; ?>" class="button">Add Song</a></p>
<table class="admin-table">
    <thead>
        <tr>
            <th>Title</th>
            <th>File</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($songs as $song): ?>
        <tr>
            <td><?php echo htmlspecialchars($song['title']); ?></td>
            <td><?php echo htmlspecialchars($song['file_url']); ?></td>
            <td><a href="delete_song.php?album_id=<?php echo $album_id; ?>&id=<?php echo $song['id']; ?>">Delete</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include 'footer.php'; ?>

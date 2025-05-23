<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../signin.php');
    exit;
}
require '../database.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_album'])) {
    $title = trim($_POST['title'] ?? '');
    $cover = trim($_POST['cover_url'] ?? '');
    if ($title !== '') {
        $stmt = $pdo->prepare("INSERT INTO albums (title, cover_url) VALUES (:title, :cover)");
        $stmt->execute([':title' => $title, ':cover' => $cover]);
        $message = 'Album added';
    } else {
        $message = 'Title is required.';
    }
}

$stmt = $pdo->query("SELECT id, title, cover_url FROM albums ORDER BY created_at DESC");
$albums = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Manage Albums</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<?php include 'header.php'; ?>
<div class="admin-container">
<h1>Albums</h1>
<?php if ($message): ?>
    <p class="success"><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>
<form class="add-form" method="post" action="albums.php">
    <input type="hidden" name="add_album" value="1">
    <div>
        <label for="title">Title</label>
        <input type="text" id="title" name="title" required>
    </div>
    <div>
        <label for="cover_url">Cover URL</label>
        <input type="text" id="cover_url" name="cover_url">
    </div>
    <button type="submit">Add Album</button>
</form>
<table class="admin-table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Cover</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($albums as $album): ?>
        <tr>
            <td><?php echo htmlspecialchars($album['title']); ?></td>
            <td><?php if ($album['cover_url']): ?>
                <img src="<?php echo htmlspecialchars($album['cover_url']); ?>" style="max-width:100px">
                <?php endif; ?>
            </td>
            <td>
                <a class="action-link" href="album_songs.php?album_id=<?php echo $album['id']; ?>"><i class="fa fa-music"></i></a>
                <a class="action-link" href="delete_album.php?id=<?php echo $album['id']; ?>" onclick="return confirm('Delete album?')"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php include 'footer.php'; ?>

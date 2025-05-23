<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../signin.php');
    exit;
}
require '../database.php';

$album_id = $_GET['album_id'] ?? $_POST['album_id'] ?? null;
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

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_song'])) {
    $title = trim($_POST['title'] ?? '');
    $file_url = trim($_POST['file_url'] ?? '');
    $lyrics = trim($_POST['lyrics'] ?? '');
    if ($title !== '' && $file_url !== '') {
        $stmt = $pdo->prepare("INSERT INTO songs (album_id, title, file_url, lyrics) VALUES (?, ?, ?, ?)");
        $stmt->execute([$album_id, $title, $file_url, $lyrics]);
        $message = 'Song added';
    } else {
        $message = 'Title and file URL are required.';
    }
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
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<?php include 'header.php'; ?>
<div class="admin-container">
<h1>Songs for <?php echo htmlspecialchars($album['title']); ?></h1>
<?php if ($message): ?>
    <p class="success"><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>
<form class="add-form" method="post" action="album_songs.php">
    <input type="hidden" name="album_id" value="<?php echo $album_id; ?>">
    <input type="hidden" name="add_song" value="1">
    <div>
        <label for="title">Title</label>
        <input type="text" id="title" name="title" required>
    </div>
    <div>
        <label for="file_url">File URL</label>
        <input type="text" id="file_url" name="file_url" required>
    </div>
    <div>
        <label for="lyrics">Lyrics</label>
        <textarea id="lyrics" name="lyrics"></textarea>
    </div>
    <button type="submit">Add Song</button>
</form>
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
            <td><a class="action-link" href="delete_song.php?album_id=<?php echo $album_id; ?>&id=<?php echo $song['id']; ?>" onclick="return confirm('Delete song?')"><i class="fa fa-trash"></i></a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php include 'footer.php'; ?>

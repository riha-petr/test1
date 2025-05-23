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

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $file_url = trim($_POST['file_url'] ?? '');
    $lyrics = trim($_POST['lyrics'] ?? '');
    if ($title !== '' && $file_url !== '') {
        $stmt = $pdo->prepare("INSERT INTO songs (album_id, title, file_url, lyrics) VALUES (?, ?, ?, ?)");
        $stmt->execute([$album_id, $title, $file_url, $lyrics]);
        header('Location: album_songs.php?album_id=' . $album_id);
        exit;
    } else {
        $message = 'Title and file URL are required.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Add Song</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<?php include 'header.php'; ?>
<div class="admin-container">
<h1>Add Song</h1>
<?php if ($message): ?><p class="error"><?php echo htmlspecialchars($message); ?></p><?php endif; ?>
<form method="post" action="add_song.php">
    <input type="hidden" name="album_id" value="<?php echo $album_id; ?>">
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
    <button type="submit">Create</button>
</form>
</div>
<?php include 'footer.php'; ?>

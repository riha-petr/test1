<?php
session_start();
require 'database.php';

$albumId = $_GET['album_id'] ?? '';
$albums = $pdo->query("SELECT id, title FROM albums ORDER BY created_at DESC")->fetchAll();

$songs = [];
if ($albumId) {
    $stmt = $pdo->prepare("SELECT title, file_url, lyrics FROM songs WHERE album_id = ? ORDER BY id");
    $stmt->execute([$albumId]);
    $songs = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Song Library</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<?php include 'header.php'; ?>
<main class="content">
<h1 style="text-align:center;margin:20px 0;">Songs</h1>
<form method="get" action="songs.php" style="text-align:center;margin-bottom:20px;">
    <label for="album_id">Select album:</label>
    <select name="album_id" id="album_id" onchange="this.form.submit()">
        <option value="">-- choose album --</option>
        <?php foreach ($albums as $album): ?>
            <option value="<?php echo $album['id']; ?>" <?php if($albumId==$album['id']) echo 'selected'; ?>><?php echo htmlspecialchars($album['title']); ?></option>
        <?php endforeach; ?>
    </select>
</form>
<?php if ($songs): ?>
<ul class="song-list">
    <?php foreach ($songs as $song): ?>
    <li class="song-item">
        <h2><?php echo htmlspecialchars($song['title']); ?></h2>
        <?php if ($song['lyrics']): ?>
        <pre class="lyrics"><?php echo htmlspecialchars($song['lyrics']); ?></pre>
        <?php endif; ?>
        <audio controls src="<?php echo htmlspecialchars($song['file_url']); ?>"></audio>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
</main>
<?php include 'footer.php'; ?>

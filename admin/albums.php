<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../signin.php');
    exit;
}
require '../database.php';

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
<p><a href="add_album.php" class="button"><i class="fa fa-plus"></i> Add Album</a></p>
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

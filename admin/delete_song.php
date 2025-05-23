<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../signin.php');
    exit;
}
require '../database.php';

$album_id = $_GET['album_id'] ?? null;
$id = $_GET['id'] ?? null;
if ($album_id && $id) {
    $stmt = $pdo->prepare("DELETE FROM songs WHERE id = ? AND album_id = ?");
    $stmt->execute([$id, $album_id]);
}
header('Location: album_songs.php?album_id=' . $album_id);
exit;

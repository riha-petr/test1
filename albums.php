<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Traveling-App</title>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
    <link href="img/*" rel="shortcut icon" type="image/png">
	<link rel="stylesheet" type="text/css" href="css/musica.css">
	<link rel="stylesheet" type="text/css" href="css/albums.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<?php include 'header.php'; ?>
<h1 style="text-align:center;margin:20px 0;">Albums</h1>
        <div class="album-grid">
<?php
require 'database.php';
$stmt = $pdo->query("SELECT id, title, cover_url FROM albums ORDER BY created_at DESC");
foreach ($stmt as $album): ?>
                <div class="album-card">
                    <h2><?php echo htmlspecialchars($album['title']); ?></h2>
                    <?php if ($album['cover_url']): ?>
                    <img src="<?php echo htmlspecialchars($album['cover_url']); ?>" alt="cover">
                    <?php endif; ?>
                </div>
<?php endforeach; ?>
        </div>

	<script type="text/javascript">
		function myFunc() {
			console.log(1);
		}
	</script>
	<script src="js/albums_main.js"></script>
<?php include 'footer.php'; ?>

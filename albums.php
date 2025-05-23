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
		<div class="layer">
				<div class="musicaplayersection">
					Music player here with playlist
				</div>
				<div class="block">
					<h2>
						NordicMann is a music way to describe vikings and scandinavian culture
					</h2>
				</div>
		</div>
	
	<section class="music-section">
		<div class="musica-wrapper" onscroll="myFunc();">
                        <div class="wrappa">
<?php
require 'database.php';
$stmt = $pdo->query("SELECT title, cover_url FROM albums ORDER BY created_at DESC");
foreach ($stmt as $album): ?>
                                <div class="insider">
                                        <h2><?php echo htmlspecialchars($album['title']); ?></h2>
                                        <?php if ($album['cover_url']): ?>
                                        <img src="<?php echo htmlspecialchars($album['cover_url']); ?>">
                                        <?php endif; ?>
                                </div>
<?php endforeach; ?>
                        </div>
			<!--<div class="boxed">
				<div class="boxed-content">
				
					<h2>Name fo song</h2>
					<img src="https://unsplash.it/400">
					<div class="song-box">
						Song - box
					</div>
					<p class="descr">Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
			</div>
			<div class="boxed">
				<div class="boxed-content">
					
					<h2>Name fo song</h2>
					<img src="https://unsplash.it/400">
					<div class="song-box">
						Song - box
					</div>
					<p class="descr">Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
			</div>
			<div class="boxed">
				<div class="boxed-content">
				
					<h2>Name fo song</h2>
					<img src="https://unsplash.it/400">
					<div class="song-box">
						Song - box
					</div>
					<p class="descr">Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
			</div>
			<div class="boxed">
				<div class="boxed-content">
					
					<h2>Name fo song</h2>
					<img src="https://unsplash.it/400">
					<div class="song-box">
						Song - box
					</div>
					<p class="descr">Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
			</div>
			<div class="boxed">
				<div class="boxed-content">
				
					<h2>Name fo song</h2>
					<img src="https://unsplash.it/400">
					<div class="song-box">
						Song - box
					</div>
					<p class="descr">Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
			</div>-->
		</div>
	</section>

	<script type="text/javascript">
		function myFunc() {
			console.log(1);
		}
	</script>
	<script src="js/albums_main.js"></script>
<?php include 'footer.php'; ?>

<body class="admin-body">
<div class="admin-wrapper">
    <aside class="admin-sidebar">
        <h1 class="admin-logo">Admin</h1>
        <ul class="admin-menu">
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="albums.php">Albums</a></li>
            <li><a href="edit_user.php?id=<?php echo $_SESSION['user_id']; ?>">Profile</a></li>
            <li><a href="../index.php">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </aside>
    <main class="admin-main">

<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../signin.php');
    exit;
}

require '../database.php';

try {
    $stmt = $pdo->query("SELECT id, username, role FROM users");
    $users = $stmt->fetchAll();
} catch (Exception $e) {
    die('Failed to fetch users: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo htmlspecialchars($user['role']); ?></td>
                <td><a href="edit_user.php?id=<?php echo $user['id']; ?>">Edit</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

<?php
include 'db.php';

// Read users
$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD App</title>
</head>
<body>
    <h1>User Management</h1>

    <h2>Add User</h2>
    <form method="POST" action="create.php">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="number" name="age" placeholder="Age" required>
        <button type="submit">Add User</button>
    </form>

    <h2>User List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['age'] ?></td>
            <td>
                <a href="edit.php?id=<?= $user['id'] ?>">Edit</a>
                <a href="delete.php?id=<?= $user['id'] ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

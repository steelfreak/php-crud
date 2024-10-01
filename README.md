# php-crud
A basic Create, Read, Update &amp; Delete App
Sure! Below is a simple CRUD (Create, Read, Update, Delete) application using PHP and MySQL to handle user data (name, email, and age). I'll guide you through the setup step-by-step.

### Step 1: Set Up the Database

1. **Create the Database:**
   ```sql
   CREATE DATABASE crud_app;
   ```

2. **Create the Table:**
   ```sql
   USE crud_app;

   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(100) NOT NULL,
       email VARCHAR(100) NOT NULL UNIQUE,
       age INT NOT NULL
   );
   ```

### Step 2: Connect to the Database

Create a file named `db.php` for database connection.

```php
<?php
$host = 'localhost';
$db = 'crud_app';
$user = 'root'; // change if your username is different
$pass = ''; // change if your password is different

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
```

### Step 3: Create the CRUD Operations

1. **Create a file named `index.php`:**

```php
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
```

2. **Create `create.php`:**

```php
<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    $stmt = $pdo->prepare("INSERT INTO users (name, email, age) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $age]);

    header("Location: index.php");
}
?>
```

3. **Create `edit.php`:**

```php
<?php
include 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ?, age = ? WHERE id = ?");
    $stmt->execute([$name, $email, $age, $id]);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form method="POST">
        <input type="text" name="name" value="<?= $user['name'] ?>" required>
        <input type="email" name="email" value="<?= $user['email'] ?>" required>
        <input type="number" name="age" value="<?= $user['age'] ?>" required>
        <button type="submit">Update User</button>
    </form>
</body>
</html>
```

4. **Create `delete.php`:**

```php
<?php
include 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
?>
```

### Step 4: Testing the Application

1. Ensure you have your PHP environment set up (like XAMPP or WAMP).
2. Place the PHP files in your server's root directory (e.g., `htdocs` for XAMPP).
3. Access `index.php` via your browser, and you should be able to add, edit, and delete users.

### Security Considerations

- Always validate and sanitize user inputs to avoid SQL injection and other vulnerabilities.
- Consider using prepared statements (as shown) to further secure your application.

### Additional Enhancements

- Implement user input validation and error handling.
- Add styles with CSS for better user experience.
- Consider using a front-end framework for a more dynamic interface.

This basic structure should help you get started with a CRUD application using PHP and MySQL! If you have any questions or need further assistance, feel free to ask!

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

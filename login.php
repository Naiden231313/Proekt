<?php
session_start();
require 'db.php';

if(isset($_POST['username']) && isset($_POST['password'])) {

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch();

    if($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user'] = $user['username'];
        header("Location: index.php");
        exit();
    } else {
        echo "Грешен логин!";
    }
}
?>

<form method="POST">
    Username: <input name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button>Log in</button>
</form>

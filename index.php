<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Главная страница</h1>
    <?php if (isset($_SESSION['username'])): ?>
        <p>Добро пожаловать, <?= htmlspecialchars($_SESSION['username']); ?>!</p>
        <a href="logout.php">Выйти</a>
    <?php else: ?>
        <p><a href="login.php">Войти</a> или <a href="register.php">Зарегистрироваться</a></p>
    <?php endif; ?>
</body>
</html>
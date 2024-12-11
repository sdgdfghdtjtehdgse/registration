<?php
session_start();

// Подключение к БД
$host = 'localhost';
$db   = 'users_db';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Обработка POST-запроса
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

// Запрос к БД
    $stmt = $conn->prepare("SELECT password FROM users WHERE username=?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    
    // Проверка пароля
    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        $_SESSION['username'] = $username;
        echo "Добро пожаловать, " . htmlspecialchars($username) . "!";
    } else {
        echo "В доступе отказанно, " . htmlspecialchars($username) . "!";
    }
    
    // Закрытие подготовленного запроса и соединения
    $stmt->close();
}

$conn->close();

// Создаем форму для входа пользователей
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Вход</h1>
    <form method="POST">
        <input type="text" name="username" placeholder="Имя пользователя" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit">Войти</button>
    </form>
    <a href="register.php">Еще нет аккаунта? Регистрация</a>
</body>
</html>
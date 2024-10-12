<?php
    session_start();
    $host = 'localhost';
    $db = 'mydb';
    $user = 'mydb_admin';
    $pass = 'Qwerty12';

    $conn = new mysqli($host, $user, $pass, $db);
    function my_password_verify($password, $hashed_password) {
        return $password == $hashed_password;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $stmt = $conn->prepare("SELECT password FROM users WHERE username LIKE ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashed_password);
            $stmt->fetch();
            if (my_password_verify($password, $hashed_password)) {
                $_SESSION['username'] = $username;
                echo "Успешная авторизация.";
            } else {
                echo "Неверные учетные данные.";
            }
        } else {
            echo "Пользователь не найден.";
        }
        $stmt->close();
    }
    $conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="username" placeholder="Имя пользователя" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit">Войти</button>
    </form>
</body>
</html>

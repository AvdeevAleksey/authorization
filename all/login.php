<?php

    session_start();
    require_once("crud.php");

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if(!empty($_POST['username'])){
            $action->login_user(); 
        }
    }

    // session_start();
    // $host = 'localhost';
    // $db = 'mydb';
    // $user = 'mydb_admin';
    // $pass = 'Qwerty12';

    // $conn = new mysqli($host, $user, $pass, $db);
    // function my_password_verify($password, $hashed_password) {
    //     return $password == $hashed_password;
    // }

    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     $username = $_POST['username'];
    //     $password = $_POST['password'];
    
    //     $stmt = $conn->prepare("SELECT password FROM users WHERE username LIKE ?");
    //     $stmt->bind_param("s", $username);
    //     $stmt->execute();
    //     $stmt->store_result();
        
    //     if ($stmt->num_rows > 0) {
    //         $stmt->bind_result($hashed_password);
    //         $stmt->fetch();
    //         if (my_password_verify($password, $hashed_password)) {
    //             $_SESSION['username'] = $username;
    //             echo "Успешная авторизация.";
    //         } else {
    //             echo "Неверные учетные данные.";
    //         }
    //     } else {
    //         echo "Пользователь не найден.";
    //     }
    //     $stmt->close();
    // }
    // $conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
</head>
<body>
    <form action="" method="POST">
        <?php if(isset($_SESSION['success_msg'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['success_msg'] ?>
            </div>
        <?php unset($_SESSION['success_msg']); ?>
        <?php endif; ?>
        <?php if(isset($_SESSION['error_msg'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error_msg'] ?>
            </div>
        <?php unset($_SESSION['error_msg']); ?>
        <?php endif; ?>
        <input type="text" name="username" placeholder="Имя пользователя" value="<?= isset($data['username']) ? $data['username'] : '' ?>" required="required">
        <input type="password" name="password" placeholder="Пароль" value="<?= isset($data['password']) ? password_hash($data['password'], PASSWORD_DEFAULT) : '' ?>" required="required">
        <!-- <a href="./?action=edit&id=<?= $row['user_id'] ?>" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit" title="Редактировать"></i></a> -->
        <button type="submit">Войти</button>
    </form>
</body>
</html>

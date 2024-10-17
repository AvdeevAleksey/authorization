<?php
    session_start();
    require_once("crud.php");
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if(!empty($_POST['email'])){
            $action->login_user(); 
        }
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="./style.css">

</head>
<body>
    <div id="container" class="container">
        <div class="header">
            <p class="c_id">Войти в WEB ID</p>
            <p class="forget_id">Забыли WEB ID?</p>
        </div>
        <form action="" method="POST">
            <input type="email" id="email" name="email" class="form-field email_enter" placeholder="example@mail.ru" required>
            <input type="password" id="password" name="password" class="form-field pass_enter" placeholder="Пароль" required>
            <p class="or">ИЛИ</p>
            <div class="icons">
                <button id="vk" class="vk" onclick="document.location=`https://vk.com`"></button>
                <button id="tg" class="tg" onclick="document.location=`https://web.telegram.org`"></button>
                <button id="inst" class="inst" onclick="document.location=`https://www.instagram.com/`"></button>
            </div>
            <input type="submit" id="btn_enter" name="btn_enter" class="form-field btn_enter" value="Войти">
            <input type="button" id="btn_toggle" name="btn_toggle" class="form-field btn_toggle" value="Сменить тему">
            <?php if(isset($_SESSION['success_msg'])): ?>
                <div class="alert alert-success rounded-0">
                    <?= $_SESSION['success_msg'] ?>
                </div>
            <?php unset($_SESSION['success_msg']); ?>
            <?php endif; ?>
            <?php if(isset($_SESSION['error_msg'])): ?>
                <div class="alert alert-danger rounded-0">
                    <?= $_SESSION['error_msg'] ?>
                </div>
            <?php unset($_SESSION['error_msg']); ?>
            <?php endif; ?>
        </form>
    </div>
    <script>
        document.getElementById("btn_toggle").addEventListener("click", function () {
            document.body.classList.toggle("dark-theme");
        });
    </script>
</body>
</html>

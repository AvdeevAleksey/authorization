<?php
    session_start();
    require_once("crud.php");
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if(empty($_POST['id'])){
            $action->insert_member(); 
        }
    }
    // if(isset($_GET['action'])){
    //     switch($_GET['action']){
    //         case 'edit':
    //             $data = $action->get_member_by_id($_GET['id']);
    //             break;
    //         case 'delete':
    //             $data = $action->delete_member($_GET['id']);
    //             break;
    //     }
    // }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
</head>
<body>
    <form action="" method="POST">
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
        <input type="hidden" name="id" value="<?= isset($data['id']) ? $data['id'] : '' ?>">
        <input type="text" id="username" name="username" placeholder="Имя пользователя"  value="<?= isset($data['username']) ? $data['username'] : '' ?>" required="required">
        <input type="password" id="password" name="password" placeholder="Пароль"  value="<?= isset($data['password']) ? password_hash($data['password'], PASSWORD_DEFAULT) : '' ?>" required="required">
        <input type="email" id="email" name="email" placeholder="Email"  value="<?= isset($data['email']) ? $data['email'] : '' ?>" required="required">
        <button type="submit">Зарегистрироваться</button>
    </form>
</body>
</html>

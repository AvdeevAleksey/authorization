<?php
session_start();
require_once('db-connect.php');

Class Actions extends Database{
    function __construct(){
        parent::__construct();
    }
    function __destruct(){
        parent::__destruct();
    }

    public function insert_member(){
        $insert = $this->insert($_POST);
        if($insert['status'] == 'success'){
            $_SESSION['success_msg'] = "Новый пользователь добавлен успешно.";
            header("location: ./login.php");
            exit;
        }elseif($insert['status'] =='failed' && isset($insert['error'])){
            $_SESSION['form_error_msg'] = $insert['error'];
        }else{
            $_SESSION['form_error_msg'] = "По неизвестной причине при вставке данных произошла ошибка";
        }
        $data = [];
        foreach($_POST as $k => $v){
            $data[$k] = $v;
        }
    }
    public function get_member_by_id($id){
        return $this->get_single_by_id($id);
    }

    public function login_user() {
        $login = $this->login($_POST);
        if ($login['status'] == 'success') {
                $_SESSION['success_msg'] = "Успешная авторизация.";
                // Переход на страницу сервиса
                // header("location: http://ya.ru");
                // exit;
            } else {
                $_SESSION['error_msg'] = "Неверные учетные данные.";
                // header("location: ./register.php");
        }
        $data = [];
        foreach($_POST as $k => $v){
            if($k != "btn_enter") {
                $data[$k] = $v;
            }
        }
    }

    // public function update_member(){
    //     $update = $this->update($_POST);
    //     if($update['status'] == 'success'){
    //         $_SESSION['success_msg'] = "Информация о пользователе была успешно обновлена.";
    //         header("location: ./login.php");
    //         exit;
    //     }elseif($update['status'] == 'failed' && isset($update['error'])){
    //         $_SESSION['form_error_msg'] = $update['error'];
    //     }else{
    //         $_SESSION['form_error_msg'] = "По неизвестной причине при вставке данных произошла ошибка";
    //     }
    //     $data = [];
    //     foreach($_POST as $k => $v){
    //         $data[$k] = $v;
    //     }
    // }

    // public function delete_member($id){
    //     $delete = $this->delete($id);
    //     $success = ($delete['status'] == 'success') ? true : false;
    //     if($success){
    //         $_SESSION['success_msg'] = "Запись о пользователе удалена.";
    //         header("location: ./register.php");
    //         exit;
    //     }elseif($delete['status'] == 'failed' && isset($delete['error'])){
    //         $_SESSION['error_msg'] = $delete['error'];
    //     }else{
    //         $_SESSION['error_msg'] = "По неизвестной причине при вставке данных произошла ошибка";
    //     }
    //     return $success;
    // }
}

$action = new Actions();
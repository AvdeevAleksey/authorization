<?php
    function my_udf_md5($string) {
        return md5($string);
    }

    Class Database extends mysqli{
        private $host = 'localhost'; // Здесь указать host для подключения к БД
        private $dbname = 'mydb'; // Здесь указать название БД
        private $username = 'mydb_admin'; // Здесь указать логин для подключения к БД
        private $password = 'Qwerty12';// Здесь указать пароль для подключения к БД
        private $allowed_field;
        function __construct(){
            parent::__construct($this->host, $this->username, $this->password, $this->dbname);
            $this->allowed_field = ['id', 'name', 'surname', 'born', 'country', 'email', 'password'];
            $this->query('CREATE TABLE IF NOT EXISTS web_id_users (
                                            id INT AUTO_INCREMENT PRIMARY KEY,
                                            name VARCHAR(50) NOT NULL,
                                            surname VARCHAR(50) NOT NULL,
                                            born DATE NOT NULL,
                                            country VARCHAR(50) NOT NULL,
                                            email VARCHAR(100) NOT NULL UNIQUE,
                                            password VARCHAR(255) NOT NULL,
                                            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);'); 
            if ($this->connect_error) {
                die('Ошибка подключения (' . $this->connect_errno . ') ' . $this->connect_error);
            }
        }
        function __destruct(){
            $this->close();
        }
        function sanitize_string($string = ""){
            if(!is_numeric($string)){
                $string = addslashes($this->real_escape_string($string));
            }
            return $string;
        }
        function my_password_verify($password, $hashed_password) {
            return $password == $hashed_password;
        }
        public function insert($data = []){
            if(!is_array($data)){
                return ['status' => 'failed', "error" => "Data must be an array."];
            }else{
                if(count($data) <= 0)
                return ['status' => 'failed', "error" => "Data is empty"];

                $fields = "";
                $values = "";
                foreach($data as $k => $v){
                    if(in_array($k, $this->allowed_field) && $k != "id" && $k != "r_pass" && $k != "btn_next"){
                        $v = $this->sanitize_string($v);
                        if(!empty($fields)) $fields .= ", ";
                        $fields .= "`{$k}`";
                        if(!empty($values)) $values .= ", ";
                        $values .= "'{$v}'";                        
                    }
                }
                if(empty($fields))
                return ['status' => 'failed', "error" => "Given data fields are not allowed"];
                
                $sql = "INSERT INTO `web_id_users` ({$fields}) VALUES ({$values})";
                $save = $this->query($sql);
                if($save){
                    return ['status' => 'success'];
                }else{
                    return ['status' => 'failed', "error" => $this->error];
                }
            }
        }

        public function get_single_by_id($id){
            $id = $this->sanitize_string($id);
            $sql = "SELECT * FROM `web_id_users`  where `id` = '{$id}'";
            $query = $this->query($sql);
            return $query->fetch_array();
            if($query){
                return ['status' => 'success'];
            }else{
                return ['status' => 'failed', "error" => $this->error];
            }
        }

        public function login($data = []) {
            if(!is_array($data)){
                return ['status' => 'failed', "error" => "Data must be an array."];
            }else{
                if(count($data) <= 0)
                return ['status' => 'failed', "error" => "Data is empty"];

                $email = $this->sanitize_string($data['email']);
                $userpass = $data['password'];
                
                if(empty($email))
                return ['status' => 'failed', "error" => "Given data fields are not allowed"];
                
                $sql = "SELECT * FROM `web_id_users`  where `email` = '{$email}'";
                $query = $this->query($sql);
                $hashed_password = $query->fetch_array()['password'];
                if($this->my_password_verify($userpass, $hashed_password)){
                    return ['status' => 'success'];
                }else{
                    return ['status' => 'failed', "error" => $this->error];
                }
            }
        }

        // public function update($data=[]){
        //     if(!is_array($data)){
        //         return ['status' => 'failed', "error" => "Data must be an array."];
        //     }else{
        //         if(count($data) <= 0)
        //         return ['status' => 'failed', "error" => "Data is empty"];

        //         $update_data = "";
        //         foreach($data as $k => $v){
        //             if(in_array($k, $this->allowed_field) && $k != "id" && $k != "boss_name"){
        //                 $v = $this->sanitize_string($v);
        //                 if(!empty($update_data)) $update_data .= ", ";
        //                 $update_data .= "`{$k}`= '{$v}'";
        //             }
        //         }
        //         if(empty($update_data))
        //         return ['status' => 'failed', "error" => "Given data fields are not allowed"];
        //         $id = $this->sanitize_string($data['id']);
        //         $sql = "UPDATE `web_id_users` SET {$update_data} WHERE `id` = '{$id}'";
        //         $save = $this->query($sql);
        //         if($save){
        //             return ['status' => 'success'];
        //         }else{
        //             return ['status' => 'failed', "error" => $this->error];
        //         }
        //     }
        // }
        // public function delete($id=""){
        //     if(empty($id))
        //     return ['status' => 'failed', "error" => "ID is required."];
        //     if(!is_numeric($id))
        //     return ['status' => 'failed', "error" => "ID cannot be a string."];
        //     $sql = "DELETE FROM `web_id_users` where `id` = '{$id}'";
        //     $delete = $this->query($sql);
        //     if($delete){
        //         return ['status' => 'success'];
        //     }else{
        //         return ['status' => 'failed', "error" => $this->error];
        //     }
            
        // }
    }

    // $db = new Database();

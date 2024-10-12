<?php
    function my_udf_md5($string) {
        return md5($string);
    }

    Class Database extends mysqli{
        private $host = 'localhost';
        private $dbname = 'mydb';
        private $username = 'mydb_admin';
        private $password = 'Qwerty12';
        private $allowed_field;
        function __construct(){
            parent::__construct($this->host, $this->username, $this->password, $this->dbname);
            $this->allowed_field = ['username', 'email', 'password'];
            // $this->execute_query('PRAGMA foreign_keys = ON;');
            $this->query('CREATE TABLE IF NOT EXISTS users (
                                            id INT AUTO_INCREMENT PRIMARY KEY,
                                            username VARCHAR(50) NOT NULL UNIQUE,
                                            email VARCHAR(100) NOT NULL UNIQUE,
                                            password VARCHAR(255) NOT NULL,
                                            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);'); 
            if ($this->connect_error) {
                die('Ошибка подключения (' . $this->connect_errno . ') ' . $this->connect_error);
            }
        }
        //      $this->db_open(conn);
        //      $this->exec("PRAGMA foreign_keys = ON;");
        //      $this->exec("CREATE TABLE IF NOT EXISTS printer(printer_id INTEGER PRIMARY KEY AUTOINCREMENT,
        //                             printer_name TEXT);
        //                         CREATE TABLE IF NOT EXISTS user(user_id INTEGER PRIMARY KEY AUTOINCREMENT,
        //                             user_rank VARCHAR(30),
        //                             user_name TEXT,
        //                             post TEXT,
        //                             location TEXT,
        //                             chief_id INTEGER,
        //                             FOREIGN KEY (chief_id) REFERENCES chief (chief_id) ON DELETE SET NULL);"); 
        //     $this->allowed_field = ['user_id', 'user_rank', 'user_name', 'post', 'location', 'chief_id', 'printer_id', 'printer_name'];
        //     // $this->exec("CREATE TRIGGER IF NOT EXISTS member_updated_at AFTER UPDATE on `user`
        //     // BEGIN
        //     //     UPDATE `user` SET `updated_at` = CURRENT_TIMESTAMP where ID = ID;
        //     // END
        //     // ");
        // }
        function __destruct(){
            $this->close();
        }
        function sanitize_string($string = ""){
            if(!is_numeric($string)){
                $string = addslashes($this->real_escape_string($string));
            }
            return $string;
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
                    if(in_array($k, $this->allowed_field) && $k != "id"){
                        $v = $this->sanitize_string($v);
                        if(!empty($fields)) $fields .= ", ";
                        $fields .= "`{$k}`";
                        if(!empty($values)) $values .= ", ";
                        $values .= "'{$v}'";                        
                    }
                }
                if(empty($fields))
                return ['status' => 'failed', "error" => "Given data fields are not allowed"];
                
                $sql = "INSERT INTO `users` ({$fields}) VALUES ({$values})";
                $save = $this->query($sql);
                if($save){
                    return ['status' => 'success'];
                }else{
                    return ['status' => 'failed', "error" => $this->error];
                }
            }
        }

        // public function get_results(){
        //     $sql = "SELECT *,`boss_name` FROM `user` INNER JOIN (SELECT chief.chief_id AS `chief_id`,`user_name` AS `boss_name` FROM `user`,`chief`
        //                                 WHERE user.user_id = chief.user_id) `boss` USING(`chief_id`) order by `user_id` asc";
        //     $query = $this->query($sql);
        //     $data = [];
        //     while($row = $query->fetchArray()){
        //         $data[] = $row;
        //     }
        //     return ['num_rows' => count($data), 'data' => $data];
        // }
        public function get_single_by_id($id){
            $id = $this->sanitize_string($id);
            $sql = "SELECT * FROM `users`  where `id` = '{$id}'";
            $query = $this->query($sql);
            return $query->fetch_array();
        }

        public function update($data=[]){
            if(!is_array($data)){
                return ['status' => 'failed', "error" => "Data must be an array."];
            }else{
                if(count($data) <= 0)
                return ['status' => 'failed', "error" => "Data is empty"];

                $update_data = "";
                foreach($data as $k => $v){
                    if(in_array($k, $this->allowed_field) && $k != "id" && $k != "boss_name"){
                        $v = $this->sanitize_string($v);
                        if(!empty($update_data)) $update_data .= ", ";
                        $update_data .= "`{$k}`= '{$v}'";
                    }
                }
                if(empty($update_data))
                return ['status' => 'failed', "error" => "Given data fields are not allowed"];
                $id = $this->sanitize_string($data['id']);
                $sql = "UPDATE `users` SET {$update_data} WHERE `id` = '{$id}'";
                $save = $this->query($sql);
                if($save){
                    return ['status' => 'success'];
                }else{
                    return ['status' => 'failed', "error" => $this->error];
                }
            }
        }
        public function delete($id=""){
            if(empty($id))
            return ['status' => 'failed', "error" => "ID is required."];
            if(!is_numeric($id))
            return ['status' => 'failed', "error" => "ID cannot be a string."];
            $sql = "DELETE FROM `users` where `id` = '{$id}'";
            $delete = $this->query($sql);
            if($delete){
                return ['status' => 'success'];
            }else{
                return ['status' => 'failed', "error" => $this->error];
            }
            
        }
    }

    // $db = new Database();

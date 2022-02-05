<?php

    include_once "Session.php";
    include "Database.php";

    class User{
        public $db;

        public function __construct(){
            $this->db = new Database();
        }

        // Register for new user 
        public function userRegister($data){
            $name         = $data["name"];
            $username     = $data["username"];
            $email        = $data["email"];
            $password     = $data["password"];
            $username_chk = $this->checkUsername($username);
            $email_chk    = $this->checkEmail($email);

            if($name == "" || $username == "" || $email == "" || $password == "" ){
                $msg = "<div class='alert alert-danger' role='alert'>
                        <strong>Error! </strong>Field must not be empty!
                        </div>";
                return $msg;
            }
            
            if($username_chk == true){
                $msg = "<div class='alert alert-danger' role='alert'>
                        <strong>Error! </strong>The username is already Exist!</div>";
                return $msg;
            }elseif(preg_match("/[^a-z0-9_-]+/i", $username)){
                $msg = "<div class='alert alert-danger' role='alert'>
                        <strong>Error! </strong>Username must only content alphanmerical, dashes and underscors!</div>";
                return $msg;
            }
            elseif(strlen($username) < 4){
                $msg = "<div class='alert alert-danger' role='alert'>
                        <strong>Error! </strong>Username is too short, must be gatter the 6 digit!</div>";
                return $msg;
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $msg = "<div class='alert alert-danger' role='alert'>
                        <strong>Error! </strong>The email address is not Valid!</div>";
                return $msg;
            }elseif($email_chk == true){
                $msg = "<div class='alert alert-danger' role='alert'>
                        <strong>Error! </strong>The email address is already Exist!</div>";
                return $msg;
            }

            $sql = "INSERT INTO tbl_user(name, username, email, password) VALUES(:name, :username, :email, :password)";
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':name', $name);
            $query->bindValue(':username', $username);
            $query->bindValue(':email', $email);
            $query->bindValue(':password', md5($password));
            $result = $query->execute();
            if($result){
                $msg = "<div class='alert alert-success' role='alert'>
                        <strong>Success! </strong>Thank you, Register Successfylly!
                        </div>";
                return $msg;
            }else{
                $msg = "<div class='alert alert-danger' role='alert'>
                <strong>Error! </strong>There have been a problem!</div>";
                return $msg;
            }
        }
                
        // get user login
        public function getUserLogin($email, $password){
            $sql = "SELECT * FROM tbl_user WHERE email=:email AND password=:password LIMIT 1";
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':email', $email);
            $query->bindValue(':password', $password);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result;
        }

        // Login for exits user 
        public function userLogin($data){
            $email        = $data["email"];
            $password     = md5($data["password"]);
            $email_chk    = $this->checkEmail($email);
            $status_chk    = $this->checkStatus($email);

            if($email == "" || $password == "" ){
                $msg = "<div class='alert alert-danger' role='alert'>
                        <strong>Error! </strong>Field must not be empty!
                        </div>";
                return $msg;
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $msg = "<div class='alert alert-danger' role='alert'>
                        <strong>Error! </strong>The email address is not Valid!</div>";
                return $msg;
            }elseif($email_chk == false){
                $msg = "<div class='alert alert-danger' role='alert'>
                        <strong>Error! </strong>The email address is not Exist!</div>";
                return $msg;
            }

            if($status_chk == false){
                $msg = "<div class='alert alert-danger' role='alert'>
                        <strong>Error! </strong>You are not approved yet!</div>";
                return $msg;
            }

            $result = $this->getUserLogin($email, $password);
            if($result){
                Session::init();
                Session::set("login", true);
                Session::set("id", $result->id);
                Session::set("name", $result->name);
                Session::set("username", $result->username);
                Session::set("role", $result->role);
                Session::set("status", $result->status);
                Session::set("loginmsg", "<div class='alert alert-success' role='alert'> <strong>Success! </strong>Welcome! You are LoggedIn!</div>");
                header("Location:index.php");
            }else{
                $msg = "<div class='alert alert-danger' role='alert'>
                        <strong>Error! </strong>Sorry!, User data not found!</div>";
                return $msg;
            }
        }

              // Register for new user 
            public function updateUserProfile($id, $data){
            $name         = $data["name"];
            $username     = $data["username"];
            $email        = $data["email"];
            $username_chk = $this->checkUsername($username);

            if($name == "" || $username == "" || $email == ""){
                $msg = "<div class='alert alert-danger' role='alert'>
                        <strong>Error! </strong>Field must not be empty!
                        </div>";
                return $msg;
            }
            
            if(preg_match("/[^a-z0-9_-]+/i", $username)){
                $msg = "<div class='alert alert-danger' role='alert'>
                        <strong>Error! </strong>Username must only content alphanmerical, dashes and underscors!</div>";
                return $msg;
            }
            elseif(strlen($username) < 4){
                $msg = "<div class='alert alert-danger' role='alert'>
                        <strong>Error! </strong>Username is too short, must be gatter the 6 digit!</div>";
                return $msg;
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $msg = "<div class='alert alert-danger' role='alert'>
                        <strong>Error! </strong>The email address is not Valid!</div>";
                return $msg;
            }

            $sql = "UPDATE tbl_user SET name=:name, username=:username,email=:email WHERE id=:id";
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':name', $name);
            $query->bindValue(':username', $username);
            $query->bindValue(':email', $email);
            $query->bindValue(':id', $id);
            $result = $query->execute();
            if($result){
                $msg = "<div class='alert alert-success' role='alert'>
                        <strong>Success! </strong>Thank you, Profile Update Successfylly!
                        </div>";
                return $msg;
            }else{
                $msg = "<div class='alert alert-danger' role='alert'>
                <strong>Error! </strong>There have been a problem!</div>";
                return $msg;
            }
        }

              // ---------------------Change user password --------------------
              public function updateUserPass($id, $data){
                $old_pass = md5($data['old_pass']);
                $new_pass = $data['password'];
                $password_chk = $this->checkPassword($id, $old_pass);
    
                if($old_pass == "" OR ($new_pass == "" AND empty($new_pass))){
                    $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be Empty</div>";
                    return $msg;
                }
                if($password_chk == false){
                    $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Old password not Match</div>";
                    return $msg;
                }
                if(strlen($new_pass) < 6){
                    $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Password must be gater then 6 digit.</div>";
                    return $msg;
                }
    
                $sql = "UPDATE tbl_user SET password = :password WHERE id =:id ";
                $query = $this->db->pdo->prepare($sql);
                $query->bindValue(':password', md5($new_pass));
                $query->bindValue(':id', $id);
                $result = $query->execute();
                if($result){
                    $msg = "<div class='alert alert-success'><strong>Success ! </strong>Password changed successfully.</div>";
                    return $msg;
                }else{
                    $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Sorry, Password not changed!</div>";
                    return $msg;
                }
    
            }
            
        public function changeRoleStatus($id, $data){
            $role = $data["role"];
            $status = $data["status"];
            $sql = "UPDATE tbl_user SET role=:role, status=:status WHERE id=:id";
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(":role", $role);
            $query->bindValue(":status", $status);
            $query->bindValue(":id", $id);
            $result = $query->execute();
            if($result){
                $msg = "<div class='alert alert-success' role='alert'>
                        <strong>Success! </strong>User type Updated Success!</div>";
                return $msg;
            }
        }

        public function readAllUser(){
            $sql = "SELECT * FROM tbl_user ORDER BY id DESC";
            $query = $this->db->pdo->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
            return $result;
        }

        public function getUserById($id){
            $sql = "SELECT * FROM tbl_user WHERE id=:id";
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result;
        }

        // checking existing username
        public function checkUsername($username){
            $sql = "SELECT username FROM tbl_user WHERE username =:username";
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':username', $username);
            $query->execute();
            $result = $query->rowCount();
            if($result > 0){
               return true;
            }else{
                return false;
            }
        }

        // checking existing email address 
        public function checkEmail($email){
            $sql = "SELECT email FROM tbl_user WHERE email =:email";
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':email', $email);
            $query->execute();
            $result = $query->rowCount();
            if($result > 0){
               return true;
            }else{
                return false;
            }
        }

        // checking password
        public function checkPassword($id, $password){
            $sql = "SELECT email FROM tbl_user WHERE password=:password AND id=:id";
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':password', $password);
            $query->bindValue(':id', $id);
            $query->execute();
            $result = $query->rowCount();
            if($result > 0){
                return true;
            }else{
                return false;
            }
        }

        // checking password
        public function checkStatus($email){
            $sql = "SELECT email FROM tbl_user WHERE email=:email AND status=:status";
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':email', $email);
            $query->bindValue(':status', true);
            $query->execute();
            $result = $query->rowCount();
            if($result > 0){
               return true;
            }else{
                return false;
            }
        }
    }
?>
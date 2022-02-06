<?php
    class Database{
        private $dbhost = "localhost";
        private $dbname = "db_admin";
        private $dbuser = "root";
        private $dbpass = "";
        public $pdo;

        public function __construct(){
            if(!isset($this->pdo)){
                try{
                    $link = new PDO("mysql:host=".$this->dbhost."; dbname=".$this->dbname, $this->dbuser, $this->dbpass);
                }catch(PDOExecption $e){
                    die("Connection Faild!".$e->getMessage());
                }
                $this->pdo = $link;
            }
        }
    }
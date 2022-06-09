<?php

class DatabaseConnection{

    function connect(){
        try{
            $dsn = "mysql:host=localhost:3307;dbname=student_training_db";
            $user = "root";
            $password = "000";
            $pdo = new PDO($dsn , $user , $password);
            return $pdo; 
        }catch(PDOException $exception){
            echo $exception->getMessage();
        }
    }
}

?>
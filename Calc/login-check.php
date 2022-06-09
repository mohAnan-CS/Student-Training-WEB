<?php

include '../parts/_db.php';

$username = $_POST['username'];
$password = $_POST['password'];

if (isset($username , $password)){
    $connection = new DatabaseConnection;
    $conn = $connection->connect();
    $sql = "SELECT id, username, password , displayname , lasthit , usertype FROM user";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            if ($row['username'] == $username && $row['password']){
                try{
                    header("Location : http://".$_SERVER['HTTP_HOST']."/home.php");
                    exit;
                    break;
                }catch(Exception $e){
                    echo $e;
                }
            }
        }
    }else{
    }
    $conn->close();
}
?>
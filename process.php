<?php
include_once 'model.php';
//if post request com from edit student page 
if (isset($_POST["edit-student"])){
    $obj = new Model ; 
    if (session_status() === PHP_SESSION_NONE) { session_start(); }
    if(isset($_SESSION['idedit'])){
        $photo_path ;
        if ($_POST['student-photo'] == ""){
            $photo_path = $_SESSION['image-student'];
        }
        else{
            $photo_path = "images/student/".$_POST['student-photo'];
        }
        $cityid = $obj->getCityId($_POST['city']);
        $obj->updateUserInformation( $_SESSION['idedit'], 
        $photo_path , 
        $_POST['name-student'], 
        $cityid, 
        $_POST['email'], 
        $_POST['tel'] , 
        $_POST['university-student'] , 
        $_POST['major-student'] , 
        $_POST['projects-student'], 
        $_POST['interests-student']);
        header("location:students.php");
    }else{
        header("location:students.php");
    }
}//end if edit student post request

?>
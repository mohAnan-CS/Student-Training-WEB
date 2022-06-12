<?php
include_once 'model.php';
//if post request com from edit student page 
if (isset($_POST["edit-student"])){
    $obj = new Model ; 
    echo print_r($_POST);
    echo $_POST['email'];
    echo "phot".$_FILES['studentPhoto']['name'];
    if (session_status() === PHP_SESSION_NONE) { session_start(); }
    if(isset($_SESSION['idedit'])){
        
            $check = getimagesize($_FILES["studentPhoto"]["tmp_name"]);
            if($check !== false) {
                $file = $_FILES['studentPhoto'];
                copy($file['tmp_name'] , "images/student/".$file['name']);
                $name = $_FILES['studentPhoto']['name'];
                $photo = "images/student/".$name;
                $cityid = $obj->getCityId($_POST['city']);
                echo "<br>Sessio id = ".$_SESSION['idedit'];
                $obj->updateUserInformation( $_SESSION['idedit'], 
                $photo, 
                $_POST['name-student'], 
                $cityid, 
                $_POST['email'], 
                $_POST['tel'] , 
                $_POST['university-student'] , 
                $_POST['major-student'] , 
                $_POST['projects-student'], 
                $_POST['interests-student']);
                header("location:students.php");
    }
    }else{
        //header("location:students.php");
    }

}//end if edit student post request

if (isset($_POST['add-student'])){
    $city = filter_input(INPUT_POST , 'city' ,FILTER_SANITIZE_STRING);
    session_start();
    $userid =  $_SESSION['userid'];
    
    // Check if image file is a actual image or fake image
    $file = $_FILES['photo'];
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check !== false) {
        $file = $_FILES['photo'];
        copy($file['tmp_name'] , "images/student/".$file['name']);
        $name = $_FILES['photo']['name'];
        $photo = "images/student/".$name;
        $object_model = new Model;
        $stm = $object_model->getCitys();
        $object_model = new Model;
        $cityid = $object_model->getCityId($city);
        $object_model->addStudent($_POST['name-student'] ,
        $cityid ,
        $_POST['email'] ,
        $_POST['tel'] , 
        $_POST['university-student'] ,
        $_POST['major-student'] , 
        $_POST['projects-student'] , 
        $_POST['interests-student'] ,
        $photo , 
        $userid );
        header("location:students.php");
    } else {
        header("location:students.php");
    }
}

?>
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
            // $target_dir = "images/student/";
            // $target_file = $target_dir . basename($_FILES["photo-student"]["name"]);
            // $uploadOk = 1;
            // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // // Check if image file is a actual image or fake image
            // $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            // if($check !== false) {
            //     echo "File is an image - " . $check["mime"] . ".";
            //     $uploadOk = 1;
            // } else {
            //     echo "File is not an image.";
            //     $uploadOk = 0;
            // }
            
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
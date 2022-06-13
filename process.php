<?php
include_once 'model.php';

//if post request com from edit student page 
if (isset($_POST["edit-student"])){
    $obj = new Model ; 
    
    if (session_status() === PHP_SESSION_NONE) { session_start(); }
    if(isset($_SESSION['idedit'])){
        echo $_FILES['studentPhoto']['name'];
        if($_FILES["studentPhoto"]["error"] != 4){
            echo "if statment";
            $check = getimagesize($_FILES["studentPhoto"]["tmp_name"]);
            
            if($check !== false) {
                $file = $_FILES['studentPhoto'];
                copy($file['tmp_name'] , "images/student/".$file['name']);
                $name = $_FILES['studentPhoto']['name'];
                $photo = "images/student/".$name;
                $cityid = $obj->getCityId($_POST['city']);
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
        }else {
            echo "else statement";
            $photo = $_SESSION['image-student'];
            
                $cityid = $obj->getCityId($_POST['city']);
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
        
    }
}//end if edit student post request

//if post request com from edit company page 
if (isset($_POST["edit-company"])){
    $obj = new Model ; 
    echo "phot".$_FILES['studentPhoto']['name'];
    if (session_status() === PHP_SESSION_NONE) { session_start(); }
    if(isset($_SESSION['idedit'])){
        
            $check = getimagesize($_FILES["studentPhoto"]["tmp_name"]);
            if($check !== false) {
                
                $file = $_FILES['studentPhoto'];
                copy($file['tmp_name'] , "images/company/".$file['name']);
                $name = $_FILES['studentPhoto']['name'];
                $photo = "images/company/".$name;
                
                $cityid = $obj->getCityId($_POST['city']);
                $obj->updateCompanyInformation( $_SESSION['idedit'], 
                $photo, 
                $_POST['name-student'], 
                $cityid, 
                $_POST['email'], 
                $_POST['tel'] , 
                $_POST['count'] , 
                $_POST['position-details'] );
                header("location:companies.php");
    }
    }else{
        header("location:companies.php");
    }
    

}//end if edit company post request

// if statement for add student post
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

//if statement for add company post
if (isset($_POST['add-company'])){
    $city = filter_input(INPUT_POST , 'city' ,FILTER_SANITIZE_STRING);
    session_start();
    $userid =  $_SESSION['userid'];
    
    // Check if image file is a actual image or fake image
    $file = $_FILES['photo'];
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check !== false) {
        
    
        copy($file['tmp_name'] , "images/company/".$file['name']);
        $name = $_FILES['photo']['name'];
        
        $photo = "images/company/".$name;
        echo $photo;
        $object_model = new Model;
        $stm = $object_model->getCitys();
        $object_model = new Model;
        $cityid = $object_model->getCityId($city);
        
        
        $object_model->addCompany($_POST['name-company'] ,
        $cityid ,
        $_POST['email-company'] ,
        $_POST['tel-company'] , 
        $_POST['count'] ,
        $_POST['position-details'] , 
        $photo , 
        $userid );
        header("location:companies.php");
    } else {
        header("location:companies.php");
    }
}

?>
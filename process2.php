<?php

include_once 'model.php'; 

// if statement to check if get request accept from student
if ( isset($_GET['accept']) ){
    echo "accept";
    $studentid = $_GET['studentid'];
    $companyid = $_GET['companyid'];
    $status = "accept";
    $model_obj = new Model;
    $model_obj->updateStatus($status , $studentid , $companyid);
    session_start();
    header("location:student.php?id=".$_SESSION['userid']);
    // else if statement to check if get request reject from student
}else if ( isset($_GET['reject'])){
    echo $_GET['reject'];
    echo "<br>";
    echo "studentid = ".$_GET['studentid'];
    echo "<br>";
    echo "companyid = ".$_GET['companyid'];

    $studentid = $_GET['studentid'];
    $companyid = $_GET['companyid'];
    $status = "reject";
    $model_obj = new Model;
    $user_student_id = $model_obj->getUserId("student",$studentid);
    $model_obj->updateStatus($status , $studentid , $companyid);
    session_start();
    header("location:student.php?id=".$user_student_id);
}

// if statement to check if get request offer training from company
if (isset($_GET['offer'])){
    session_start();
    $studentid = $_GET['studentid'];
    //echo $studentid ;
    $companyid = $_GET['companyid'];
    echo $companyid;
    //echo $userid;
    $model_obj = new Model;
    $user_student_id = $model_obj->getUserId("student",$studentid);
    echo $studentid ;
    $userid = $model_obj->getUserId("student" , $studentid);
    echo $userid ;
    $model_obj->offerTraining($studentid, $companyid , $userid);
    header("location:student.php?id=".$user_student_id);
}
?>
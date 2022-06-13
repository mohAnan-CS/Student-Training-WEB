<?php
    include_once 'parts/_db.php';

    class Model{

        public function getStudentsRecord(){
            $object_db = new DatabaseConnection;
            $conn = $object_db->connect();
            $query = "SELECT id , name , cityid , email , tel , university , major 
            , projects , interests , photopath , userid FROM student";
            $statement = $conn->prepare($query);
            $statement->execute();
            return $statement ; 
        }//end gitStudentsRecord function

        public function getCity($cityid){
            $object_db = new DatabaseConnection;
            $conn = $object_db->connect();
            $query = "SELECT id , name , country FROM city WHERE id=".$cityid;
            $statement = $conn->prepare($query);
            $statement->execute();
            $count = $statement->rowCount();
            $city = "";
            if ($count == 1){
                while($row=$statement->fetch(PDO::FETCH_NUM)){
                    $city = $row[2];
                }
                return $city;
            }
            else{
                $city = "No City";
                return $city;
            }
            
        }//end getCity function

        public function getCitys(){
            $object_db = new DatabaseConnection;
            $conn = $object_db->connect();
            $query = "SELECT * FROM city ";
            $statement = $conn->prepare($query);
            $statement->execute();
            return $statement ;
        }//end getCitys function

        public function checkLogin($username , $password){
            $object_db = new DatabaseConnection;
            $conn = $object_db->connect();
            $query = "SELECT id , username , password 
                    , displayname , lasthit , usertype FROM user 
                    WHERE username = '".$username."' AND password ='".$password."'";
            $statement = $conn->prepare($query);
            $statement->execute();
            $count = $statement->rowCount();
            $displayname = $username = $usertype = "";
            $userid = 0;
            $is_login = 1;
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if ($count > 0){
                while($row=$statement->fetch(PDO::FETCH_NUM)){
                    $username=$row[1];
                    $displayname=$row[3];
                    $userid=$row[0];
                    $usertype = $row[5];
                }
                $_SESSION['username'] = $username;
                $_SESSION['displayname'] = $displayname;
                $_SESSION['userid'] = $userid;
                $_SESSION['is_login'] = $is_login;
                $_SESSION['usertype'] = $usertype ;
                header("location:index.php");
            }else{
                //Wrong info
            }                 
        }//end check login function

        public function getStudentRecord($id){
            $object_db = new DatabaseConnection;
            $conn = $object_db->connect();
            $query = "SELECT id , name , cityid , email , tel , university , major 
            , projects , interests , photopath , userid FROM student WHERE userid ='".$id."'";
            $statement = $conn->prepare($query);
            $statement->execute();
            $count = $statement->rowCount();
            $data = array();
            if ($count = 1){
                while($row=$statement->fetch(PDO::FETCH_NUM)){
                    $data[] = $row;
                }
            }

            return $data ; 
        }//end getStudentRecord function

        public function getUserId($usertype , $userid){

            if (isset($usertype) && $usertype=="company"){

            }else if (isset($usertype) && $usertype=="student"){

            }else{
                
            }
        }//end getUserId function

        public function searchStudents($major , $city){

            $object_db = new DatabaseConnection;
            $conn = $object_db->connect();
            $model_obj = new Model;
            $cityid = $model_obj->getCityId($city);

            if ($major != "" && $city == "Select City"){
                //city empty
                $query = "SELECT * FROM student WHERE major LIKE '%$major%'";
                $statement = $conn->prepare($query);
                $statement->execute();
                return $statement ; 
            }
            else if ($city != "Select City" && $major == ""){
                // major empty
                $query = "SELECT * FROM student WHERE cityid =$cityid";
                $statement = $conn->prepare($query);
                $statement->execute();
                return $statement ; 
            }
            else if($city != "Select City" && $major != ""){
                // city and major
                $query = "SELECT * FROM student WHERE major LIKE '%$major%' AND cityid =$cityid";
                $statement = $conn->prepare($query);
                $statement->execute();
                return $statement ; 
            }
            else {
                return 0 ;
            }
            
        }

        public function getCityId($city){
            $object_db = new DatabaseConnection;
            $conn = $object_db->connect();
            $query = "SELECT * FROM city WHERE country = '".$city."'";
            $statement = $conn->prepare($query);
            $statement->execute();
            $count = $statement->rowCount();
            if ($count > 0){
                $cityid = 0 ;
                while($row=$statement->fetch(PDO::FETCH_NUM)){
                    $cityid = $row[0];
                }
                return $cityid ; 
            }else{
            }
        }

        public function updateUserInformation($id,$photo , $name , $city ,$email , $tel , $university ,$major , $projects , $intrests ){
            $object_db = new DatabaseConnection;
            $conn = $object_db->connect();
            $obj = new Model;
            echo $id ;
            $query = "UPDATE `student` SET `name`='$name' , `cityid` = '$city' , `email`='$email' , `tel`= '$tel' , `university`='$university' , `major` = '$major' 
            , `projects`='$projects' , `interests` = '$intrests' , `photopath`='$photo' WHERE `student`.`userid` = $id";
            $statement = $conn->prepare($query);
            $statement->execute();
            
        }

        public function getStudentRecord1($id){
            $object_db = new DatabaseConnection;
            $conn = $object_db->connect();
            $query = "SELECT id , name , cityid , email , tel , university , major 
            , projects , interests , photopath , userid FROM student WHERE userid ='".$id."'";
            $statement = $conn->prepare($query);
            $statement->execute();
            return $statement ; 
        }//end getStudentRecord function

        public function getCompaniesRecord(){
                $object_db = new DatabaseConnection;
                $conn = $object_db->connect();
                $query = "SELECT * FROM company";
                $statement = $conn->prepare($query);
                $statement->execute();
                return $statement ;
        }

        public function searchCompanies($name , $city){

            $object_db = new DatabaseConnection;
            $conn = $object_db->connect();
            $model_obj = new Model;
            $cityid = $model_obj->getCityId($city);

            if ($name != "" && $city == "Select City"){
                //city empty
                $query = "SELECT * FROM company WHERE name LIKE '%$name%'";
                $statement = $conn->prepare($query);
                $statement->execute();
                return $statement ; 
            }
            else if ($city != "Select City" && $name == ""){
                // major empty
                $query = "SELECT * FROM company WHERE cityid =$cityid";
                $statement = $conn->prepare($query);
                $statement->execute();
                return $statement ; 
            }
            else if($city != "Select City" && $name != ""){
                // city and major
                $query = "SELECT * FROM company WHERE name LIKE '%$name%' AND cityid =$cityid";
                $statement = $conn->prepare($query);
                $statement->execute();
                return $statement ; 
            }
            else {
                return 0 ;
            }
            
        }

        public function getAllCompany($userid){
                $object_db = new DatabaseConnection;
                $conn = $object_db->connect();
                $query = "SELECT * FROM company WHERE userid='$userid'";
                $statement = $conn->prepare($query);
                $statement->execute();
                return $statement ;
        }

        public function getAllStudent($userid){
            $object_db = new DatabaseConnection;
            $conn = $object_db->connect();
            $query = "SELECT * FROM student WHERE userid='$userid'";
            $statement = $conn->prepare($query);
            $statement->execute();
            return $statement ;
        }

        public function getCompanyRecord1($id){
            $object_db = new DatabaseConnection;
            $conn = $object_db->connect();
            $query = "SELECT * FROM company WHERE userid ='".$id."'";
            $statement = $conn->prepare($query);
            $statement->execute();
            return $statement ; 
        }

        public function addStudent($name , $cityid  ,$email , $tel , $university ,$major , $projects , $intrests , $photo , $userid){
            $object_db = new DatabaseConnection;
            $conn = $object_db->connect();
            $query = "INSERT INTO student (id , name , cityid , email , tel , university , major , projects , interests , photopath , userid)
            VALUES ('NULL' , '$name' , '$cityid' , '$email' , '$tel' , '$university' , '$major' , '$projects' , '$intrests' , '$photo' , '$userid')";
            $statement = $conn->prepare($query);
            $statement->execute();
        }

        public function addCompany($name , $cityid  ,$email , $tel , $count ,$details , $logo , $userid){
            $object_db = new DatabaseConnection;
            $conn = $object_db->connect();
            $query = "INSERT INTO company (id , name , cityid , email , tel , positioncount , positiondetails , logopath , userid)
            VALUES ('NULL' , '$name' , '$cityid' , '$email' , '$tel' , '$count' , '$details' , '$logo' , '$userid')";
            $statement = $conn->prepare($query);
            $statement->execute();
        }

        public function getCompanyRecord($id){
            $object_db = new DatabaseConnection;
            $conn = $object_db->connect();
            $query = "SELECT id , name , cityid , email , tel , positioncount , positiondetails 
            , logopath , userid FROM company WHERE userid ='".$id."'";
            $statement = $conn->prepare($query);
            $statement->execute();
            $count = $statement->rowCount();
            $data = array();
            if ($count = 1){
                while($row=$statement->fetch(PDO::FETCH_NUM)){
                    $data[] = $row;
                }
            }

            return $data ; 
        }//end getCompanyRecord function

        public function updateCompanyInformation($id,$photo , $name , $city ,$email , $tel , $count ,$details ){
            
            $object_db = new DatabaseConnection;
            $conn = $object_db->connect();
            $obj = new Model;
            echo $id ;
            $query = "UPDATE `company` SET `name`='$name' , `cityid` = '$city' , `email`='$email' , `tel`= '$tel' , `positioncount`='$count' , `positiondetails` = '$details' 
            , `logopath`='$photo' WHERE `company`.`userid` = $id";
            $statement = $conn->prepare($query);
            $statement->execute();
            
        }

        public function getOffers($id){
            $object_db = new DatabaseConnection;
            $conn = $object_db->connect();
            $query = "SELECT  * FROM `students_applications` WHERE $id = students_applications.studentid";
            $statement = $conn->prepare($query);
            $statement->execute();
            return $statement ; 
        }

        public function getStudentId($userid){
            $object_db = new DatabaseConnection;
            $conn = $object_db->connect();
            $query = "SELECT * FROM student WHERE userid = ".$userid;
            $statement = $conn->prepare($query);
            $statement->execute();
            $count = $statement->rowCount();
            if ($count > 0){
                $userid = 0 ;
                while($row=$statement->fetch(PDO::FETCH_NUM)){
                    $userid = $row[0];
                }
                return $userid ; 
            }else{
            }
        }

        public function getCompanyName($id){
            $object_db = new DatabaseConnection;
            $conn = $object_db->connect();
            $query = "SELECT * FROM company WHERE id = ".$id;
            $statement = $conn->prepare($query);
            $statement->execute();
            $city_name = "";
            $count = $statement->rowCount();
            if ($count > 0){
                while($row=$statement->fetch(PDO::FETCH_NUM)){
                    $city_name = $row[1];
                }
                return $city_name ; 
            }else{
            }
        }
    }

?>
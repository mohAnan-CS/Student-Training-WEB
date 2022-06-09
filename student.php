<?php include "parts/_header.php" ?>
<?php include_once 'parts/_db.php'; ?>
<main>
    <?php
        if(isset($_GET['id'])){
            $userid = $_GET['id'];
            $object_db = new DatabaseConnection;
            $conn = $object_db->connect();
            $query = "SELECT id , name , cityid , email , tel , university , major 
            , projects , interests , photopath , userid FROM student WHERE userid =1";
            $statement = $conn->prepare($query);
            $statement->execute();
            $count = $statement->rowCount();
            if ($count > 0){
                while($row=$statement->fetch(PDO::FETCH_NUM)){
                    echo "<h2>$row[1]</h2>";
                    echo "<img class='description-img' id='description-student-img' src='images/company.png' alt='company logo' />";
                    echo "<dl class='decription' id='description-student'>";
                    echo "<dt>City:</dt>";
                    echo "<dd>Jeruselem</dd>";
                    echo "<dt>Email:</dt>";
                    echo "<dd><a href='mailto:$row[3]'>$row[3]</a></dd>";
                    echo "<dt>Tel:</dt>";
                    echo "<dd><a href='tel:+$row[4]'>+970595693999</a></dd>";
                    echo "<dt>Major:</dt>";
                    echo "<dd>$row[6]</dd>";
                    echo "<dt>Projects:</dt>";
                    echo "<dd>$row[7]</dd>";
                    echo "<dt>Intrests:</dt>";
                    echo "<dd>$row[8]</dd>";
                    echo "</dl>";
                }
            }
        }
    ?>
    <p class="back-edit-link">
        <a  href="students.php" >Back to Students List</a> <span>|</span> <a href="add-student.php" >Edit</a>
    </p>  
    <aside>
        <h2>Similar Students</h2>
        <p>
            A student or 2 students with same major
        </p>
    </aside>
</main>

<?php include "parts/_footer.php" ?>


<?php include "parts/_header.php" ?>
<?php include_once 'model.php'; ?>
<main>
    <?php 
    if (isset($_POST["file"]))
    {
        if($_POST["file"] == "")
        {
            $file = "default-avatar.jpeg";
            echo "No<br>";
        }
        else
        {
            $file = addslashes($_POST["file"]); 
            echo "Yes<br>";  
        }
    }
    ?>

    <?php
        if(isset($_GET['id'])){
            $userid = $_GET['id'];
            $model_obj = new Model;
            $statement = $model_obj->getStudentRecord1($userid);
            $count = $statement->rowCount();
            if ($count > 0){
                while($row=$statement->fetch(PDO::FETCH_NUM)){
                    $city = $model_obj->getCity($row[2]);
                    ?>
                    <h2><?php echo $row[1] ?></h2>
                    <img class='description-img' id='description-student-img' src='<?php echo $row[9]?>' alt='student image'/>
                    <dl class='decription' id='description-student'>
                        <dt>City:</dt>
                        <dd><?php echo $city ?></dd>
                        <dt>Email:</dt>
                        <dd><a href='mailto:<?php echo $row[3] ?>'><?php echo $row[3] ?></a></dd>
                        <dt>Tel:</dt>
                        <dd><a href='tel:+<?php echo $row[4] ?>'><?php echo $row[4] ?></a></dd>
                        <dt>Major:</dt>
                        <dd><?php echo $row[6] ?></dd>
                        <dt>Projects:</dt>
                        <dd><?php echo $row[7] ?></dd>
                        <dt>Intrests:</dt>
                        <dd><?php echo $row[8]?></dd>
                    </dl>
        <?php }}} ?>
        <?php if ($_SESSION['userid'] == $_GET['id']){ ?>
        <p class="back-edit-link">
            <a  href="students.php" >Back to Students List</a> <span>|</span> <a href="add-student.php?is_edit=0&id=<?php echo $_GET['id'] ?>">Edit</a>
        </p>
        <?php } else { ?>
        <p class="back-edit-link">
            <a href="students.php" >Back to Students List</a>
        </p>
        <?php } ?>      
    <aside>
        <h2>Similar Students</h2>
        <p>
            A student or 2 students with same major
        </p>
    </aside>
</main>
<?php include "parts/_footer.php" ?>

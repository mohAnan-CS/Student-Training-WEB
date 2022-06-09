<?php include "parts/_header.php" ?>
<?php include_once 'parts/_db.php'; ?>
<main>
    <h2>Students List</h2>
    <form class="student-list-form"action="?" method="get">
        <div>
            <label>Student Study Major:</label>
            <input class="text-field-major" type="text" name="major"/>
            <label>City:</label>
            <select name="city">
                <option>Select City</option>
                <?php
                    $object_db = new DatabaseConnection;
                    $conn = $object_db->connect();
                    $query = "SELECT id , name , country FROM city";
                    $statement = $conn->prepare($query);
                    $statement->execute();
                    $count = $statement->rowCount();
                    if ($count > 0){
                        while($row=$statement->fetch(PDO::FETCH_NUM)){
                            echo "<option>$row[2]</option>";
                        }
                    }
                ?>
            </select>
            <input class="btn-search" type="submit" value="Search" name="search"/>
        </div>
    </form>
    <table class="table-data">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>City</th>
                <th>University</th>
                <th>Major</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if (!isset($_GET['search'])){
                $object_db = new DatabaseConnection;
                $conn = $object_db->connect();
                $query = "SELECT id , name , cityid , email , tel , university , major 
                , projects , interests , photopath , userid FROM student";
                $statement = $conn->prepare($query);
                $statement->execute();
                $count = $statement->rowCount();
                if ($count > 0){
                    while($row=$statement->fetch(PDO::FETCH_NUM)){
                        echo "<tr>";
                        echo "<td><img class='student-img' src='images/student.pn' alt='student photo'/></td>";
                        echo "<td><a class='link-table' href='student.php?id=$row[10]' alt='student link information'>$row[1]</a></td>";        
                        echo "<td>Palestine</td>";
                        echo "<td>Birzeit University</td>";
                        echo "<td>Computer Science</td>";
                        echo "</tr>";
                    }
                }
            }else if(isset($_GET['search'])){
                
            }
            ?>
        </tbody>
    </table>
    <a class="add-student-link" href="add-student.php" alt="add student">Add Student</a>
    <aside>
        <h2>Distinguished Students</h2>
        <p>
            Student Ali Ahmad from Birzeit is very special and he is looking for training in Computer Science...
        </p>
    </aside>
</main>
<?php include "parts/_footer.php" ?>


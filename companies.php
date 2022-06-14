<?php include "parts/_header.php" ?>
<?php include_once 'parts/_db.php'; ?>
<?php include_once 'model.php'; ?>
<main>
<?php 
    if (!isset($_SESSION['userid'])){
        header("location:index.php");
    }
    ?>

        <?php
            $model_obj = new Model;
            $model_obj->updateLastHit($_SESSION['userid']);
            ?>

    <h2>Companies List</h2>
    <form class="list-form"action="?" method="get">
        <div>
            <label>Company Name:</label>
            <input class="text-field-major" type="text" name="company-name"/>
            <label>City:</label>
            <select name="city">
                <option>Select City</option>
                <?php
                    $object_model = new Model;
                    $stm = $object_model->getCitys();
                    $count = $stm->rowCount();
                    if ($count > 0){
                        while($row=$stm->fetch(PDO::FETCH_NUM)){
                            echo "<option>$row[2]</option>";
                        }
                    }?>
            </select>
            <input class="btn-search" type="submit" value="Search" name="search-company"/>
        </div>
    </form>
    <table class="table-data">
        <thead>
            <tr>
                <th>Logo</th>
                <th>Name</th>
                <th>City</th>
                <th>Open Posisition</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(!isset($_GET['search-company'])){
                $model_obj = new Model;
                $statement = $model_obj->getCompaniesRecord();
                $count = $statement->rowCount();
                if ($count > 0){
                    while($row=$statement->fetch(PDO::FETCH_NUM)){
                        $city = $model_obj->getCity($row[2]);?>            
                        <tr>
                            <td><img class='student-img' src='<?php echo $row[7] ?>' alt='company logo'/></td>
                            <td><a class='link-table' href='company.php?id=<?php echo $row[8] ?>' alt='company link information'><?php echo $row[1] ?></a></td>        
                            <td><?php echo $city ?></td>
                            <td><?php echo $row[5] ?></td>
                        </tr>
            <?php } }else {
                echo "<tr>";
                    echo "<td><img class='student-img' src='images/not-found.png' alt='student photo'/></td>";
                    echo "<td>No Company</td>";
                    echo "<td>No Company</td>";
                    echo "<td>No Company</td>";
                echo "</tr>";
            } }         
            else {
                $name = $_GET['company-name'] ;
                $city = $_GET['city'] ;
                $model_obj = new Model;
                $statement = $model_obj->searchCompanies($name , $city);
                if ($statement != 0){
                    $count = $statement->rowCount();
                    if ($count > 0){
                        while($row=$statement->fetch(PDO::FETCH_NUM)){
                            $city = $model_obj->getCity($row[2]);?>
                            <tr>
                                <td><img class='student-img' src='<?php echo $row[7]?>' alt='student photo'/></td>
                                <td><a class='link-table' href='student.php?id=<?php echo $row[8] ?>' alt='student link information'><?php echo $row[1] ?></a></td>        
                                <td><?php echo $city ?></td>
                                <td><?php echo $row[5] ?></td>
                            </tr>
                    <?php } } else{ ?>
                            <tr>
                                <td><img class='student-img' src='images/not-found.png' alt='student photo'/></td>
                                <td>???</td>        
                                <td>???</td>
                                <td>???</td>
                            </tr>
                <?php } } else {echo "<h5>Please enter information</h5>" ;
                $model_obj = new Model;
                $statement = $model_obj->getCompaniesRecord();
                $count = $statement->rowCount();
                if ($count > 0){
                    while($row=$statement->fetch(PDO::FETCH_NUM)){
                        $city = $model_obj->getCity($row[2]); ?>            
                        <tr>
                            <td><img class='student-img' src='<?php echo $row[7]?>' alt='company photo'/></td>
                            <td><a class='link-table' href='company.php?id=<?php echo $row[8] ?>' alt='company link information'><?php echo $row[1] ?></a></td>        
                            <td><?php echo $city ?></td>
                            <td><?php echo $row[5] ?></td>
                        </tr>
            <?php } }
            else {
                echo "<tr>";
                echo "<td><img class='student-img' src='images/not-found.png' alt='student photo'/></td>";
                echo "<td>No Student</td>";
                echo "<td>No Student</td>";
                echo "<td>No Student</td>";
                echo "</tr>";
            } } }?>
        </tbody>
    </table>
    <!-- if statement to check if usertype equal company to access add link or not -->
    <?php 
        $userid = $_SESSION['userid'];
        $obj = new Model;
        $stm = $obj->getCompanyRecord1($userid);
        $counter = $stm->rowCount();
        if ($counter == 1 && $_SESSION['usertype'] == 'company'){ 
    ?>
    <div class="add-link-div">
        <a class="add-student-link" href="add-company.php?is_edit=0&id=<?php echo $_SESSION['userid']?>" >Edit Company</a>
    </div>    
    <?php } else if ($counter == 0 && $_SESSION['usertype'] == 'company'){ ?>
    <div class="add-link-div">
        <a class="add-student-link" href="add-company.php?is_edit=1&id=<?php echo $_SESSION['userid']?>" >Add Company</a>
    </div> 
    <?php } ?>
    <aside class="companies_aside">
        <h2>Distinguished Students</h2>
        <p>
        This will contain a random special company details...
        </p>
    </aside>
</main>
<?php include "parts/_footer.php" ?>


<?php include "parts/_header.php" ?>
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

    <!-- isEdit == 1 -> add page company -->
    <?php if ($_GET['is_edit'] == 1 ){ ?>
    <h2>Add Company</h2>
    <form action="process.php" method="post"  enctype="multipart/form-data">
        <table class="edit-table">
            <tbody>
                <tr>
                    <td>Logo</td>
                    <td><input type="file" id="photo" name="photo" alt="brwose for photo" accept="image/*" required/></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><input class="text-field-major" type="text" name="name-company" alt="insert name" required/></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>
                        <select name="city" required>
                            <option selected disabled>Select City</option>
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
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input class="text-field-major" type="email" name="email-company" alt="insert email"  required/></td>
                </tr>
                <tr>
                    <td>tel</td>
                    <td><input class="text-field-major" type="tel" name="tel-company" alt="insert phone number"  required/></td>
                </tr>
                <tr>
                    <td>Position Count</td>
                    <td><input class="text-field-major" type="tel" name="count" alt="insert position count"  required/></td>
                </tr>
                <tr>
                    <td>Position Details</td>
                    <td><textarea name="position-details" required></textarea></td>
                </tr>
            </tbody>
        </table>
        <div class="add-clear-div">
            <input type="submit"  name= "add-company" value="Add Company"/>
            <input type="reset" value="Clear"/>
        </div>
    </form>
    <!-- end code for add student page -->

    <!-- isEdit == 0 -> edit page -->
    <?php } else if ($_GET['is_edit'] == 0){ ?>
    <h2>Edit Company</h2>
    <form action="process.php" method="post" enctype="multipart/form-data">
        <table class="edit-table">
            <!-- this php code is return all information for the student 
            and retrive his city from database -->
            <?php
            if (session_status() === PHP_SESSION_NONE) { session_start(); } 
            $_SESSION['idedit'] = $_GET['id'];
            $model_obj = new Model ;
            $data = $model_obj->getCompanyRecord($_GET['id']);
            $city = $model_obj->getCity($data[0][2]);
            $_SESSION['image-company'] = $data[0][7];
            ?>
            <tbody>
            <tr>
                    <td>Name</td>
                    <td><input class="text-field-major" value="<?php echo $data[0][1]; ?>" type="text" name="name-student" alt="insert name" required/></td>
                </tr>
                <tr>
                    <td>Personal Photo</td>
                    <td><input type="file" id="studentPhoto" name="studentPhoto" alt="brwose for photo" accept="image/*" required/></td>
                    
                </tr>
            
                <tr>
                    <td>City</td>
                    <td>
                        <select name="city">
                            <option selected disabled>Select City</option>
                        <!-- get all city from datat base , 
                        store it in select and select city for the student -->
                        <?php
                            $obj = new Model ; 
                            $stm = $obj->getCitys();
                            $counts = $stm->rowCount();
                            if ($counts > 0){
                                while($row=$stm->fetch(PDO::FETCH_NUM)){
                                    if ($city == $row[2]){
                                        echo "<option value='$row[2]' selected>$row[2]</option>";
                                    }else{
                                        echo "<option value='$row[2]'>$row[2]</option>";
                                    }
                                }}?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input class="text-field-major" value="<?php echo $data[0][3]; ;?>"type="email" name="email" alt="insert email" name="email-student" required/></td>
                </tr>
                <tr>
                    <td>Tel</td>
                    <td><input class="text-field-major" value="<?php echo $data[0][4]; ?>" type="tel" name="tel" alt="insert phone number" name="tel-student" required/></td>
                </tr>
                <tr>
                    <td>Position Count</td>
                    <td><input class="text-field-major" value="<?php echo $data[0][5]; ?>" type="text" name="count" alt="insert position count" required/></td>
                </tr>
                <tr>
                    <td>Position Details</td>
                    <td><textarea name="position-details" required><?php echo $data[0][6]; ?></textarea></td>
                </tr>
            </tbody>
        </table>
        <div class="add-clear-div">
            <input type="submit" value="Edit Company" name="edit-company"/>
            <input type="reset" value="Clear"/>
        </div>
    </form>
    <?php }  ?>
    <div class="link-div">
        <a class="link" id="cancle-student-link" href="companies.php">Cancle and return to Companies List</a>
    </div>
    
    <aside class="add_company_aside">
        <h2>Help</h2>
        <p>
            Add company and positions details so that students can find you...
        </p>
    </aside>
</main>
<?php include "parts/_footer.php" ?>






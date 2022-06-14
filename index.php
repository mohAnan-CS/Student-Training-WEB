<?php include "parts/_header.php" ?>
<?php include_once 'model.php'; ?>
<main class="login-main">

    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['login']) && !empty($_POST['username']) 
                    && !empty($_POST['password']) ){
                    $username = $_POST['username'];
                    $password = sha1($_POST['password']);
                    $model_obj = new Model;
                    $model_obj->checkLogin($username , $password);
                }
        }
    ?>
    <!-- if he has login -->
    <?php if (!isset($_SESSION['is_login'])){ ?>
    <h2>Login</h2>
    <div class="login-box">
        <form class="login-form" action="?"  method="post">
            <div>
                <input class="text-filed-login" type="text" placeholder="Username" name="username" required>
            </div>
            <div>
                <input class="text-filed-login" type="password" placeholder="Password" name="password" required>
            </div>
            <input class="login-btn" type="submit" name="login" value="Login">
        </form>
    </div>


    <?php } else { ?>

        <?php
            $model_obj = new Model;
            $model_obj->updateLastHit($_SESSION['userid']);
            ?>
    <h2>Home Page</h2>
    <table class="table-info-home">
        <caption>User Information</caption>
        <thead>
            <tr>
                <th>User Id</th>
                <th>Display Name</th>
                <th>User Type</th>
            </tr>
        </thead>
        <tbody>            
            <tr>       
                <td><?php echo $_SESSION['userid'] ?></td>
                <td><?php echo $_SESSION['displayname'] ?></td>
                <td><?php echo $_SESSION['usertype'] ?></td>
            </tr>
        </tbody>
    </table>
    <table class="table-info-home" id="table-id">
        <caption>
        <?php if($_SESSION['usertype'] == "company"){echo "User Company";}
                    else{echo "User Student";} ?>
        </caption>
        <thead>
            <tr>
                <th>
                <?php if($_SESSION['usertype'] == "company"){echo "Company Name";}
                    else{echo "Student Name";} ?>
                </th>
                <th>
                    <?php if($_SESSION['usertype'] == "company"){echo "User Company Id";}
                    else{echo "User Student Id";} ?>
                </th>
            </tr>
        </thead>
        <tbody>            
            <?php
            if($_SESSION['usertype'] == "company"){
                $userid = $_SESSION['userid'];
                $_SESSION['companyid'] = 0 ;
                $model_obj = new Model;
                $statement = $model_obj->getAllCompany($userid);
                $count = $statement->rowCount();
                if ($count > 0){
                    while($row=$statement->fetch(PDO::FETCH_NUM)){
                        $_SESSION['companyid'] = $row[0];
                        ?>
                    <tr>       
                        <td><?php echo $row[1] ?></td>
                        <td><?php echo $row[8] ?></td>
                    </tr>
            <?php } } } else { 
                $userid = $_SESSION['userid'];
                $model_obj = new Model;
                $statement = $model_obj->getAllStudent($userid);
                $count = $statement->rowCount();
                if ($count > 0){
                    while($row=$statement->fetch(PDO::FETCH_NUM)){
                        ?>
                    <tr>       
                        <td><?php echo $row[1] ?></td>
                        <td><?php echo $row[10] ?></td>
                    </tr>
            <?php } } }  ?>
        </tbody>
    </table>
    <?php } ?>
</main>
<aside class="login-aside">
    <h2>Aside</h2>
    <p>
        The aside will have information related to the current page or ads.
    </p>
</aside>
<?php include "parts/_footer.php" ?>
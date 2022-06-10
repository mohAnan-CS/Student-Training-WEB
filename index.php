<?php include "parts/_header.php" ?>
<?php include_once 'model.php'; ?>
<main class="login-main">
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['login']) && !empty($_POST['username']) 
                    && !empty($_POST['password']) ){
                    $username = $_POST['username'];
                    $password = $_POST['password'];
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
    <h2>Home Page</h2>
    <table class="table-info-home">
        <thead>
            <tr>
                <th>User Id</th>
                <th>Display Name</th>
                <th>User Type</th>
                <th>
                    <?php if($_SESSION['usertype'] == "company"){echo "User Company Id";}
                    else{echo "User Student Id";} ?>
                </th>
            </tr>
        </thead>
        <tbody>            
            <tr>       
                <td><?php echo $_SESSION['userid'] ?></td>
                <td><?php echo $_SESSION['displayname'] ?></td>
                <td><?php echo $_SESSION['usertype'] ?></td>
                <td>No id</td>
            </tr>
        </tbody>
    </table>
    <?php } ?>
</main>
<aside class="login-aside">
    <h2>Aside</h2>
    <p>
        The aside will have information related to the current page or ads.
        The aside will have information related to the current page or ads.
        The aside will have information related to the current page or ads
    </p>
</aside>
<?php include "parts/_footer.php" ?>
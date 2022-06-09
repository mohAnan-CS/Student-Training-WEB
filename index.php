<?php include "parts/_header.php" ?>
<?php include_once 'parts/_db.php'; ?>
<?php include_once 'model.php'; ?>
<main class="login-main">
    <h2>Login</h2>
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


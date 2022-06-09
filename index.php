<?php include "parts/_header.php" ?>
<?php include_once 'parts/_db.php'; ?>
<main class="login-main">
    <h2>Login</h2>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['login']) && !empty($_POST['username']) 
                    && !empty($_POST['password']) ){
                    $object_db = new DatabaseConnection;
                    $conn = $object_db->connect();
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $query = "SELECT id , username , password 
                    , displayname , lasthit , usertype FROM user 
                    WHERE username = :username AND password =:password";
                    $statement = $conn->prepare($query);
                    $statement->execute(
                        array(
                            'username' => $_POST['username'],
                            'password' => $_POST['password']
                        )
                    );
                    $count = $statement->rowCount();
                    $displayname = "";
                    $username = "";
                    $is_login = 1;
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    if ($count > 0){
                        while($row=$statement->fetch(PDO::FETCH_NUM)){
                            $username=$row[1];
                            $displayname=$row[3];
                        }
                        $_SESSION['username'] = $username;
                        $_SESSION['displayname'] = $displayname;
                        $_SESSION['is_login'] = $is_login;
                        header("location:home.php");
                    }else{
                        //Wrong info
                    }
                }
        }
    ?>
    <div class="login-box">
        <form class="login-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>"  method="post">
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


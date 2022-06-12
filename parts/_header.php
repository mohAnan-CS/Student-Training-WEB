<!DocType html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="css/layout.css" />
        <link rel="stylesheet" href="css/website.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Student Training</title>
    </head>
    <body>

    
        <!-- Check if user has login and change the login to logout , display name and display session info for the user-->
        <?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
        <?php if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == 1){ ?>
        <header class="header-logout">
            <?php $displayname = $_SESSION['displayname']; ?>
            <img class="logo"src="images/logo-company.png" alt="logo" />
            <h1>Student Training</h1> 
            <nav>
                <ul class="nav-link">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="students.php">Student List</a></li>
                    <li><a href="companies.php">Companies List</a></li>
                </ul>
            </nav>
            <div class="div-logout-name">
                <li><?php echo $displayname ?></li>
                <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
                    <input type="submit" name="logout" value="Logout" />
                </form>
            </div>
        </header>
        <?php }else{ ?>
        <!-- else statement for defult header -->
        <header>
            <img class="logo"src="images/logo-company.png" alt="logo" />
            <h1>Student Training</h1> 
            <nav>
                <ul class="nav-link">
                    <li><a href="">Home</a></li>
                    <li><a href="">Student List</a></li>
                    <li><a href="">Companies List</a></li>
                    <li><a href="index.php">Login</a></li>
                </ul>
            </nav>
        </header>
        <?php } ?>
        <?php 
            if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['logout'])){
                session_destroy();
                header("location:logout.php");
            }
        ?>     

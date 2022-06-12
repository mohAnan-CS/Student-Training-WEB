<?php include "parts/_header.php" ?>
<main>
<?php 
    if (!isset($_SESSION['userid'])){
        header("location:index.php");
    }
    ?>
    <h2>Add Company</h2>
    
    
    <aside>
        <h2>Help</h2>
        <p>
            Add company and positions details so that students can find you...
        </p>
    </aside>
</main>

<?php include "parts/_footer.php" ?>


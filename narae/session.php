<?php
session_start();
if(!isset($_SESSION['is_login'])){
    header('Location: ./login.html');
}
?>
<html>
    <body>
        Welcome. <?php echo $_SESSION['name'];?><br />
        <a href="./logout.php">Logout</a>    
    </body>
</html>

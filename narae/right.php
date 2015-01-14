<?php
session_start();
if(!isset($_SESSION['is_login'])){
    header('Location: ../login/login.html');
}
?>
Welcome. <?php echo $_SESSION['name'];?><br />
        <a href="../login/logout.php">Logout</a>&nbsp;
        <a href="../login/modify.html">Modify</a>&nbsp;
        <a href="../login/ok_bye.html">Bye... </a>  
      </div>
    </div>
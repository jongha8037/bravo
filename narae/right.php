<?php
session_start();
if(!isset($_SESSION['is_login'])){
    header('Location: ../login/login.html');
}
?>
Welcome. <?php echo $_SESSION['name'];?><br />
        <a href="../login/logout.php">Logout</a>&nbsp;
        <a href="../login/modify.html">Modify</a>&nbsp;
        <a href="../login/ok_bye.html">Bye... </a> <br>
        POINT : 
        <?php
		$db=new DBlayer;
		$db->login();
		$id=$_SESSION['id'];
		$db->member_point($id);
		echo $db->point;
		?>
		<br>
        GRADE : 
        <?
        $db=new DBlayer;
        $db->login();
        $id=$_SESSION['id'];
        $db->member_grade($id);
        echo $db->grade;
        ?>


      </div>
    </div>
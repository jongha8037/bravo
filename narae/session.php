<?php
session_start();
if(!isset($_SESSION['is_login'])){
    header('Location: ./login.html');
}
?>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf8">

	</head>

    <body>
<<<<<<< HEAD
        Welcome. <?php echo $_SESSION['name'];?><br />
        <a href="./logout.php">Logout</a>&nbsp;
        <a href="./ok_bye.php">Ok Bye... </a>  
=======
        <?php echo $_SESSION['name'];?>님 환영합니다<br />
        <a href="./logout.php">로그아웃</a>    
>>>>>>> e8fb84b9d72247b98d5e49cf44ae57f3ac605f49
    </body>
</html>


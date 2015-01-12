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
        <div><?php echo $_SESSION['name'];?> welcome!!!!</div>
        <button><a href="./logout.php">Log out</a></button>    
        <button><a href="./ok_bye.html">Bye...</a></button>
    </body>
</html>


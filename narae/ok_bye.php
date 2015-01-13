<?php
session_start();

$mysqli_hostname = $_ENV['MYSQL_HOST'];
$mysqli_user = $_ENV['MYSQL_USER'];
$mysqli_password = $_ENV['MYSQL_PSWD'];
$mysqli_database = $_ENV['MYSQL_DB'];

$link = mysqli_connect($mysqli_hostname, $mysqli_user, $mysqli_password) or die("internal error1");
mysqli_select_db($link, $mysqli_database) or die("internal error2");

$id=$_SESSION["id"];

$query="select * from member where id='".$id."'";
$result1=mysqli_query($link, $query) or die("wrong query");
$tot=mysqli_num_rows($result1);
$rows=mysqli_fetch_array($result1, MYSQLI_ASSOC);

$db_pw=$rows[pass];

$pw_sub=$_POST['pw_bye'];

if(EMPTY($pw_sub)) {
	echo "Enter the password";
	echo("<script>setTimeout(function(){location.href='http://www.example.dev/login/ok_bye.html'} , 1000);</script>"); 
}

$pw_sub=sha1($pw_sub);

if($pw_sub==$db_pw) {
	$query="delete from member where id='".$_SESSION['id']."'";
	$result1=mysqli_query($link, $query) or die("fail");
	session_destroy();
	echo "SUCCESS. Back to login page";
	echo("<script>setTimeout(function(){location.href='http://www.example.dev/login/login.html'} , 1000);</script>"); 
}else {
	echo "wrong password - cancellation fail";
	echo("<script>setTimeout(function(){location.href='http://www.example.dev/login/ok_bye.html'} , 1000);</script>"); 
}

?>
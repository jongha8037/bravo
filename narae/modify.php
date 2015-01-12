<?php
session_start();

$mysqli_hostname = "localhost";
$mysqli_user = "root";
$mysqli_password = "o1010l";
$mysqli_database = "test";
$prefix = "";
$link = mysqli_connect($mysqli_hostname, $mysqli_user, $mysqli_password) or die("internal error1");
mysqli_select_db($link, $mysqli_database) or die("internal error2");

$id=$_SESSION["id"];

$query="select * from member where id='".$id."'";
$result1=mysqli_query($link, $query) or die("wrong query");
$tot=mysqli_num_rows($result1);
$rows=mysqli_fetch_array($result1, MYSQLI_ASSOC);

$db_pw=$rows[pass];
$cur_pw=$_POST['current_pw'];
$new_pw=$_POST['new_pw'];
$ver_pw=$_POST['verify_pw'];

if(EMPTY($cur_pw) or EMPTY($new_pw) or EMPTY($ver_pw)) {
	echo "Enter the password";
	echo("<script>setTimeout(function(){location.href='http://www.example.dev/login/modify.html'} , 1000);</script>"); 
}
else{
	$cur_pw=sha1($cur_pw);
	$new_pw=sha1($new_pw);
	$ver_pw=sha1($ver_pw);
	if(!($db_pw==$cur_pw)){
		echo "Current password is not correct";
		echo("<script>setTimeout(function(){location.href='http://www.example.dev/login/modify.html'} , 1000);</script>");
	}
	#$pw_sub=sha1($pw_sub);



	elseif(!($new_pw==$ver_pw)) {
		echo "Check 'New password' and 'Verify new password' again";
		echo("<script>setTimeout(function(){location.href='http://www.example.dev/login/modify.html'} , 1000);</script>"); 
	}

	else {
	$query="update member set pass='".$ver_pw."' where id='".$id."'";
	$result1=mysqli_query($link, $query) or die("fail");
	echo "SUCCESS. Back to login page";
	echo("<script>setTimeout(function(){location.href='http://www.example.dev/login/login.html'} , 1000);</script>"); 
	}
}
?>
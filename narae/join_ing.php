<?php
$mysqli_hostname = "localhost";
$mysqli_user = "root";
$mysqli_password = "o1010l";
$mysqli_database = "test";
$prefix = "";
$link = mysqli_connect($mysqli_hostname, $mysqli_user, $mysqli_password) or die("internal error1");
mysqli_select_db($link, $mysqli_database) or die("internal error2");
$id=$_POST['id_reg'];
$pw=$_POST['pw_reg'];
$pw=sha1($pw);
$name=$_POST['name_reg'];
$query1="select * from member where id='".$id."'";
$result1=mysqli_query($link, $query1) or die("wrong query1");
$tot=mysqli_num_rows($result1);
if($tot>=1) {
	header("refresh:1;url=http://www.example.dev/login/login.html");
	echo "Duplicated ID";
	exit;
}

if(empty($id) or empty($pw) or empty($name)) {
	header("refresh:1;url=http://www.example.dev/login/login.html");
	echo "Fill all Fields.";
	exit;
}


$query2="insert into member values('".$id."', '".$pw."', '".$name."')"; 
$result2=mysqli_query($link, $query2) or die("wrong query2");
if ($result2=='true'){
	header("refresh:1;url=http://www.example.dev/login/login.html");
	 echo "SUCCESS";
	exit;
};
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf8">
	<title></title>
</head>
<body>
</body>
</html>
<meta http-equiv="Content-type" content="text/html; charset=utf8">
<?php
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "o1010l";
$mysql_database = "test";
$prefix = "";
$link = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("internal error1");
mysql_select_db($mysql_database, $link) or die("internal error2");
$id=$_POST['id_reg'];
$pw=$_POST['pw_reg'];
$pw=sha1($pw);
$name=$_POST['name_reg'];
$query1="select * from member where id='".$id."'";
$result1=mysql_query($query1, $link) or die("wrong query1");
$tot=mysql_num_rows($result1);
if($tot>=1) {
	 header("refresh:1;url=http://www.example.dev/login.html");
	 echo "해당 아이디는 중복되었습니다.";
	exit;
}

if(empty($id) or empty($pw) or empty($name)) {
	 header("refresh:1;url=http://www.example.dev/login.html");
	 echo "필드를 모두 입력해주세요.";
	exit;
}


$query2="insert into member values('".$id."', '".$pw."', '".$name."')"; 
$result2=mysql_query($query2, $link) or die("wrong query2");
if ($result2=='true'){
	header("refresh:1;url=http://www.example.dev/login.html");
	 echo "SUCCESS";
	exit;
};
?>

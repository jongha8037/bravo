<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
session_start();

$link=mysql_connect("localhost","root","0308");
mysql_select_db("php_sample",$link);

$query="SELECT*FROM login";
$result=mysql_query($query,$link) or die ("no");

$lot=mysql_num_rows($result);

for($i=0;$i<$lot;$i++){
	$rows=mysql_fetch_array($result);

	if($_POST['id'] == $rows[id]){
		header('Location: ./resign_up.php');
    }
}

$pass=md5($_POST['pwd']);

$sql="INSERT INTO login VALUES('$_POST[id]','$pass','$_POST[name]')";

mysql_query($sql,$link);

echo "$_POST[id]<br> 가입을 축하드립니다!!!!";
?>

<html>
	<head>
		<style type="text/css">
			input {
				margin: 10px;
			}

		</style>
	</head>
	<body>
		<div><input type="button" value="로그인 하기" onClick="home();" /></div>

		<script type="text/javascript">
			function home(){
				location.href='http://www.example.dev/login.html';
			}
		</script>    
	</body>
</html>




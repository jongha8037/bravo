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

	$pass=md5($_POST['pwd']);



if(!empty($_POST['id']) && !empty($_POST['pwd'])){
    if($_POST['id'] == $rows[id] && $pass == $rows[password]){
        $_SESSION['is_login'] = true;
        $_SESSION['nickname'] = $rows[name];
        header('Location: ./session.php');
        exit;
    }
}


}

echo '로그인 하지 못했습니다.';

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
		<div><input type="button" value="로그인 다시하기" onClick="home();" /></div>

		<script type="text/javascript">
			function home(){
				location.href='http://www.example.dev/login.html';
			}
		</script>    
	</body>
</html>


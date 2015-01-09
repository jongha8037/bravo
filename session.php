<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
session_start();
if(!isset($_SESSION['is_login'])){
    header('Location: ./login.html');
}

echo $_SESSION['nickname'];
echo "<br> 로그인 되었습니다!!!!";
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
		<div><input type="button" value="로그아웃" onClick="home();" /></div>

		<script type="text/javascript">
			function home(){
				location.href='http://www.example.dev/login.html';
			}
		</script>    
	</body>
</html>
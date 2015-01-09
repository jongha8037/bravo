<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
	echo "아이디가 중복되었습니다.";
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
		<div><input type="button" value="처음으로" onClick="home();" /></div>

		<script type="text/javascript">
			function home(){
				location.href='http://www.example.dev/login.html';
			}
		</script>    
	</body>
</html>
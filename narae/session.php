<meta http-equiv="Content-type" content="text/html; charset=utf8">
<?php
session_start();
if(!isset($_SESSION['is_login'])){
    header('Location: ./login.html');
}
?>
<html>
    <body>
        <?php echo $_SESSION['name'];?>님 환영합니다<br />
        <a href="./logout.php">로그아웃</a>    
    </body>
</html>

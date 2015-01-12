<?php
session_start();
$_SESSION["id"]=$_POST['id'];


$mysqli_hostname = "localhost";
$mysqli_user = "root";
$mysqli_password = "o1010l";
$mysqli_database = "test";
#$prefix = "";
$link = mysqli_connect($mysqli_hostname, $mysqli_user, $mysqli_password) or die("internal error1");
mysqli_select_db($link, $mysqli_database) or die("internal error2");

$query="select * from member where id='".$_POST['id']."'";
$result1=mysqli_query($link, $query) or die("wrong query");
$tot=mysqli_num_rows($result1);
$rows=mysqli_fetch_array($result1, MYSQLI_ASSOC);


$db_id=$rows[id];
$db_pw=$rows[pass];
$db_name=$rows[name];

$id=$_POST['id'];
$pw=$_POST['pw'];
$pw=sha1($pw);


if(!empty($id) && !empty($pw)){
    if($id == $db_id && $pw == $db_pw){
        $_SESSION['is_login'] = true;
        $_SESSION['name'] = $db_name;
        header('Location: ./session.php');
        exit;
    }
}
header("refresh:1;url=http://www.example.dev/login/login.html");
echo 'Login Fail';
?>
<meta http-equiv="Content-type" content="text/html; charset=utf8">
<?php

session_start();


$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "o1010l";
$mysql_database = "test";
$prefix = "";
$link = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("internal error1");
mysql_select_db($mysql_database, $link) or die("internal error2");

$query="select * from member where id='".$_POST['id']."'";
$result1=mysql_query($query, $link) or die("wrong query");
$tot=mysql_num_rows($result1);
$rows=mysql_fetch_array($result1);


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
echo '로그인 하지 못했습니다.';


?>
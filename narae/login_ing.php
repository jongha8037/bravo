<?php
session_start();
$_SESSION["id"]=$_POST['id'];

$mysqli_hostname = $_ENV['MYSQL_HOST'];
$mysqli_user = $_ENV['MYSQL_USER'];
$mysqli_password = $_ENV['MYSQL_PSWD'];
$mysqli_database = $_ENV['MYSQL_DB'];

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


         $sQuery = "Select * From time";
    $objRecordSet = mysqli_query($link, $sQuery);
      $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);         
      $iUno = $objRecord['time'];


      $a=date('d',strtotime($iUno));

      if(date(d)-$a != 0 ){
      	  $sQuery  = "Update time set time=now()";
	  $bDBResult = mysqli_query($link, $sQuery); 

	     $sQuery  = "Update member set grade='HUMAN' where grade='GOD'";
  $objRecordSet = mysqli_query($link, $sQuery);  


  	  $sQuery = "Select * From member";
    $objRecordSet = mysqli_query($link, $sQuery);
   $iTotalRecord = mysqli_num_rows($objRecordSet);

     $aa=0;
     $bb="";
   for($iIdxx = 0; $iIdxx < $iTotalRecord; $iIdxx++) {
    
   if(mysqli_data_seek($objRecordSet, $iIdxx)) {
      $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);   
      
      $iUno = $objRecord["point"];
  
      if($aa<$iUno){
        $aa=$iUno;
   
      }
    }    

  } 
   	 
  		     $sQuery  = "Update member set grade='GOD' where point=$aa";
  $objRecordSet = mysqli_query($link, $sQuery);  




      }







        header('Location: ../board/BoardList.php');
        exit;
    }
}

header("refresh:1;url=http://www.example.dev/login/login.html");
echo 'Login Fail';
?>


  
    <header class="header">
      <p class="title">School Board</p>
    </header>
    <div class="left">
      <div class="left_bar">
        <div class="board">전체 게시판</div>

<?php

$mysqli_hostname = $_ENV['MYSQL_HOST'];
$mysqli_user = $_ENV['MYSQL_USER'];
$mysqli_password = $_ENV['MYSQL_PSWD'];
$mysqli_database = $_ENV['MYSQL_DB'];

$link = mysqli_connect($mysqli_hostname, $mysqli_user, $mysqli_password) or die("internal error1");
mysqli_select_db($link, $mysqli_database) or die("internal error2");

$sBoardDirection = "board_direction";

    $sQuery  = "Select * From $sBoardDirection"; 

   $objRecordSet = mysqli_query($link, $sQuery);  


  $BoardRecord = mysqli_num_rows($objRecordSet);


for($i=0;$i<$BoardRecord;$i++){
  if(mysqli_data_seek($objRecordSet, $i)) {
      $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);    
      
      $iUno = $objRecord["board_name"]; 
      echo("<div class=".'board'.">$iUno</div>"); 

      
    }

}

?>

 








       
      </div>
    </div>
    <div class="center">
      <div class="center_bar">


    <div class="left">
      <div class="left_bar">


<?php
$db=new DBlayer;
$db->login();

$sBoardDirection = "board_direction";

    $sQuery  = "Select * From $sBoardDirection"; 

   $objRecordSet = mysqli_query($db->link, $sQuery);  


  $BoardRecord = mysqli_num_rows($objRecordSet);



/*
$objRecord=array();
while ($row = mysql_fetch_array($objRecordSet)) {
    $objRecord[]=$row;
}

var_dump($objRecord);

foreach ($objRecord as $set) {
  printf('<a href="board.php?boardNo=%s">%s</a>', $set['id'], $set['name']);
}

*/

for($i=0;$i<$BoardRecord;$i++){
  if(mysqli_data_seek($objRecordSet, $i)) {
      $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);    
//      printf("<a href="/board.php?boardNo=%s"><div class=".'board'.">$iUno</div></a>", $objRecord['board_num']);



      $bname = $objRecord["board_name"]; 
      printf("<a href='http://www.example.dev/board/BoardList.php?boardNo=%d'><div class=".'board'.">$bname</div></a>", $objRecord['board_num']);


  //    echo("<div class=".'board'.">$iUno</div>"); 

      
    }

}

?>

 








       
      </div>
    </div>
 
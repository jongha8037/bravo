<div class="left">
  <div class="left_bar">

<?php
$db=new DBlayer;
$db->login();
$id=$_SESSION['id'];
$db->check_grade($id);

$sQuery  = "Select * From board_direction"; 
$objRecordSet = mysqli_query($db->link, $sQuery);  
$BoardRecord = mysqli_num_rows($objRecordSet);

for($i=0;$i<$BoardRecord;$i++){
  if(mysqli_data_seek($objRecordSet, $i)) {
    $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);    

    $bname = $objRecord["board_name"]; 
    printf("<a href='http://www.example.dev/board/BoardList.php?boardNo=%d'><div class=".'board'.">$bname</div></a>", $objRecord['board_num']);
  }
}

if($db->check_grade=='GOD'){
?>
  <a href="http://www.example.dev/board/write.php?board=boardcreate"><button type="button" class="btn btn-info" style="margin-top:100px">게시판 생성</button></a>
  <a href="http://www.example.dev/board/write.php?board=boarddelete"><button type="button" class="btn btn-info" style="margin-top:15px">게시판 삭제</button></a>
<?
}
?>
  </div>
</div>


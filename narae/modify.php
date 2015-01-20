<?php
Session_Start();

require ("./abstract.php");
$db=new DBlayer;
$db->login();
$boardNum = $_GET["boardNum"];
$boardNo = $_GET["no"];
?>
<html>
<head>
  <title></title>
  <meta http-equiv="Content-type" content="text/html; charset=utf8">
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link type="text/css" href="./board.css" rel="stylesheet" />



  </head>
  <body>
    <div class="container">

<?php
require ("./top.php");
require ("./left.php");

$sQuery  = "Select board_name From board_direction where board_num=$boardNum";
$objRecordSet = mysqli_query($db->link, $sQuery);  

if(!$objRecordSet){
  $iUno = "전체 게시판";
}else{
  $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);
  $iUno = $objRecord['board_name'];
}      

$sQuery  = "Select * From board where no=$boardNo";
$objRecordSet = mysqli_query($db->link, $sQuery);
$objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);
$a = $objRecord['title'];
$b = $objRecord['id'];
$c = $objRecord['start_date'];
$d = $objRecord['hit'];
$e = $objRecord['last_date'];
$f = $objRecord['content'];
$g = $objRecord['no'];

$sQuery  = "Select * From board_direction"; 
$objRecordSet = mysqli_query($db->link, $sQuery);  
$BoardRecord = mysqli_num_rows($objRecordSet);
?>
      <div class="center">
        <div class="center_bar">
          <h3 class="topic"><u><?=$iUno?></u></h3>  

          <form name = "InsertForm" method = "post" action = "BoardDBmanage.php">
            <input type = "hidden" name = "mode" value = "modify">
            <input type = "hidden" name = "board" value = "board">
            <input type = "hidden" name = "modifyno" value = <?=$g?>>
            <input type = "hidden" name = "board_num" value = <?=$boardNum?>>
     
            <table class="table">
              <tr>
                <td>Name</td>
                <td>
                  <input type = "text" name = "id" class="form-control"  value = "<?=$b?>" ReadOnly>
                </td>
              </tr> 
              <tr>
                <td>Subject</td>
                <td>
                  <input type = "text" class="form-control" name = "subject" value = "<?=$a?>">
                </td>
              </tr>  
            </table>
            
            <div>
            <div class="write-content1">Content</div>
            <div class="write-content2">
              <textarea  class="form-control" rows = "17" name = "scontent"><?=$f?></textarea>
            </div>
            </div><br />
            
            <div align="center">
            <button type = "button" class="btn btn-danger" OnClick = "javascript:history.back();">Back</button>
            <button type = "reset" class="btn btn-danger">Reset</button>
            <button type = "submit" class="btn btn-danger">Save</button>
            </div>
          </form><br />
        </div>
      </div>

<?php
require ("./right.php"); 
require ("./bottom.php");
?>

<?php
Session_Start();

require ("./abstract.php");
$db=new DBlayer;
$db->login();
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

$boardNum = $_GET["boardNum"];
$boardCreate = $_GET["board"];


if($boardCreate=="boardcreate"){
?>
      <div class="center">
        <div class="center_bar">

          <form name = "InsertForm" method = "post" action = "BoardDBmanage.php">
            <input type = "hidden" name = "mode" value = "boardcreate">

            <h3 class="topic"><u>Board Name</u></h3> 
            <input type = "text" class="form-control board-name" name = "boardname">

            <div align="center">
              <button type = "button" class="btn btn-danger" OnClick = "javascript:history.back();">Back</button>
              <button type = "reset" class="btn btn-danger">Reset</button>
              <button type = "submit" class="btn btn-danger">Create</button>
            </div>
          </form>
        </div>
      </div>

<?
}else if($boardCreate=="boarddelete"){
?>
      <div class="center">
        <div class="center_bar">

          <form name = "InsertForm" method = "post" action = "BoardDBmanage.php">
            <input type = "hidden" name = "mode" value = "boarddelete">

            <h3 class="topic"><u>Board Name</u></h3> 
            <input type = "text" class="form-control board-name" name = "boardname">

            <div align="center">
              <button type = "button" class="btn btn-danger" OnClick = "javascript:history.back();">Back</button>
              <button type = "reset" class="btn btn-danger">Reset</button>
              <button type = "submit" class="btn btn-danger">Delete</button>
            </div>
          </form>
        </div>
      </div>

<?
}else{

$sQuery  = "Select board_name From board_direction where board_num=$boardNum";
$objRecordSet = mysqli_query($db->link, $sQuery);  

if(!$objRecordSet){
  $iUno = "전체 게시판";
}else{
  $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);
  $iUno = $objRecord['board_name'];
}      
?>
      <div class="center">
        <div class="center_bar">          
          <h3 class="topic"><u><?=$iUno?></u></h3>  

          <form name = "InsertForm" method = "post" action = "BoardDBmanage.php">
            <input type = "hidden" name = "mode" value = "insert">
            <input type = "hidden" name = "board" value = "board">
            <input type = "hidden" name = "board_num" value = <?=$boardNum?>>
  
            <table class="table">
              <tr>
<?php
$sQuery  = "Select * From board_direction"; 
$objRecordSet = mysqli_query($db->link, $sQuery);  
$BoardRecord = mysqli_num_rows($objRecordSet);

if($boardNum==0||!$boardNum){

  printf("<td>board</td><td>");
  printf(" <select  name=".'board_num'.">");
  
  for($i=0;$i<$BoardRecord;$i++){
    if(mysqli_data_seek($objRecordSet, $i)){
      if($i!=0){
        $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);    
        $bname = $objRecord["board_name"]; 

        printf("<option value=%d>$bname</option>", $objRecord['board_num']);  
      }    
    }
  }
  printf("</select>");
}
?>
                </td>
              </tr> 
              <tr>
                <td>Name</td>
                <td>
                <input type = "text" name = "id" class="form-control"  value = "<?=$_SESSION['id']?>" ReadOnly>
              </td>
              </tr> 
              <tr>
                <td>Subject</td>
                <td>
                  <input type = "text" class="form-control" name = "subject">
                </td>
              </tr>  
            </table>
            
            <div>
              <div class="write-content1">Content</div>
              <div class="write-content2">
                <textarea  class="form-control" rows = "17" name = "scontent"></textarea>
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
}
require ("./right.php"); 
require ("./bottom.php");
?>

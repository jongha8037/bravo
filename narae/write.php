<?php
Session_Start();

//include "./Common.inc";  /* 게시판 관련 변수 셋팅된 모듈 파일 불러오기 */
//include "./DBConn.inc";  /* DB 연결 모듈 파일 불러오기 */
require ("./abstract.php");
$db=new DBlayer;
$db->login();
$iRecordPerPage = 2;  /* 1페이지당 출력되는 레코드 수 */
$iPagePerBlock = 2;  /* 1블럭당 출력되는 페이지 수 */


?>
<html>
<head>
  <title></title>
  <meta http-equiv="Content-type" content="text/html; charset=utf8">
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

  <style type="text/css">
         .container {
        max-width:1024px;
        line-height:1.5em;
        margin: auto;
    }
    .header {
        width:100%;
        height:90px;
        vertical-align: center;
        padding-top: 18px;
        border-bottom:5px #bdc3c7;
        border-bottom-style: dashed;
    }
    .left {
        width:12%;
        float:left;
        margin-top:10px;
        margin-bottom:30px;

    }
    .left_bar {
        margin-top:60px;
      
    }
    .center {
        width:70%;
        float:left;
        margin-top:10px;
        margin-bottom:50px;
        min-height: 680px;
    }
    .center_bar {
        padding:20px;
        padding-bottom:0px;
        border-right:2px solid orange;
       border-left:2px solid orange;
       min-height: 680px;
    }
    .right {
        width:18%;
        float:left;
        margin-top:10px;
        margin-bottom:30px;
  
    }
    .right_bar {

 
    }
    .footer {
        clear:both;
        background-color: #2c3e50;
        color: white;
        padding-top:  25px;
        padding-bottom: 20px;
        padding-left: 20px;
        width: 100%;
        height: 140px;
    }

    .title {

        color: #16a085;
        padding:15px;
        font-size: 35px;
        font-weight: bold;
    }


    .board {
      padding:15px;

    }
   

    .topic {
      padding-left: 15px;
      margin-top:0px;
      font-weight: bold;
      color: #3C5927;

    }

    .tableNo{
      width: 50px;

    }
    .tableTitle{
      width: 100px;
      
    }
    .tableName{
      width: 100px;
      
    }
    .tableDate{
      width: 100px;
      
    }
    .tableHit{
      width: 60px;
      
    }

    table {

    }

    th {
      text-align: center;
    }

    td {
    }


    .aa{
      float: left;
      padding-left: 13px;
      padding-right: 96px;
      font-size: 17px;
      margin-top: 170px;
    }
     .bb{
      float: left;
       width: 475px;
       margin: 0px;
  
       margin-bottom: 40px;
    }
    .cc{

    }

    .dd{
      margin-top: 30px;
            margin-bottom: 400px;

    }
    .font1 {
    font-style:italic;
}
.color1 {
    color: #1abc9c;
}

  </style>  
</head>
<body>
  <div class="container">
<?php
  require ("./top.php");
  require ("./left.php");
  require ("./center_start.php");
  $boardNum = $_GET["boardNum"];
  $boardCreate = $_GET["board"];


if($boardCreate=="boardcreate"){



?>

<form name = "InsertForm" method = "post" action = "BoardDBmanage.php">

<input type = "hidden" name = "mode" value = "boardcreate">

 
 
 <h3 class="topic"><u>Board Name</u></h3> 

<input type = "text" class="form-control dd" name = "boardname">


<div align="center">
<button type = "button" class="btn btn-danger" OnClick = "javascript:history.back();">Back</button>
<button type = "reset" class="btn btn-danger">Reset</button>
<button type = "submit" class="btn btn-danger">Create</button>

</div>
</form>







<?

}else if($boardCreate=="boarddelete"){


?>

<form name = "InsertForm" method = "post" action = "BoardDBmanage.php">

<input type = "hidden" name = "mode" value = "boarddelete">

 
 
 <h3 class="topic"><u>Board Name</u></h3> 

<input type = "text" class="form-control dd" name = "boardname">


<div align="center">
<button type = "button" class="btn btn-danger" OnClick = "javascript:history.back();">Back</button>
<button type = "reset" class="btn btn-danger">Reset</button>
<button type = "submit" class="btn btn-danger">Delete</button>

</div>
</form>







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

 <h3 class="topic"><u><?=$iUno?></u></h3>  


<form name = "InsertForm" method = "post" action = "BoardDBmanage.php">

<input type = "hidden" name = "mode" value = "insert">
<input type = "hidden" name = "board" value = "board">
<input type = "hidden" name = "board_num" value = <?=$boardNum?>>
<table class="table">
<tr>

<?php


$sBoardDirection = "board_direction";

    $sQuery  = "Select * From $sBoardDirection"; 

   $objRecordSet = mysqli_query($db->link, $sQuery);  


  $BoardRecord = mysqli_num_rows($objRecordSet);
  if($boardNum==0||!$boardNum){

    printf("<td>board</td><td>");

    printf(" <select  name=".'board_num'.">");
    for($i=0;$i<$BoardRecord;$i++){
  
  if(mysqli_data_seek($objRecordSet, $i)) {
      if($i!=0){
      $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);    

      $bname = $objRecord["board_name"]; 
printf("<option value=%d>$bname</option>", $objRecord['board_num']);  
}    


      
    }

}
    printf("</select>");
}

else{

 
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
    <div class="aa">Content</div>
    <div class="bb">
      <textarea  class="form-control" rows = "17" name = "scontent"></textarea>
    </div>
  </div>  


<br />
<div align="center">
<button type = "button" class="btn btn-danger" OnClick = "javascript:history.back();">Back</button>
<button type = "reset" class="btn btn-danger">Reset</button>
<button type = "submit" class="btn btn-danger">Save</button>

</div>
</form>
<br>

<?php
}
 require ("./center_end.php");
  require ("./right.php"); 
  require ("./bottom.php");

  ?>

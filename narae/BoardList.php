<?php
//if (!defined("_GNUBOARD_")) exit;

Session_Start();

require ("./abstract.php");
$db=new DBlayer;
$db->login();
$iRecordPerPage = 10;  /* 1페이지당 출력되는 레코드 수 */
$iPagePerBlock = 2;  /* 1블럭당 출력되는 페이지 수 */


$sTableName = "board";
//$sBoardDirection = "board_direction";
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
        height: 680px;
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

    th {
      text-align: center;
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

  $board_num=0;

$board_num=$_GET["boardNo"];
$search_name=$_GET["searchName"];


 $sQuery  = "Select board_name From board_direction where board_num=$board_num";

  $objRecordSet = mysqli_query($db->link, $sQuery);  


  if(!$objRecordSet){

    $iUno = "전체 게시판";
  }else{
    $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);
     $iUno = $objRecord['board_name'];
  }         
 


  ?>


        <h3 class="topic"><u><?=$iUno?></u></h3>  
<div class="clearfix">


<form class="navbar-form" role="search" style="float:right" method = "post" action = "search.php">
      <div class="form-group">
      <input type="hidden" name="boardNum" value=<?=$board_num?>>
        <input type="text" class="form-control input-sm" placeholder="Name" name="what">
      </div>
      <button type="submit" class="btn btn-default btn-sm">Search</button>
    </form>
     </div>  

        <table class="table table-hover" style="width:650px" align="center">

          <tr>   
            <th class="active tableNo">No.</th>
            <th class="success">Title</th>
            <th class="warning tableName" align="center">Name</th>
            <th class="danger tableDate">Date</th>
            <th class="active tableHit">Hit</th>
          </tr>
  <?

  if($search_name){
    

  if($board_num==0){
    $sQuery  = "Select * From $sTableName where id='$search_name' Order By no Desc";
 
  }else{
    $sQuery  = "Select * From $sTableName where board_num = $board_num and id='$search_name' Order By no Desc";

  }



  }else{

    if($board_num==0){
    $sQuery  = "Select * From $sTableName Order By no Desc";
 
  }else{
    $sQuery  = "Select * From $sTableName where board_num = $board_num Order By no Desc";

  }


  }






  $objRecordSet = mysqli_query($db->link, $sQuery);  
  $iTotalRecord = mysqli_num_rows($objRecordSet);

  $iNowPage = $_GET["iNowPage"];  

  if(!$iNowPage) {
    $iNowPage = 1;
  } 
    
  $iFirstRecordIdx = ($iNowPage - 1) * $iRecordPerPage;
  $iLastRecordIdx = $iFirstRecordIdx + $iRecordPerPage;
        
  if($iLastRecordIdx > $iTotalRecord) {
    $iLastRecordIdx = $iTotalRecord;
  }
    
  $table1 = $iTotalRecord - $iFirstRecordIdx;      

  for($iIdx = $iFirstRecordIdx; $iIdx < $iLastRecordIdx; $iIdx++) {
    
   if(mysqli_data_seek($objRecordSet, $iIdx)) {
      $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);   
      
      $iUno = $objRecord["no"];
      $table2 = $objRecord["title"]; 
      $table3 = $objRecord["id"]; 
      $table4 = $objRecord["last_date"]; 
      $table5 = $objRecord["hit"]; 
      $table6 = $objRecord["comment_num"];

      
    } else {
      break;
    }    
    ?>

    <tr align = "center"> 
  <!--          <td><?=$table1?></td>-->
  <td><?=$iUno?></td>

<?
            if($table6>0){
?>
                      <td align = "left"><a href="http://www.example.dev/board/read.php?no=<?=$iUno?>&&boardNum=<?=$board_num?>">&nbsp;&nbsp;<?=$table2?> [<?=$table6?>]</a></td>

<?
            }else{
?>

        <td align = "left"><a href="http://www.example.dev/board/read.php?no=<?=$iUno?>&&boardNum=<?=$board_num?>">&nbsp;&nbsp;<?=$table2?></a></td>

<?
            }

?>
             <td><?=$table3?></td>
            <td><?=$table4?></td>
            <td><?=$table5?></td>
          </tr>



    <?
    $table1--;  
  }        
  
   mysqli_free_result($objRecordSet); 
  ?>
</table>
<br>    

      <?


if(!$iTotalRecord) {
  $iTotalPage = 1;
} else {  
  $iTotalPage = ceil($iTotalRecord / $iRecordPerPage);
}

$iTotalBlock = ceil($iTotalPage / $iPagePerBlock);
$iNowBlock = ceil($iNowPage / $iPagePerBlock);

$iFirstPage = ($iNowBlock - 1) * $iPagePerBlock + 1;
$iLastPage = $iFirstPage + ($iPagePerBlock - 1);

if($iLastPage > $iTotalPage) {
  $iLastPage = $iTotalPage;
}

if($iNowBlock > 1) {
  $iPrevPage = $iFirstPage - 1;
  ?>
  <div align="center">
        <ul class="pagination" align="center">
          <li><a href = './BoardList.php?iNowPage=<?=$iPrevPage?>&&boardNo=<?=$board_num?>&&searchName=<?=$search_name?>'>&laquo;</a></li>         
  <?
}      
else{
 ?>   
 <div align="center">
    <ul class="pagination" align="center">
<?
}
for($i = $iFirstPage; $i <= $iLastPage; $i++) {
  if($i == $iNowPage) {
?>
        <li class="active"><a href='./BoardList.php?iNowPage=<?=$i?>&&boardNo=<?=$board_num?>&&searchName=<?=$search_name?>'><?=$i?></a></li>
<?
  } else {
?> 
          <li><a href='./BoardList.php?iNowPage=<?=$i?>&&boardNo=<?=$board_num?>&&searchName=<?=$search_name?>'><?=$i?></a></li>
<?
  }
}

if($iNowBlock < $iTotalBlock) {
  $iNextPage = $iLastPage + 1;  
?>
        
        <li><a href='./BoardList.php?iNowPage=<?=$iNextPage?>&&boardNo=<?=$board_num?>&&searchName=<?=$search_name?>'>&raquo;</a></li>
        </ul>
        </div>
<?  
}
  else{
?>
    </ul>
    </div>
<?
  }

?>         
<div align="right"><a href="http://www.example.dev/board/write.php?boardNum=<?=$board_num?>"><button type="button" class="btn btn-danger">Write</button></a></div>



<?php





 require ("./center_end.php");
  require ("./right.php"); 
  require ("./bottom.php");

  ?>






  </div>
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/respond.js"></script>





</body>
</html>







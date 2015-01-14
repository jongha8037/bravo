<?php
//ob_Start();
//Session_Start();

//include "./Common.inc";  /* 게시판 관련 변수 셋팅된 모듈 파일 불러오기 */
//include "./DBConn.inc";  /* DB 연결 모듈 파일 불러오기 */

$objDBConn = mysql_connect("localhost", "root", "0308");
$bStatus = mysql_select_db("test", $objDBConn);
$iRecordPerPage = 3;  /* 1페이지당 출력되는 레코드 수 */
$iPagePerBlock = 2;  /* 1블럭당 출력되는 페이지 수 */


$sTableName = "aa";
$sBoardDirection = "board_direction";
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
        height:50px;
        border-bottom:5px #bdc3c7;
        border-bottom-style: dashed;
    }
    .left {
        width:10%;
        float:left;
        margin-top:10px;
        margin-bottom:100px;
    }
    .left_bar {
        padding:10px;
        height:100%;
    }
    .center {
        width:70%;
        float:left;
        margin-top:10px;
        margin-bottom:100px;
    }
    .center_bar {
        padding:20px;
        border-right:2px solid orange;
        border-left:2px solid orange;
    }
    .right {
        width:20%;
        float:left;
        margin-top:10px;
        margin-bottom:100px;
    }
    .right_bar {
        padding:10px;
        height:100%;
    }
    .footer {
        clear:both;
        background-color: #2c3e50;
        color: white;
        padding-top:  25px;
        padding-bottom: 20px;
        padding-left: 20px;
        width: 100%;
        height: 150px;
    }

    .title {
        color: #16a085;
        padding:10px;
        font-size: 30px;
        font-weight: bold;
    }



    .board {
      padding:10px;
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


  </style>  
</head>
<body>
  <div class="container">
<?php
  require ("./BoardList_iframe_head.php");
  ?>




        <table class="table table-hover" style="width:650px" align="center">

          <tr>   
            <th class="active tableNo">No.</th>
            <th class="success">Title</th>
            <th class="warning tableName" align="center">Name</th>
            <th class="danger tableDate">Date</th>
            <th class="active tableHit">Hit</th>
          </tr>
  <?
  $board_num=0;
  if(!$board_num||$board_num==0){
    $sQuery  = "Select * From $sTableName Order By No Asc";
 
  }else{
    $sQuery  = "Select * From $sTableName where board_num = $board_num Order By No Asc";

  }
   $objRecordSet = mysql_query($sQuery, $objDBConn);  
  $iTotalRecord = mysql_num_rows($objRecordSet);

  $iNowPage = $_GET["iNowPage"];  

  if(!$iNowPage) {
    $iNowPage = 1;
  } 
    
  $iFirstRecordIdx = ($iNowPage - 1) * $iRecordPerPage;
  $iLastRecordIdx = $iFirstRecordIdx + $iRecordPerPage;
        
  if($iLastRecordIdx > $iTotalRecord) {
    $iLastRecordIdx = $iTotalRecord;
  }
    
  $iArticleNo = $iTotalRecord - $iFirstRecordIdx;      

  for($iIdx = $iFirstRecordIdx; $iIdx < $iLastRecordIdx; $iIdx++) {
    
    if(mysql_data_seek($objRecordSet, $iIdx)) {
      $objRecord = mysql_fetch_array($objRecordSet, MYSQL_ASSOC);    
      
      $iUno = $objRecord["no"]; 
      $sSubject = $objRecord["num"]; 
      $sReplyDepth = $objRecord["con"]; 

      
    } else {
      break;
    }    
    ?>

    <tr align = "center"> 
            <td><?=$iArticleNo?></td>
            <td align = "left"><a href="http://www.example.dev/board/receive.php?no=<?=$iUno?>">&nbsp;&nbsp;<?=$sSubject?></a></td>
            <td><?=$sReplyDepth?></td>
            <td>...</td>
            <td>Hit</td>
          </tr>

    <?
    $iArticleNo--;  
  }        
  
  mysql_free_result($objRecordSet);  
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
        <ul class="pagination" align="center">
          <li><a href = './BoardList.php?iNowPage=<?=$iPrevPage?>'>&laquo;</a></li>         
  <?
}      
else{
 ?>   
    <ul class="pagination" align="center">
<?
}
for($i = $iFirstPage; $i <= $iLastPage; $i++) {
  if($i == $iNowPage) {
?>
        <li class="active"><a href='./BoardList.php?iNowPage=<?=$i?>'><?=$i?></a></li>
<?
  } else {
?> 
          <li><a href='./BoardList.php?iNowPage=<?=$i?>'><?=$i?></a></li>
<?
  }
}

if($iNowBlock < $iTotalBlock) {
  $iNextPage = $iLastPage + 1;  
?>
        
        <li><a href='./BoardList.php?iNowPage=<?=$iNextPage?>'>&raquo;</a></li>
        </ul>
<?  
} 
?>         


<?php
  require ("./BoardList_iframe_foot.php");
  ?>






  </div>


  <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/respond.js"></script>




</body>
</html>











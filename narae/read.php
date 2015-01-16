<?php
session_Start();

//include "./Common.inc";  /* 게시판 관련 변수 셋팅된 모듈 파일 불러오기 */
//include "./DBConn.inc";  /* DB 연결 모듈 파일 불러오기 */

require ("./abstract.php");
$db=new DBlayer;
$db->login();
$no=$_GET['no'];
$db->gethit($no);

if(!($_SESSION['id']==$check_id)){
$db->gethit($no);
}
$iRecordPerPage = 3;  /* 1페이지당 출력되는 레코드 수 */
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
        width:10%;
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
    }
    .center_bar {
        padding:20px;
        padding-bottom:0px;
        border-right:2px solid orange;
       border-left:2px solid orange;
       min-height: 680px;
    }
    .right {
        width:20%;
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
        height: 150px;
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
  require ("./top.php");
  require ("./left.php");
  require ("./center_start.php");



$table1="board";
$table2="member";

$db->foreign_read($no, $table1, $table2);


$db->read1($no);
$check_id=$db->db_id;
printf("<input type = ".'button'." value = ".'Back'." OnClick = ".'javascript:history.back();'.">");


if($_SESSION['id']==$check_id){
  $db->read
  ?>
<form style="display: inline;" action="http://www.example.dev/board/modify.php" method="GET">
<input type="submit" value="Modify" > 
<input type = "hidden" name = "no" value = "<?=$no?>">
</form>
<form style="display: inline;" action="BoardDBmanage.php" name="Deletedata" method="POST">
<input type="button" value="Delete" onclick="javascript:Deletedata.submit();">
<input type = "hidden" name = "mode" value = "delete">
<input type = "hidden" name = "board" value = "board">
<input type = "hidden" name = "no" value = "<?=$no?>">
</form>

  <?

}

 require ("./center_end.php");
  require ("./right.php"); 
  require ("./bottom.php");  
  ?>



  </div>


  <script src="//code.jquery.com/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/respond.js"></script>




</body>
</html>




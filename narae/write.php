<?php
Session_Start();

//include "./Common.inc";  /* 게시판 관련 변수 셋팅된 모듈 파일 불러오기 */
//include "./DBConn.inc";  /* DB 연결 모듈 파일 불러오기 */
require ("./abstract.php");
$db=new DBlayer;
$db->login();
$iRecordPerPage = 2;  /* 1페이지당 출력되는 레코드 수 */
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
  require ("./top.php");
  require ("./left.php");
  require ("./center_start.php");
  ?>


<form name = "InsertForm" method = "post" action = "BoardDBPost.php">
<input type = "hidden" name = "sMode" value = "Insert">
<input type = "hidden" name = "sTableName" value = "TBL_BOARD_FREE">
<table>
  <tr>
    <td>Name</td>
    <td>
      <input type = "text" name = "sName" value = "<?=$_SESSION['name']?>" ReadOnly>
    </td>
  </tr>  
  <tr>
    <td>Subject</td>
    <td>
      <input type = "text" name = "sSubject">
    </td>
  </tr>  
  <tr>
    <td>Content</td>
    <td>
      
      <br>
      <textarea cols = "50" rows = "20" name = "sContent"></textarea>
    </td>
  </tr>  
</table>
</form>
<br>
<input type = "button" value = "Save" OnClick = "javascript:CheckInsertForm();">
<input type = "button" value = "Reset" OnClick = "javascript:InsertForm.reset();">
<input type = "button" value = "Back" OnClick = "javascript:history.back();">

<?php
 require ("./center_end.php");
  require ("./right.php"); 
  require ("./bottom.php");

  ?>
<script>

  /* 글 쓰기 입력 폼에 필수 입력 사항이 비어있는지 체크 */
  
  function CheckInsertForm() {        
  
    var objSubject = eval(document.all.sSubject);
    var objContent = eval(document.all.sContent);
             

    if(!objSubject.value || !objContent.value){
       alert("필드를 모두 입력하세요!");
     }
      InsertForm.submit();
  }
</script>  


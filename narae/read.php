<?php
session_Start();

require ("./abstract.php");
$db=new DBlayer;
$db->login();
$no=$_GET['no'];
$db->read1($no);
$check_id=$db->db_id;
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
    .ee{
      float: left;
      padding-left: 13px;
      padding-right: 40px;
      font-size: 17px;
      margin-top: 170px;
    }
     .bb{
      float: left;
       width: 475px;
       margin: 0px;
  
       margin-bottom: 40px;
    }
    .ff{
      float: left;
       width: 530px;
       margin: 0px;
  
       margin-bottom: 40px;
    }
    .cc{
      float: left;
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
$boardNo = $_GET["no"];


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

  ?>

<h3 class="topic"><u><?=$iUno?></u></h3> 



<table class="table">
<tr>
<td>Title</td>
    <td colspan=3>
      <input type = "text" name = "id" class="form-control cc"  value = "<?=$a?>" ReadOnly>
    </td>
</tr>

 <tr>
    <td>Name</td>
    <td>
      <input type = "text" name = "id" class="form-control"  value = "<?=$b?>" ReadOnly>
    </td>
    <td>Start Date</td>
    <td>
      <input type = "text" name = "id" class="form-control"  value = "<?=$c?>" ReadOnly>
    </td>
 


  </tr>
  <tr>
    <td>Hit</td>
    <td>
      <input type = "text" name = "id" class="form-control"  value = "<?=$d?>" ReadOnly>
    </td>
    <td>Last Date</td>
    <td>
      <input type = "text" name = "id" class="form-control"  value = "<?=$e?>" ReadOnly>
    </td>
  </tr> 
  </table>
  <div>
    <div class="ee">Content</div>
    <div class="ff">
      <textarea  class="form-control" rows = "17" name = "scontent" ReadOnly><?=$f?></textarea>
    </div>
  </div> 
  <?

$table1="board";
$table2="member";
//$db->foreign_read($no, $table1, $table2);



$db->read1($no);
$check_id=$db->db_id;


$id=$_SESSION['id'];
$db->check_grade($id);
$db->read;

if(!(($_SESSION['id']==$check_id) or ($db->check_grade=='GOD'))){




?>
<div align="center">
<button type = "button" class="btn btn-danger" OnClick = "javascript:history.back();">Back</button>
</div>
<?

}else{

//}





//if(($_SESSION['id']==$check_id) or ($db->check_grade=='GOD')){
  if(!($_SESSION['id']==$check_id)){
  ?>
<form id="ajax" style="display: inline;" action="BoardDBmanage.php" name="Deletedata" method="POST">
<div align="center">
<button type = "button" class="btn btn-danger" OnClick = "javascript:history.back();">Back</button>
<button type = "submit" class="btn btn-danger">Delete</button>
</div>
<!--<input type="button" value="Delete" onclick="javascript:Deletedata.submit();">-->
<input type = "hidden" name = "mode" value = "delete">
<input type = "hidden" name = "board" value = "board">
<input type = "hidden" name = "no" value = "<?=$no?>">
</form>

  <?
}
else if(!($db->check_grade=='GOD')){
  ?>

<!--
<form style="display: inline;" action="http://www.example.dev/board/modify.php" method="GET">
<div align="center" class="cc">
<button type = "submit" class="btn btn-danger">Modify</button>
</div>
<input type="submit" value="Modify" > 
<input type = "hidden" name = "no" value = "<?=$no?>">
</form>

-->




<form id="ajax" style="display: inline;" action="BoardDBmanage.php" name="Deletedata" method="POST">
<div align="center">
<button type = "button" class="btn btn-danger" OnClick = "javascript:history.back();">Back</button>
<a href="http://www.example.dev/board/modify.php?boardNum=<?=$boardNum?>&&no=<?=$boardNo?>"><button type="button" class="btn btn-danger">Modify</button></a>
<button type = "submit" class="btn btn-danger">Delete</button>
<!--<input type="button" value="Delete" onclick="javascript:Deletedata.submit();">-->
<input type = "hidden" name = "mode" value = "delete">
<input type = "hidden" name = "board" value = "board">
<input type = "hidden" name = "no" value = "<?=$no?>">
</div>
</form>
  <?

}

else {

?>
<!--

<form style="display: inline;" action="http://www.example.dev/board/modify.php" method="GET">
<div align="center" class="cc">
<button type = "submit" class="btn btn-danger">Modify</button>
</div>
<input type="submit" value="Modify" > 
<input type = "hidden" name = "no" value = "<?=$no?>">

-->




</form>
<form id="ajax" style="display: inline;" action="BoardDBmanage.php" name="Deletedata" method="POST">
<div align="center">
<button type = "button" class="btn btn-danger" OnClick = "javascript:history.back();">Back</button>
<a href="http://www.example.dev/board/modify.php?boardNum=<?=$boardNum?>&&no=<?=$boardNo?>"><button type="button" class="btn btn-danger">Modify</button></a>
<button type = "submit" class="btn btn-danger">Delete</button>
<!--<input type="button" value="Delete" onclick="javascript:Deletedata.submit();">-->
<input type = "hidden" name = "mode" value = "delete">
<input type = "hidden" name = "board" value = "board">
<input type = "hidden" name = "no" value = "<?=$no?>">
</div>
</form>
  <?


}
}

?>




<hr>

  <div class="comment-block">
  <?php
  $db->showcomments($no);

  $com_count=$db->commentcount;
  for($i=0; $i<$com_count; $i++){
    $com_id[]=$db->commentid[$i];
    $com_com[]= $db->commentcom[$i];
    $com_time[]=$db->commenttime[$i];
    $com_number[]=$db->commentnum[$i];

?>
    <h4>
    <?php
    echo $com_id[$i];
    ?></h4>
    <span><?php
    echo $com_time[$i];
    ?></span>
    <p><h4>
    <?php
    echo $com_com[$i];
    ?>
    </h4>
    <form name="Deletecomment" action="BoardDBmanage.php" method="POST">
    <input type="hidden" name="comment_num" value="<?=$com_number[$i]?>">
    <input type="submit" id="comment_delete" value="Delete">
    <input type="hidden" name="mode" value="com_del">
    </form>
    </p><br>
<?php
  }
?>
    <!-- comment will be apped here from db-->
  </div>
         
  <!-- comment form -->
  <form id="form" method="post">
    <!-- need to supply post id with hidden fild -->
    <input type="hidden" name="postno" value="<?=$no?>">
    <label>
      <span>ID *</span>
            <input type = "text" name = "id" size="9" value = "<?=$_SESSION['id']?>" ReadOnly>
    </label>
        <input type="submit" id="submit" value="Submit">

    <label>
      <textarea name="comment" id="comment" cols="70" rows="3" placeholder="Type your comment here...." required></textarea>
    </label>
  </form>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
$(document).ready(function(){
  var form = $('#form');
  var submit = $('#submit');

  form.on('submit', function(e) {
    // prevent default action
    e.preventDefault();
    // send ajax request
    $.ajax({
      url: 'comment.php',
      type: 'POST',
      cache: false,
      data: form.serialize(), //form serizlize data
      beforeSend: function(){
        // change submit button value text and disabled it
        submit.val('Submitting...').attr('disabled', 'disabled');
      },
      success: function(data){
        // Append with fadeIn see http://stackoverflow.com/a/978731
        var item = $(data).hide().fadeIn(800);
        $('.comment-block').append(item);

        // reset form and button
        form.trigger('reset');
        submit.val('Submit').removeAttr('disabled');
      },
      error: function(e){
        alert(e);
      }
    });
  });
});

</script>





<?


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




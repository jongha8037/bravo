<?php
session_Start();

require ("./abstract.php");
$db=new DBlayer;
$db->login();
$no=$_GET['no'];
$boardNum = $_GET["boardNum"];
$boardNo = $_GET["no"];
$db->read1($no);
$check_id=$db->db_id;
if(!($_SESSION['id']==$check_id)){
$db->gethit($no);
}
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
?>
      <div class="center">
        <div class="center_bar">
          <h3 class="topic"><u><?=$iUno?></u></h3> 

          <table class="table">
            <tr>
              <td>Title</td>
              <td colspan=3>
                <input type = "text" name = "id" class="form-control"  value = "<?=$a?>" ReadOnly>
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
            <div class="read-content1">Content</div>
            <div class="read-content2">
              <textarea  class="form-control" rows = "17" name = "scontent" ReadOnly><?=$f?></textarea>
            </div>
          </div> 
<?
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
  if(!($_SESSION['id']==$check_id)){
?>
          <form style="display: inline;" action="BoardDBmanage.php" name="Deletedata" method="POST">
            <div align="center">
              <button type = "button" class="btn btn-danger" OnClick = "javascript:history.back();">Back</button>
              <button type = "submit" class="btn btn-danger">Delete</button>
            </div>
            <input type = "hidden" name = "mode" value = "delete">
            <input type = "hidden" name = "board" value = "board">
            <input type = "hidden" name = "no" value = "<?=$no?>">
          </form>
<?
  }else if(!($db->check_grade=='GOD')){
?>
          <form style="display: inline;" action="BoardDBmanage.php" name="Deletedata" method="POST">
            <div align="center">
              <button type = "button" class="btn btn-danger" OnClick = "javascript:history.back();">Back</button>
              <a href="http://www.example.dev/board/modify.php?boardNum=<?=$boardNum?>&&no=<?=$boardNo?>"><button type="button" class="btn btn-danger">Modify</button></a>
              <button type = "submit" class="btn btn-danger">Delete</button>
            </div>
            <input type = "hidden" name = "mode" value = "delete">
            <input type = "hidden" name = "board" value = "board">
            <input type = "hidden" name = "no" value = "<?=$no?>">
          </form>
<?
  }else{
?>
          <form style="display: inline;" action="BoardDBmanage.php" name="Deletedata" method="POST">
            <div align="center">
              <button type = "button" class="btn btn-danger" OnClick = "javascript:history.back();">Back</button>
              <a href="http://www.example.dev/board/modify.php?boardNum=<?=$boardNum?>&&no=<?=$boardNo?>"><button type="button" class="btn btn-danger">Modify</button></a>
              <button type = "submit" class="btn btn-danger">Delete</button>
            </div>
            <input type = "hidden" name = "mode" value = "delete">
            <input type = "hidden" name = "board" value = "board">
            <input type = "hidden" name = "no" value = "<?=$no?>">
          </form>
<?
  }
}
$db->showcomments($no);
$com_count=$db->commentcount;

for($i=0; $i<$com_count; $i++){
  $com_id[]=$db->commentid[$i];
  $com_com[]= $db->commentcom[$i];
  $com_time[]=$db->commenttime[$i];
  $com_number[]=$db->commentnum[$i];
?>
          <hr>
          <div class="comment-block">
            <h4><?php echo $com_id[$i];?></h4>
            <h4><?php echo $com_time[$i];?></h4>
            <h4><?php echo $com_com[$i];?></h4>

            <form name="Deletecomment" action="BoardDBmanage.php" method="POST">
              <input type="hidden" name="comment_num" value="<?=$com_number[$i]?>">
              <input type="hidden" name="postno" value="<?=$boardNo?>">
              <input type="submit" id="comment_delete" value="Delete">
              <input type="hidden" name="mode" value="com_del">
            </form>





   <button type="button" data-toggle="modal" data-target="#myModal<?=$i?>">Modify</button>
  <div class="modal fade" id="myModal<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Modify</h4>
      </div>
      <div class="modal-body">
      <form id="form_mod" action="BoardDBmanage.php" method="POST">
      <textarea name="comment_body" id="comment_body" cols="68" rows="3" placeholder="Type your comment here...." required></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Save changes">
        <input type="hidden" name="mode" value="com_mod">
        <input type="hidden" name="number" value="<?=$i?>">
    <input type="hidden" name="comment_no" value="<?=$com_number[$i]?>">
      </form>  
      </div>
    </div>
  </div>
</div>
</div>


<?php
}
?>
          
        <form id="form" method="post">
          <input type="hidden" name="postno" value="<?=$no?>">
          <input type="hidden" name="comment_no" value="<?=$com_number[$i]?>">
          <label>
            <span>ID *</span>
            <input type = "text" name = "id" size="9" value = "<?=$_SESSION['id']?>" ReadOnly>
          </label>
          <input type="submit" id="submitt" value="Submit">
          <label>
           <textarea name="comment" id="comment" cols="70" rows="5" placeholder="Type your comment here...." required></textarea>
          </label>
        </form>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>  
$(document).ready(function(){
  var form = $('#form');
  var submit = $('#submit');
  var form1 = $('#form1');
  var submit1 = $('#submit1');

  form.on('submit', function(e) {

    e.preventDefault();

    $.ajax({
      url: 'comment.php',
      type: 'POST',
      cache: false,
      data: form.serialize(), 
      beforeSend: function(){
        submit.val('Submitting...').attr('disabled', 'disabled');
      },
      success: function(data){
        var item = $(data).hide().fadeIn(800);
        $('.comment-block').append(item);
        location.reload();

        form.trigger('reset');
        submit.val('Submit').removeAttr('disabled');

      },
      error: function(e){
        alert(e);
      }
    });
  });
});

$("#modi_comment").click(function() {
  $( "#form_mod" ).attr({action:'BoardDBmanage.php', method:'post'}).submit();
  $("#comment_body").val('');
});
</script>

        

      </div>
    </div>

<?
require ("./right.php"); 
require ("./bottom.php");  
?>
    </div>

  <script src="//code.jquery.com/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/respond.js"></script>
  </body>
</html>




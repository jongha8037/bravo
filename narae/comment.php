<?php
session_Start();

if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'])):
require ("../board/abstract.php");
$db=new DBlayer;
$db->login();


if (!empty($_POST['id']) AND !empty($_POST['comment']) AND !empty($_POST['postno'])){
  $id = mysqli_real_escape_string($db->link, $_POST['id']);
  $comment = mysqli_real_escape_string($db->link, $_POST['comment']);
  $postno = mysqli_real_escape_string($db->link, $_POST['postno']);

  mysqli_query($db->link, "INSERT INTO comment(id, comment, no) VALUES('{$id}', '{$comment}', '{$postno}')");  

  $sQuery  = "Select * From board where no= $postno";
  $objRecordSet = mysqli_query($db->link, $sQuery);  
  $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);
  $iUno = $objRecord['comment_num'];
  $iUno = $iUno+1;

  mysqli_query($db->link, "update board set comment_num=$iUno where no= $postno");  
}
?>

<div class="comment-item">
  <div class="comment-post">
    <h4><?php echo $id;?></h4>
    <h4><?php echo date("Y-m-d h:i:s");?></h4>
    <h4><?php echo $comment;?></h4>
    <form method="POST" action="./BoardDBmanage.php">
    <input type="button" name="comment_delete" value="Delete">
    <input type="hidden" name="comment_num" value="<?=$bb?>">
    <input type="hidden" name="mode" value="com_del">
    </form>

    <form id="form_mod">
      <input type="hidden" name="comment_no" value="<?=$com_number[$i]?>">
      <input type="hidden" name="mode" value="com_mod">
      <button type="button" data-toggle="modal" data-target="#myModal">Modify</button>
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Modify</h4>
            </div>
            <div class="modal-body">
              <textarea name="comment_body" id="comment_body" cols="68" rows="3" placeholder="Type your comment here...." required></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="modi_comment" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<?php
mysqli_close($db->link);

endif;
?>

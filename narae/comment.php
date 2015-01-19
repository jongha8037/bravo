<?php
session_Start();

if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] )):


require ("../board/abstract.php");
  // connecting to db
$db=new DBlayer;
$db->login();

  
  if (!empty($_POST['id']) AND !empty($_POST['comment']) AND !empty($_POST['postno'])) {
    // preventing sql injection
    $id = mysqli_real_escape_string($db->link, $_POST['id']);
    $comment = mysqli_real_escape_string($db->link, $_POST['comment']);
    $postno = mysqli_real_escape_string($db->link, $_POST['postno']);
    // insert new comment into comment table
    mysqli_query($db->link, "
      INSERT INTO comment
      (id, comment, no)
      VALUES('{$id}', '{$comment}', '{$postno}')");  
  }
?>
<!-- sending response with new comment and html markup-->
<div class="comment-item">
  <div class="comment-post">
    <h4>
    <?php
    echo $id;
    ?>
    </h4>
      <span><?php
    echo date("Y-m-d H:i:s");
    ?></span>
    <p><h4>
    <?php
    echo $comment;
    ?>
    </h4>
    <form method="POST" action="./BoardDBmanage.php">
    <input type="button" name="comment_delete" value="Delete">
    <input type="hidden" name="mode" value="com_del">
    </form></p><br>
  </div>
</div>

<?php

  // close connection
  mysqli_close($db->link);
endif;
?>
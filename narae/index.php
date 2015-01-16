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
    <h3>
    <?php
    echo $id;
    ?>

    <span>said....</span></h3>
    <p>
    <?php
    echo $comment;
    ?>
    </p>
  </div>
</div>

<?php

  // close connection
  mysqli_close($db->link);
endif;
?>
<?php
session_Start();

if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] )):


require ("../board/abstract.php");
  // connecting to db
$db=new DBlayer;
$db->login();

   $objRecordSet = mysqli_query($db->link, "select * from comment where num=$_POST['comment_num']");
   $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);
     $iUno = $objRecord['comment'];

 
?>
<!-- sending response with new comment and html markup-->
<div class="comment-item">
  <div class="comment-post">
    <h4>
    <?php
    echo $iUno;
    ?>
    </h4>
    <p>
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
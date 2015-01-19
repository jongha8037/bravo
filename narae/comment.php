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

 $sQuery  = "Select * From comment";
 $objRecordSet = mysqli_query($db->link, $sQuery);
 $aa = mysqli_num_rows($objRecordSet);


for($iIdx = 0; $iIdx < $aa; $iIdx++) {
    
   if(mysqli_data_seek($objRecordSet, $iIdx)) {
      $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);   
      
      $bb = $objRecord["num"];
      
    }
  }


 //echo "$aa";
// var_dump($aa);
//    $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);
    

 $sQuery  = "Select * From board where no= $postno";

  $objRecordSet = mysqli_query($db->link, $sQuery);  
    $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);
     $iUno = $objRecord['comment_num'];
     $iUno = $iUno+1;

  mysqli_query($db->link, "update board set comment_num=$iUno where no= $postno");  
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
    echo date("Y-m-d h:i:s");
    ?></span>
    <p><h4>
    <?php
    echo $comment;
   var_dump($bb);
    ?>
    </h4>
     <form method="POST" action="./BoardDBmanage.php">
    <input type="button" name="comment_delete" value="Delete">
    <input type="hidden" name="comment_num" value="<?=$bb?>">
    <input type="hidden" name="mode" value="com_del">
    </form>


    </p><br>
  </div>
</div>

<?php

  // close connection
  mysqli_close($db->link);
endif;
?>
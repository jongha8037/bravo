<?php
require ("./abstract.php");
$db=new DBlayer;
$db->login();

$mode = $_REQUEST["mode"];
$sID = $_POST["id"];
$sSubject = $_POST["subject"];
$sContent = $_POST["scontent"];
$sBoardNum = $_REQUEST["board_num"];
$sBoardname = $_POST["boardname"];
$sNo = $_POST["modifyno"];
$no=$_POST['no'];
$num=$_POST['postno'];
$com_num=$_POST['comment_num'];
$comment_numm=$_POST['comment_no'];
$comment_body=$_POST['comment_body'];
$sDate = date("Y-m-d", time());

if($mode == "boardcreate"){
  $sQuery = "Select * From board_direction";
  $objRecordSet = mysqli_query($db->link, $sQuery);
  $iTotalRecord = mysqli_num_rows($objRecordSet);

  $aa=0;
  $bb=0;
  for($iIdxx = 0; $iIdxx < $iTotalRecord; $iIdxx++){
    if(mysqli_data_seek($objRecordSet, $iIdxx)){
      $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);   
      $iUno = $objRecord["board_num"];
      $iUname = $objRecord["board_name"];

      if($sBoardname==$objRecord["board_name"]){
       $bb=1;
      }

      if($aa<$iUno){
        $aa=$iUno;
      }
    }    
  }
  $aa = $aa+1;

  if($bb==1){
    $sAlertMessage = "Board already exists!!";
  }else{
    $sQuery = "Insert Into board_direction Values($aa,'$sBoardname')";
    $objRecordSet = mysqli_query($db->link, $sQuery); 
    $sAlertMessage = "Board is created!!";    
  }
}


if($mode == "boarddelete"){
  $sQuery = "Select * From board_direction";
  $objRecordSet = mysqli_query($db->link, $sQuery);
  $iTotalRecord = mysqli_num_rows($objRecordSet);

  for($iIdxx = 0; $iIdxx < $iTotalRecord; $iIdxx++){
    if(mysqli_data_seek($objRecordSet, $iIdxx)){
        $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);   

      if($sBoardname == $objRecord["board_name"]){
        $iUno = $objRecord["board_num"];
        break;
      }

    } 

    if(!$objRecordSet){
    $sAlertMessage = "There is no Board!!";
    }else{
    $sAlertMessage = "Board is deleted!!";    
    }
  }

  $sQuery = "delete From board where board_num=$iUno";
  $objRecordSet = mysqli_query($db->link, $sQuery);

  $sQuery = "delete From board_direction where board_num=$iUno";
  $objRecordSet = mysqli_query($db->link, $sQuery);
}


if($mode == "insert"){
  $sQuery  = "Insert Into board Values('','$sID','$sSubject', '$sContent', '$sDate','$sDate',0,$sBoardNum,0)";
  $bDBResult = mysqli_query($db->link, $sQuery); 

  $sQuery  = "Select point From member where id='$sID'";
  $objRecordSet = mysqli_query($db->link, $sQuery);  
  $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);         
  $iUno = $objRecord['point'];
  $iUno = $iUno + 5;

  $sQuery  = "Update member set point=$iUno where id='$sID'";
  $bDBResult = mysqli_query($db->link, $sQuery); 

  $sAlertMessage = "Article is entered.";
}


if($mode == "modify") {
  $sQuery  = "update board set title='$sSubject', content='$sContent',last_date= '$sDate' where no=$sNo";
  $bDBResult = mysqli_query($db->link, $sQuery); 

  $sAlertMessage = "Board is modified.";      
}


if($mode=="delete"){
  $db->delete($no);
  $sAlertMessage = "Article is delete.";
}


if($mode=="com_del"){
  $db->comment_delete($com_num);

  $sQuery  = "Select * From board where no= $num";
  $objRecordSet = mysqli_query($db->link, $sQuery);  
  $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);
  $iUno = $objRecord['comment_num'];
  $iUno = $iUno-1;

  mysqli_query($db->link, "update board set comment_num=$iUno where no= $num"); 
  echo("<script language='javascript'>history.go(-1);</script>"); 
  exit;
}


if($mode=="com_mod"){
  var_dump($com_num);

  $sQuery  = "update comment set comment='".$comment_body."' where num=".$comment_numm;
  $bDBResult = mysqli_query($db->link, $sQuery); 
  echo $comment_numm;
  echo("<script language='javascript'>history.go(-1);</script>"); 
  exit;
}


?>            

<script>
  alert("<?=$sAlertMessage?>");
  location.href = "BoardList.php";
</script>

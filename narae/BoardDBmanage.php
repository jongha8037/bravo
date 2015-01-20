<?php
require ("./abstract.php");
$db=new DBlayer;
$db->login();

$mode = $_REQUEST["mode"];
$tableName = $_REQUEST["board"];
$boardNum = $_REQUEST["board_num"];

$sID = $_POST["id"];
$sSubject = $_POST["subject"];
$sContent = $_POST["scontent"];
$sBoardname = $_POST["boardname"];


$sDate = date("Y-m-d", time());




if($mode == "boardcreate"){
  $sQuery = "Select * From board_direction";
    $objRecordSet = mysqli_query($db->link, $sQuery);
   $iTotalRecord = mysqli_num_rows($objRecordSet);

     $aa=0;
     $bb=0;
   for($iIdxx = 0; $iIdxx < $iTotalRecord; $iIdxx++) {
    
   if(mysqli_data_seek($objRecordSet, $iIdxx)) {
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

    for($iIdxx = 0; $iIdxx < $iTotalRecord; $iIdxx++) {
    
   if(mysqli_data_seek($objRecordSet, $iIdxx)) {
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

  echo "$iUno";

  $sQuery = "delete From board where board_num=$iUno";
    $objRecordSet = mysqli_query($db->link, $sQuery);
 
$sQuery = "delete From board_direction where board_num=$iUno";
     $objRecordSet = mysqli_query($db->link, $sQuery);


}







if($mode == "insert") {

  /* 글 쓰기 폼에 입력된 각각의 값들을 게시판 테이블의 새 레코드로 삽입 */

  $sQuery  = "Insert Into board Values";
  $sQuery .= "  ('','$sID','$sSubject', '$sContent', '$sDate','$sDate',0,$boardNum,0) ";

  $bDBResult = mysqli_query($db->link, $sQuery); 



    $sQuery  = "Select point From member where id='$sID'";
  $objRecordSet = mysqli_query($db->link, $sQuery);  

  $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);         
      $iUno = $objRecord['point'];
 


      $iUno = $iUno + 5;

  $sQuery  = "Update member set point=$iUno where id='$sID'";
    $bDBResult = mysqli_query($db->link, $sQuery); 

  $sAlertMessage = "Insert";
}


if($mode == "modify") {



$sNo = $_POST["modifyno"];


  $sQuery  = "update board set title='$sSubject', content='$sContent',last_date= '$sDate' where no=$sNo";

  $bDBResult = mysqli_query($db->link, $sQuery); 

  if(!$bDBResult){
$sAlertMessage = "게시판이 없습니다.";
  }else{
$sAlertMessage = "Board is modified.";    
  }


}



if($mode=="delete") {
 $no=$_POST['no'];
 $db->delete($no);
$sAlertMessage = "Delete";
}

if($mode=="com_del") {
  $com_num=$_POST['comment_num'];

  $db->comment_delete($com_num);

/*
$sQuery  = "Select * From board where no= $postno";

  $objRecordSet = mysqli_query($db->link, $sQuery);  
    $objRecord = mysqli_fetch_array($objRecordSet, MYSQL_ASSOC);
     $iUno = $objRecord['comment_num'];
     $iUno = $iUno+1;

  mysqli_query($db->link, "update board set comment_num=$iUno where no= $postno"); 
*/

 echo("<script language='javascript'>history.go(-1);</script>"); 
}

if($mode=="com_mod") {
  $comment_num=$_POST['comment_no'];
  $comment_body=$_POST['comment_body'];
  $sQuery  = "update comment set comment='".$comment_body."' where num=".$comment_num;
  $bDBResult = mysqli_query($db->link, $sQuery); 
 echo("<script language='javascript'>history.go(-1);</script>"); 
}
?>            
<script>
  alert("<?=$sAlertMessage?>");
  location.href = "BoardList.php";
</script>

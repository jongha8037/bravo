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




//$sSubject = addslashes($sSubject);
//$sContent = addslashes($sContent);  
    
$sDate = date("Y-m-d", time());

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

  $sAlertMessage = "aaaaaaaaaaaaa";
}

if($mode=="modify") {
  $no=$_POST['no'];
  $sub=$_POST['subject'];
  $con=$_POST['scontent'];
  $db->update($sub, $con, $no);

}

if($mode=="delete") {
 $no=$_POST['no'];
 $db->delete($no);
}

?>            
<script>
  alert("<?=$sAlertMessage?>");
  location.href = "BoardList.php";
</script>

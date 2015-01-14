<?
include "./DBConn.inc";  /* DB 연결 모듈 파일 불러오기 */

$sMode = $_REQUEST["sMode"];
$sTableName = $_REQUEST["sTableName"];

$sID = $_POST["sID"];
$sSubject = $_POST["sSubject"];
$sContent = $_POST["sContent"];
$sHTMLTag = $_POST["sHTMLTag"];

if($sMode == "Insert") {

   /* 게시판 테이블의 고유 번호 및 그룹 번호에 해당되는 각각의 필드 Max 값 추출 */

  $sQuery = "Select Max(iUno), Max(iGno) From $sTableName";
  $objRecordSet = mysql_query($sQuery, $objDBConn);
  $objRecord = mysql_fetch_row($objRecordSet);
  
  if($objRecord[0]) {
    $iNewUno = $objRecord[0] + 1;
  } else {
    $iNewUno = 1;
  }
    
  if($objRecord[1]) {
    $iNewGno = $objRecord[0] + 1;
  } else {
    $iNewGno = 1;
  }
    
  $sReplyDepth = "A";
} 

$sSubject = addslashes($sSubject);
$sContent = addslashes($sContent);  
    
$sRegDate = date("Y-m-d", time());
$sClientIP = getenv("REMOTE_ADDR");

if($sMode == "Insert") {

  /* 글 쓰기 폼에 입력된 각각의 값들을 게시판 테이블의 새 레코드로 삽입 */

  $sQuery  = "Insert Into $sTableName ";
  $sQuery .= "  (iUno, iGno, sReplyDepth, sID, sSubject, sContent, sHTMLTag, sRegDate, sClientIP) ";
  $sQuery .= "    Values ";
  $sQuery .= "  ('$iNewUno', '$iNewGno', '$sReplyDepth', '$sID', '$sSubject', '$sContent', '$sHTMLTag', '$sRegDate', '$sClientIP') ";
  
  $bDBResult = mysql_query($sQuery, $objDBConn);
  
  $sAlertMessage = "게시물이 등록되었습니다!";
}
?>            
<script>
  alert("<?=$sAlertMessage?>");
  location.href = "BoardList.php";
</script>

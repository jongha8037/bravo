<?
#ob_Start();
#Session_Start();#

#/* 로그인 아이디가 저장된 세션 변수가 비어있을 경우 메시지 출력 */#

#if($_SESSION['MEMBER_ID'] == "") {
#?>
<!--  <script>
    alert("먼저 로그인하세요!");
    history.back();
  </script>  -->
  <?  
#  exit(0);
#}
#?>

<body>
<form name = "InsertForm" method = "post" action = "BoardDBPost.php">
<input type = "hidden" name = "sMode" value = "Insert">
<input type = "hidden" name = "sTableName" value = "TBL_BOARD_FREE">
<table>
  <tr>
    <td>ID</td>
    <td>
      <input type = "text" name = "sID" value = "<?=$_SESSION['MEMBER_ID']?>" ReadOnly>
    </td>
  </tr>  
  <tr>
    <td>Subject</td>
    <td>
      <input type = "text" name = "sSubject">
    </td>
  </tr>  
  <tr>
    <td>Content</td>
    <td>
      
      <br>
      <textarea cols = "50" rows = "20" name = "sContent"></textarea>
    </td>
  </tr>  
</table>
</form>
<br>
<input type = "button" value = "Save" OnClick = "javascript:CheckInsertForm();">
<input type = "button" value = "Reset" OnClick = "javascript:InsertForm.reset();">
<input type = "button" value = "Back" OnClick = "javascript:history.back();">
<script>

  /* 글 쓰기 입력 폼에 필수 입력 사항이 비어있는지 체크 */
  
  function CheckInsertForm() {        
  
    var objSubject = eval(document.all.sSubject);
    var objContent = eval(document.all.sContent);
                
    if(!objSubject.value) {
       alert("제목을 입력하세요!");
       objSubject.focus();       
       return;         
     }   
     
     if(!objContent.value) {
       alert("내용을 입력하세요!");
       objContent.focus();       
       return;         
     }   
                            
    InsertForm.submit();
  }
</script>  


<script>

  /* 회원 가입 입력 폼에 필수 입력 사항이 비어있는지 체크 */

  function CheckValidID() { 
    var objID = eval(document.all.sID);
            
    if(!objID.value) {
       alert("ID를 입력하세요!");
       objID.focus();       
       return;         
     }            
      
    /* ID 중복 체크하는 윈도우 열기 */  

    window.open("./CheckValidID.php?sID=" + objID.value, "", "width = 400, height = 120, status = no");  
  }
  
  function CheckInsertForm() {
    
    var objID = eval(document.all.sID);
    var objPW = eval(document.all.sPW);
    var objName = eval(document.all.sName);
    
    if(!objID.value) {
       alert("ID를 입력하세요!");
       objID.focus();       
       return;         
     }            

    if(!objPW.value) {
       alert("Password를 입력하세요!");
       objPW.focus();       
       return;         
     }      
     
    if(!objName.value) {
       alert("이름을 입력하세요!");
       objName.focus();       
       return;         
     }              
                            
    InsertForm.submit();
  }
</script>  
<body>
<form name = "InsertForm" method = "post" action = "MemberDBPost.php">
<table>
  <tr>
    <td>ID</td>
    <td>
      <input type = "text" name = "sID">
      <input type = "button" value = "Check ID" OnClick = "javascript:CheckValidID();">
    </td>
  </tr>  
  <tr>
    <td>Password</td>
    <td>
      <input type = "password" name = "sPW">
    </td>        
  </tr>  
  <tr>
    <td>Name</td>
    <td>
      <input type = "text" name = "sName">
    </td>        
  </tr>  
  <tr>
    <td>E-Mail</td>
    <td>
      <input type = "text" name = "sEMail">
    </td>        
  </tr>    
  <tr>
    <td>Sex</td>
    <td>
      <input type = "radio" name = "sSex" value = "M">Male
      <input type = "radio" name = "sSex" value = "F">Female
    </td>        
  </tr>          
  <tr>
    <td>BirthDay</td>
    <td>
      <input type = "text" name = "sBirthDay_YYYY">
      -
      <input type = "text" name = "sBirthDay_MM">
      -
      <input type = "text" name = "sBirthDay_DD">      
    </td>        
  </tr>    
  <tr>
    <td>Homepage</td>
    <td>
      <input type = "text" name = "sHomepage" value = "http://">
    </td>        
  </tr>      
  <tr>
    <td>Company</td>
    <td>
      <input type = "text" name = "sCompany">      
    </td>        
  </tr>        
  <tr>
    <td>Introduction</td>
    <td>
      <textarea cols = "50" rows = "20" name = "sIntroduction"></textarea>
    </td>        
  </tr>                      
</table>
</form>
<br>
<input type = "button" value = "Join" OnClick = "javascript:CheckInsertForm();">
<input type = "button" value = "Reset" OnClick = "javascript:InsertForm.reset();">
<input type = "button" value = "Back" OnClick = "javascript:history.back();">
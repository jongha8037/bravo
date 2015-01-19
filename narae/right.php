<?php
session_start();
if(!isset($_SESSION['is_login'])){
   
  //  header('Location: ../login/login.html');
    ?>
      <script type="text/javascript">
      alert("You do not have permission.");</script>
<meta http-equiv="refresh" content="0; url=http://www.example.dev/login/login.html">
    <?
//header("location: http://www.naver.com");
}

?>
        
         <table class="table" style="text-align: center; margin-top:40px;" >
        <tr>
        <th colspan="3">Welcome!!&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['name'];?></th>

        </tr>
        <tr>
        <td><a href="../login/logout.php">Logout</a></td>
        <td><a href="../login/modify.html">Modify</a></td>
        <td><a href="../login/ok_bye.html">Bye... </a></td>
        </tr>

<?php
        $db=new DBlayer;
        $db->login();
        $id=$_SESSION['id'];
        $db->member_point($id);

        ?>


        <tr>
        <td>POINT</td><td colspan="2"><?echo $db->point;?></td>
        </tr>
        <?  
        $db=new DBlayer;
        $db->login();
        $id=$_SESSION['id'];
        $db->member_grade($id);
        ?>


        <tr>
        <td>GRADE</td><td colspan="2"><?echo $db->grade;?></td>
        </tr>
        </table>
      </div>
    </div>
  <?php
//ob_Start();
//Session_Start();

//include "./Common.inc";  /* 게시판 관련 변수 셋팅된 모듈 파일 불러오기 */
//include "./DBConn.inc";  /* DB 연결 모듈 파일 불러오기 */

$mysqli_hostname = $_ENV['MYSQL_HOST'];
$mysqli_user = $_ENV['MYSQL_USER'];
$mysqli_password = $_ENV['MYSQL_PSWD'];
$mysqli_database = $_ENV['MYSQL_DB'];

$link = mysqli_connect($mysqli_hostname, $mysqli_user, $mysqli_password) or die("internal error1");
mysqli_select_db($link, $mysqli_database) or die("internal error2");
$iRecordPerPage = 3;  /* 1페이지당 출력되는 레코드 수 */
$iPagePerBlock = 2;  /* 1블럭당 출력되는 페이지 수 */


$sTableName = "aa"
?>

<html>
<head>
  <title></title>
  <meta http-equiv="Content-type" content="text/html; charset=utf8">
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

  <style type="text/css">
    .container {
        max-width:1024px;
        line-height:1.5em;
        margin: auto;
    }
    .header {
        width:100%;
        height:50px;
        border-bottom:5px #bdc3c7;
        border-bottom-style: dashed;
    }
    .left {
        width:10%;
        float:left;
        margin-top:10px;
        margin-bottom:100px;
    }
    .left_bar {
        padding:10px;
        height:100%;
    }
    .center {
        width:70%;
        float:left;
        margin-top:10px;
        margin-bottom:100px;
    }
    .center_bar {
        padding:20px;
        border-right:2px solid orange;
        border-left:2px solid orange;
    }
    .right {
        width:20%;
        float:left;
        margin-top:10px;
        margin-bottom:100px;
    }
    .right_bar {
        padding:10px;
        height:100%;
    }
    .footer {
        clear:both;
        background-color: #2c3e50;
        color: white;
        padding-top:  25px;
        padding-bottom: 20px;
        padding-left: 20px;
        width: 100%;
        height: 150px;
    }

    .title {
        color: #16a085;
        padding:10px;
        font-size: 30px;
        font-weight: bold;
    }



    .board {
      padding:10px;
    }

    .tableNo{
      width: 50px;

    }
    .tableTitle{
      width: 100px;
      
    }
    .tableName{
      width: 100px;
      
    }
    .tableDate{
      width: 100px;
      
    }
    .tableHit{
      width: 60px;
      
    }
  </style>  
</head>
<body>
  <div class="container">

  <?php
  require ("./BoardList_iframe_head.php");

//include('abstract.php');

$no=$_GET['no'];
$table="aa";



		$query="select * from ".$table." where no=".$no;
		$result1=mysqli_query($link, $query	) or die("wrong query"); #error
		$tot=mysqli_num_rows($result1);
		$rows=mysqli_fetch_array($result1, MYSQLI_ASSOC);

		$db_no=$rows[no];
		$db_num=$rows[num];
		$db_con=$rows[con];
		echo "no : ".$db_no."<br>";
		echo "num : ".$db_num."<br>";
		echo "con : ".$db_con. "<br>";

require ("./BoardList_iframe_foot.php");
  ?>



  </div>


  <script src="//code.jquery.com/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/respond.js"></script>




</body>
</html>




<?php
class DBlayer{
	public $no;
	public $id;
	public $db;
	public $link;
	public $hit;
	public $title=NULL;
	public $content=NULL;
	public $start_date=NULL;
	public $last_date=NULL;
	public $board_num=NULL;
	public $comment_num=0;
	public $comment_content=NULL;
	public $board_name=NULL;
	public $nick=NULL;
	public $pw=NULL;
	public $a1=NULL;
	public $a2=NULL;
	public $a3=NULL;
	public $a4=NULL;
	public $array1=array();
	public $array2=array();
	public $array3=array();

	function __construct() {


	}

	public function login(){
		$mysqli_hostname = $_ENV['MYSQL_HOST'];
		$mysqli_user = $_ENV['MYSQL_USER'];
		$mysqli_password = $_ENV['MYSQL_PSWD'];
		$mysqli_database = $_ENV['MYSQL_DB'];

		$this->link = mysqli_connect($mysqli_hostname, $mysqli_user, $mysqli_password) or die("internal error1");
		mysqli_select_db($this->link, $mysqli_database) or die("internal error2");


	}
/*
	public function select($id, $table){
		$query="select * from ".$table." where no='".$id."'";
		$result1=mysqli_query($link, $query) or die("wrong query"); #error
		$tot=mysqli_num_rows($result1);
		$rows=mysqli_fetch_array($result1, MYSQLI_ASSOC);

		$db_no=$rows[no];
		$db_title=$rows[title];
		$db_id=$rows[id];
		echo "no : ".$db_no."<br>";
		echo "title : ".$db_title."<br>";
		echo "id : ".$db_id. "<br>";
	}

*/
	public function read($no, $table){
		$query="select * from ".$table." where no='".$no."'";
		$result1=mysqli_query($this->link, $query) or die("wrong query"); #error
		$tot=mysqli_num_rows($result1);
		$rows=mysqli_fetch_array($result1, MYSQLI_ASSOC);

		$db_title=$rows[title];
		$db_name=$rows[name];	
		$db_sdate=$rows[start_date];
		$db_ldate=$rows[last_date];
		$db_content=$rows[content];

		echo "name : ".$db_name."<br>";
		echo "title : ".$db_title."<br>";
		echo "sdate : ".$db_sdate. "<br>";
		echo "ldate : ".$db_ldate. "<br>";
		echo "content : ".$db_content. "<br>";

	}

	public function select_hit($no){
		$query="select * from board where no='".$no."'";
		$result1=mysqli_query($this->link, $query) or die("wrong query"); #error
		$tot=mysqli_num_rows($result1);
		$rows=mysqli_fetch_array($result1, MYSQLI_ASSOC);
		$db_hit=$rows[hit];
		echo $db_hit;
		$this->hit=$db_hit;
	}

	public function foreign_read($no, $table1, $table2){
		$query="select * from ".$table1." inner join ".$table2." on ".$table1.".id=".$table2.".id where no=".$no;
		$result1=mysqli_query($this->link, $query) or die("wrong query"); #error
		$tot=mysqli_num_rows($result1);
		$rows=mysqli_fetch_array($result1, MYSQLI_ASSOC);

		$db_title=$rows[title];
		$db_name=$rows[name];	
		$db_sdate=$rows[start_date];
		$db_ldate=$rows[last_date];
		$db_hit=$rows[hit];
		$this->hit=$db_hit;
		$db_content=$rows[content];

		echo "name : ".$db_name."<br>";
		echo "title : ".$db_title."<br>";
		echo "sdate : ".$db_sdate. "<br>";
		echo "ldate : ".$db_ldate. "<br>";
		echo "hit : ".$db_hit. "<br>";
		echo "content : ".$db_content. "<br>";

	}

	public function gethit($no){
		$query="update board set hit=hit+1 where no=".$no;
		$result1=mysqli_query($this->link, $query) or die("wrong query"); #error
	}



}


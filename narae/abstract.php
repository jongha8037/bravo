<?php
class DBlayer{
	public $no;
	public $id;
	public $db;
	public $link;
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

	public function select($id, $table){
		$query="select * from ".$table." where no='".$id."'";
		$result1=mysqli_query($link, $query) or die("wrong query"); #error
		$tot=mysqli_num_rows($result1);
		$rows=mysqli_fetch_array($result1, MYSQLI_ASSOC);

		$db_no=$rows[no];
		$db_num=$rows[num];
		$db_con=$rows[con];
		echo "no : ".$db_no."<br>";
		echo "num : ".$db_num."<br>";
		echo "con : ".$db_con. "<br>";
	}
}
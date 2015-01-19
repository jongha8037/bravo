<?php
class DBlayer{
	public $no;
	public $id;
	public $db;
	public $link;
	public $point;
	public $grade;
	public $db_id;
	public $modify_title;
	public $modify_content;
	public $commentid=array();
	public $commentcom=array();
	public $commenttime=array();	
	public $commentcount;

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

	public function read1($no){
		$query="select * from board where no='".$no."'";
		$result1=mysqli_query($this->link, $query) or die("wrong query"); #error
		$rows=mysqli_fetch_array($result1, MYSQLI_ASSOC);

		$db_id=$rows[id];
		$this->db_id=$db_id;
		}

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

	public function member_point($id){
		$query="select point from member where id='".$id."'";
		$result1=mysqli_query($this->link, $query) or die("wrong query"); #error
		$tot=mysqli_num_rows($result1);
		$rows=mysqli_fetch_array($result1, MYSQLI_ASSOC);

		$db_point=$rows[point];
		$this->point=$db_point;
	}

	public function member_grade($id){
		$query="select grade from member where id='".$id."'";
		$result1=mysqli_query($this->link, $query) or die("wrong query"); #error
		$tot=mysqli_num_rows($result1);
		$rows=mysqli_fetch_array($result1, MYSQLI_ASSOC);

		$db_grade=$rows[grade];
		$this->grade=$db_grade;

	}

	public function gethit($no){
		$query="update board set hit=hit+1 where no=".$no;
		$result1=mysqli_query($this->link, $query) or die("wrong query"); #error
	}

	public function board_modify($no){
		$query="select * from board where no='".$no."'";
		$result1=mysqli_query($this->link, $query) or die("wrong query"); #error
		$rows=mysqli_fetch_array($result1, MYSQLI_ASSOC);

		$db_title=$rows[title];
		$this->modify_title=$db_title;
		$db_content=$rows[content];
		$this->modify_content=$db_content;

	}


	public function update($ti, $co, $no){
		$query="update board set title='".$ti."', content='".$co."' where no=$no";
		$result1=mysqli_query($this->link, $query) or die("wrong query");

	}


	public function delete($no){
		$query="delete from board where no=".$no.";";
		$result1=mysqli_query($this->link, $query) or die("wrong query");

	}

	
	public function check_grade($id){
		$query="select grade from member where id='".$id."'";
		$result1=mysqli_query($this->link, $query) or die("wrong query");
		$rows=mysqli_fetch_array($result1, MYSQLI_ASSOC);
		$this->check_grade=$rows[grade];
	}

	public function showcomments($no){
		$query="select * from comment where no=".$no." order by date asc, num asc";
		$result1=mysqli_query($this->link, $query) or die("wrong query");
		while ($rows=mysqli_fetch_array($result1, MYSQLI_ASSOC)){
			$this->commentid[]=$rows["id"];
			$this->commentcom[]=$rows["comment"];
			$this->commenttime[]=$rows["date"];
		}
		$this->commentcount=count($this->commentid);
	}
}
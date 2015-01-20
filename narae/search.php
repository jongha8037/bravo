<?php
$searchValue=$_POST['what'];
$boardNum=$_POST['boardNum'];

if(!$boardNum){
	echo("<script>location.href='BoardList.php?boardNo=0&&searchName=$searchValue';</script>"); 
}else{
	echo("<script>location.href='BoardList.php?boardNo=$boardNum&&searchName=$searchValue';</script>"); 
}
?>






<?php
//$image = array("01.jpg","02.jpg","03.jpg","04.jpg","05.jpg","06.jpg","07.jpg","08.jpg");
$image = $products->title;
var_dump($image);

$num=0;

//for($i=0;$i<count($image);$i++){

?>
<span style="margin-left:55px">

<img src="/img/<?=$image[$i]?>" width="380px" height="600px">
</span>
<?

$num++;

//}
?>


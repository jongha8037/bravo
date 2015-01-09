<meta http-equiv="Content-type" content="text/html; charset=utf8">
<?php
ini_set("display_errors", "1");
session_start();
session_destroy();
header('Location: ./login.html');
?>

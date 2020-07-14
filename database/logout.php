<?php
require_once("mydb.php");
//logout.php
setcookie("type", "", time()-3600);

header(200);

?>
<?php
require_once("mydb.php");
//logout.php

setcookie("data", '', time() -3600);
header(401);
exit();

?>
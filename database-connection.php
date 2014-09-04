<?php
require_once '_globals.php'; 
//Make Server Connection
$con = mysql_connect($GLOBALS['MYSQL_DOMAIN'], $GLOBALS['MYSQL_USERNAME'], $GLOBALS['MYSQL_PASSWORD']) or die ('MySQL Error in connection');
mysql_select_db($GLOBALS['MYSQL_DATABASE'], $con) or die('MySQL Error in database selection');
?>
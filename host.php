<?php

$label = strtolower($_GET['label']);
$num = intval($_GET['num']);

//Server Connection file
require_once 'database-connection.php'; 

$result = mysql_query('SELECT * FROM tweets LIMIT ' . $num.';', $con) or die('MySQL Error.');
 
$tweets = array();
while($tweet = mysql_fetch_array($result, MYSQL_ASSOC))
{
$tweets[] = array('post'=>$tweet);
}
 
$output = json_encode(array('posts' => $tweets));


echo $output;
?>
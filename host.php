<?php

$tweetid = $_POST['tweetid'];
$label = strtolower($_POST['label']);
$flag = strtolower($_POST['flag']);
$num = intval($_GET['num']);

//Server Connection file
require_once 'database-connection.php'; 

if ($flag=="put")
{
    $url = "https://api.twitter.com/1/statuses/oembed.json?id=$tweetid";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL,$url);
    $result=curl_exec($ch);
    curl_close($ch);
    $embed=json_decode($result, true);
    $embed=$embed["html"];
    echo "$tweetid $$$ $label $$$ $embed";
    $query = "INSERT INTO tweets VALUES ($tweetid,$label,'$embed');";
    $result = mysql_query($query, $con) or die('MySQL Error.');  
}
else if ($flag=="fetch")
{
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
}
else
{
    echo "flag error";
}
?>
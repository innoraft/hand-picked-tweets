<?php

switch($_SERVER['REQUEST_METHOD'])
{
case 'GET':
    $tweetid=($_GET['tweetid']);
    $label=strtolower($_GET['label']);
    $flag=strtolower($_GET['flag']);
    $num = intval($_GET['num']);
    break;
case 'POST':
    $tweetid = $_POST['tweetid'];
    $label = strtolower($_POST['label']);
    $flag = strtolower($_POST['flag']);
}

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
    $labelquery=mysql_query("select `label-id` from label where `label-name` = '$label';");
    $labelid = mysql_fetch_array($labelquery);
    $labelid=$labelid['label-id'];
    //echo "INSERT INTO tweets VALUES ($tweetid,$labelid,'$embed');";
    $query = "INSERT INTO tweets VALUES ($tweetid,$labelid,'$embed');";
    if(mysql_query($query, $con))
    {
        $response_array['status'] = 'Done!';  
    }
    else
    {
        $response_array['status'] = 'MySql Error :(';  
    }
    header('Content-type: application/json');
    echo json_encode($response_array);
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
    header('Content-type: application/json');
    $output = json_encode(array('posts' => $tweets));
    echo $output;
}
else
{
    echo "flag error";
}
?>
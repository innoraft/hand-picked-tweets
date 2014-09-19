<?php

//Sample URL for getting tweets : ..hand-picked-tweets/host.php?flag=fetch&label=humour&num=50

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
    //this query collects all tweets with their labels and id in LIFO (reverse chronological) order  
    $result = mysql_query('select `label-name`,`tweet-id`, `tweet-oembed` from tweets inner join label on `tweet-label-id`=`label-id` order by `label-name` asc,`tweet-id` desc ;', $con) or die('MySQL Error.');
    $tweets = array();
    while($tweet = mysql_fetch_array($result, MYSQL_ASSOC))
    {
        $tweets[$tweet['label-name']][$tweet['tweet-id']] = $tweet['tweet-oembed'];
    }
    //var_dump($tweets);
    header('Content-type: application/json');
<<<<<<< HEAD
    $output = json_encode( $tweets);
=======
    $output = json_encode(array($tweets));
>>>>>>> 322c85ddb4105fadb44754b747b74ca1de0d8857
    echo $output;
    
}
else
{
    echo "flag error";
}
?>
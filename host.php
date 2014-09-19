<?php

//Sample URL for getting tweets : ..hand-picked-tweets/host.php?flag=fetch&label=humour&num=50

switch($_SERVER['REQUEST_METHOD']) //Through this we will be able to use both POST and GET whenever required
{
case 'GET':
    $tweetid=($_GET['tweetid']);
    $label=strtolower($_GET['label']);
    $flag=strtolower($_GET['flag']);
    $num = intval($_GET['num']);
    $newlabel = strtolower($_GET['newlabel']);
    echo $newlabel;
    break;
case 'POST':
    $tweetid = $_POST['tweetid'];
    $label = strtolower($_POST['label']);
    $flag = strtolower($_POST['flag']);
}

//Server Connection file
require_once 'database-connection.php'; 

if ($flag=="put") //put flag means the mod wants to push some tweets in the database
{
    $url = "https://api.twitter.com/1/statuses/oembed.json?id=$tweetid";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL,$url);
    $result=curl_exec($ch);
    curl_close($ch);//curl is used to get the oembed code of the perticular tweet from twitter servers with the help of tweet id
    $embed=json_decode($result, true);
    $embed=$embed["html"];
    $labelquery=mysql_query("select `label-id` from label where `label-name` = '$label';");
    $labelid = mysql_fetch_array($labelquery);
    $labelid=$labelid['label-id'];
    $query = "INSERT INTO tweets VALUES ($tweetid,$labelid,'$embed');";
    if(mysql_query($query, $con))
    {
        $response_array['status'] = 'Done!';  
    }
    else
    {
        $response_array['status'] = 'MySql Error :(';  
    }
    header('Content-type: application/json'); //setting the response header
    echo json_encode($response_array);
}

else if ($flag=="fetch") //flag fetch indicates the user wants all tweets in JSON format

{
    //Server Connection file
    require_once 'database-connection.php';
    //this query collects all tweets with their labels and id in LIFO (reverse chronological) order  
    $result = mysql_query('select `label-name`,`tweet-id`, `tweet-oembed` from tweets inner join label on `tweet-label-id`=`label-id` order by `label-name` asc,`tweet-id` desc ;', $con) or die('MySQL Error.');
    $tweets = array();
    while($tweet = mysql_fetch_array($result, MYSQL_ASSOC))
    {
   $tweets[$tweet['label-name']][$tweet['tweet-id']] = $tweet['tweet-oembed'];
    }//Creating an array in the above formate to produce the JSON as discussed earlier
    header('Content-type: application/json');
<<<<<<< HEAD
    $output = json_encode( $tweets);
=======
    $output = json_encode(array($tweets));
>>>>>>> 322c85ddb4105fadb44754b747b74ca1de0d8857
    echo $output;
    
}

if ($flag=="newlabel") // New label means the mod wants to send a new label to the database
{
    $query = "insert into `label` values (NULL,'$newlabel');";
    if(mysql_query($query, $con))
    {
        $response_array['status'] = "Added $newlabel!";  
    }
    else
    {
        $response_array['status'] = 'MySql Error :(';  
    }
    
    header('Content-type: application/json');
    echo json_encode($response_array);
}
else //when no flag is set up
{
    echo "flag error";
}
?>
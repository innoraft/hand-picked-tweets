<?php

//Sample URL for getting tweets : ..hand-picked-tweets/host.php?flag=fetch&label=humour&num=50

switch($_SERVER['REQUEST_METHOD']) //Through this we will be able to use both POST and GET whenever required
{
case 'GET':
    switch ($flag=strtolower($_GET['flag']))
    {
        case 'put':
            $tweetid=($_GET['tweetid']);
            $label=strtolower($_GET['label']);
            break;
    /*    case 'newlabel':
            $newlabel = strtolower($_GET['newlabel']);
            break;*/
    }
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
   //    $tweets[$tweet['label-name']][$tweet['tweet-id']] = $tweet['tweet-oembed'];
            $tweets[] = array($tweet['label-name']=>$tweet);  
       
    }//Creating an array in the above formate to produce the JSON as discussed earlier
   // header('Content-type: application/json');
  //  $output = json_encode($tweets);
     $output = json_encode(array($tweets));
    echo $output;
    
}

if ($flag=="newlabel") // New label means the mod wants to send a new label to the database
{
    $result = mysql_query('select * from `label`;', $con) or die('MySQL Error.');
    $labeldetail=  array();
    while($label = mysql_fetch_array($result, MYSQL_ASSOC))
    {
        $labeldetail[$label['label-id']]=$label['label-name'];
          
    }
     $output = json_encode(($labeldetail));
     echo $output;
   
}
else //when no flag is set up
{
    echo "flag error";
}
?>
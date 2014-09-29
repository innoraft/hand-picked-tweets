<?php
$page=$_GET['page'];
echo $page;
if (!isset($page)) 
  {
  $page='mock-1.html';
  $content = file_get_contents("$page");
  echo $content;
  }
else header("Location: mock-1-with-angular-tweetpage.html?label=$page");
?>
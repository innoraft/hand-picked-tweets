// First add a bookmark javascript:window.open('//localhost/hpt/insertviabookmark.php?u='+(window.location.href));

<?php
$u=$_GET['u'];
$url=explode("/",$u);
require_once 'database-connection.php'; 
?>
<html>
      <head>
          <link href="style.css" rel="stylesheet">
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
</head>
    <body>
<div id=message class="WorldsBestButton top nodisplay">Messsage</div>
<select id="labelvalue">
    <?php
    $getlabels=mysql_query("select `label-name` from label;",$con);
    while($label= mysql_fetch_array($getlabels, MYSQL_ASSOC))
    {
        echo '<option value="'.$label['label-name'].'">'.$label['label-name'].'</option>';
    }
    ?>
</select>
<?php echo $url[5]; ?>
<button class="send">Send</button>
    </body>
<script>
    $('.send').click(function () {
        var label = $( "#labelvalue" ).val();
        var global_id = "<?php echo $url[5]; ?>";
            console.log(global_id);
        console.log(label);
        $.ajax({
            url: 'host.php',
            data: {
                "label": label,
                "tweetid": global_id,
                "flag": "put"
            },
            type: 'get',
            success: function (result) {
                $("#message").html(result.status);
               console.log(result); $("#message").removeClass("nodisplay").delay(2000).queue(function (next) {
                    $(this).addClass("nodisplay");
                    next();
                });
            }
        });
    });
</script>
</html>
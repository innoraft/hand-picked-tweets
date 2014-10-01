<?php
require_once '_globals.php';
require_once 'database-connection.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <title>Attendees at Amsterdam 2014 -- Twitter List</title>
</head>

<body id="one">
        <div id=message class="WorldsBestButton top nodisplay">Messsage</div>
        <div class="press">Activate</div>
    <div class="content">
        <a class="twitter-timeline" href="<?php echo $GLOBALS['TWITTER_TIMELINE_LINK_ATTENDEES']?>" data-widget-id="<?php echo $GLOBALS['TWITTER_DATA_WIDGET_ID_ATTENDEES']?>">Tweets from Drupalcon Attendees</a>
        <script>
            ! function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0],
                    p = /^http:/.test(d.location) ? 'http' : 'https';
                if (!d.getElementById(id)) {
                    js = d.createElement(s);
                    js.id = id;
                    js.src = p + "://platform.twitter.com/widgets.js";
                    fjs.parentNode.insertBefore(js, fjs);
                }
            }(document, "script", "twitter-wjs");
        </script>
    </div>
    <div class="bar bottom">
        <ul class="">
            
            <?php
    
    $getlabels=mysql_query("select `label-name` from label;",$con);
    while($label= mysql_fetch_array($getlabels, MYSQL_ASSOC))
    {
        echo '<li id="'.$label['label-name'].'" class="label nolist WorldsBestButton"><a href="#">'.$label['label-name'].'</a></li>';

    }
            ?>

        </ul>
    </div>
</body>
<script type="text/javascript">
    //function AwesomeFunction() {
    //    var elementattibutevalue = window.frames["twitter-widget-0"].contentWindow.document.getElementById("twitter-widget-0").innerHTML;
    //    //var elementattibutevalue = window.frames["twitter-widget-0"].contentDocument.getElementByClassName("stream").innerHTML;
    //       // var elementattibutevalue = window.frames["twitter-widget-0"].contentDocument.getElementById("twitter-widget-0").innerHTML;
    //    //var x= document.getElementById("twitter-widget-0");
    //    //console.log(elementattibutevalue);
    //    m=elementattibutevalue.getElementsByTagName( 'ol' );
    //    console.log(m);
    //}

    var global_id;

    $(document).ready(function () {
        $('.press').click(function () {
            var r = $("#twitter-widget-0").contents();
            var l = $('li', r);
            $(l).each(function () {
                $(this).click(function () {
                    myFunction(this);
                });

                function myFunction(element) {
                    console.log(p)
                    var p = $(element).attr("data-tweet-id");
                    console.log(p);
                    global_id = p;
                }
            });
        });
    });

    $('.label').click(function () {

        var label = $(this).attr("id");
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
                $("#message").removeClass("nodisplay").delay(2000).queue(function (next) {
                    $(this).addClass("nodisplay");
                    next();
                });
            }
        });
    });
    
    $('#inputbox').live('keypress',function(e){
        var p = e.which;
        var newlabel = $("#inputbox").val();
        if(p==13){
            var NewContent = '<li id="Other" class="label WorldsBestButton"><a href="#">other</a></li>';
$(NewContent).insertAfter('#Other');
            alert(newlabel);
               $.ajax({
            url: 'host.php',
            data: {
                "newlabel": newlabel,
                "flag": "newlabel"
            },
            type: 'get',
            success: function (result){
                $("#message").html(result.status);
                $("#message").removeClass("nodisplay").delay(2000).queue(function (next) {
                    $(this).addClass("nodisplay");
                    next();
                });
            }
        });
        }        
    });
    
</script>

</html>

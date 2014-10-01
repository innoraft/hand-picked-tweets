<!DOCTYPE html>
<html lang="en">
  <head>
      <script src="jss/angular.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.png">
       <link rel="stylesheet" href="css/bootstrap.min.css">

     <script  src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.5/angular-route.min.js"></script>
    <script src="jss/jquery.min.js"></script>

      <title>Hand Picked Tweets From DrupalCon Amsterdam 2014</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="styles/stylesheets/style.css">
      
      <!-- Solution one arrow issue-->
      <link href='http://fonts.googleapis.com/css?family=Cabin+Condensed:600' rel='stylesheet' type='text/css'>

    <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700|Patua+One' rel='stylesheet' type='text/css'>
      <link href="//fonts.googleapis.com/css?family=Josefin+Sans:100italic,100,300italic,300,400italic,400,600italic,600,700italic,700" rel="stylesheet" type="text/css">
            <script>
	$(function() {
	  $('a[href*=#]:not([href=#])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {

	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html,body').animate({
	          scrollTop: target.offset().top
	        }, 1000);
	        return false;
	      }
	    }
	  });
	});
          
          $(document).scroll(function () {
    var y = $(this).scrollTop();
    if (y > 400) {
        $('.backtotop').removeClass('nodisplay');
        $('.backtotop').fadeIn();
    } else {
        $('.backtotop').fadeOut();
    }

});
	</script>


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<?php include 'ga.php' ?>
  </head>

  <body ng-app="route1">

      <div class="container">

          <div ng-controller="MainCtrl">
              <!--contains other html page here -->
              <div ng-view></div></div>
             
        <div class="footer clearfix">
        <p class="pull-right">Built by the mischievous (but hardworking) interns @ <a href="http://www.innoraft.com">Innoraft Solutions</a></p>
        </div>
                    <a href="#tweettop"><div class="backtotop nodisplay" ng-click="scrollTo('top')"><div class="backtotopin arrow">^</div></div></a>
    </div> <!-- /container -->
 
<script type="text/javascript">
 
    
            
    window.twttr = (function (d, s, id) {
        var t, js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src= "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);
        return window.twttr || (t = { _e: [], ready: function (f) {
                t._e.push(f) } });
    }
         
    (document, "script", "twitter-wjs"));
    
       
</script>   
<script src="mock-1-logic.js"></script> 
  </body>
    <script>
      $(document).ready(function () {
          /*
    var delay = setTimeout(function(){
        $(".header").addClass("animate");
     }, 100)
});*/
           $('.header').click(function () {
               var t=100
        setTimeout('pluscalss("body","bodycolor1");',2*t);
        setTimeout('pluscalss("body","bodycolor2");',4*t);
        setTimeout('pluscalss("body","bodycolor3");',6*t);           setTimeout('pluscalss("body","bodycolor4");',8*t);
        setTimeout('pluscalss("body","bodycolor5");',10*t);
        setTimeout('pluscalss("body","bodycolor6");',12*t);
        setTimeout('pluscalss("body","bodycolor7");',14*t);
        setTimeout('pluscalss("body","bodycolor8");',16*t);
        setTimeout('pluscalss("body","bodycolor9");',18*t);
               setTimeout('minusclass("body","bodycolor9");',20*t);
               setTimeout('minusclass("body","bodycolor8");',22*t);
               setTimeout('minusclass("body","bodycolor7");',24*t);
               setTimeout('minusclass("body","bodycolor6");',26*t);
               setTimeout('minusclass("body","bodycolor5");',28*t);
               setTimeout('minusclass("body","bodycolor4");',30*t);
               setTimeout('minusclass("body","bodycolor3");',32*t);
               setTimeout('minusclass("body","bodycolor2");',34*t);
               setTimeout('minusclass("body","bodycolor1");',36*t);
        });
      });
        
        function pluscalss(id, classname) {
$(id).addClass(classname);
         return this;
     }
      
        function minusclass(id, classname) {
$(id).removeClass(classname);
         return this;
     }

        
          $(document).ready(function () {

           $('.category').click(function () {
               console.log("kjk");
                 $('.header').toggleClass('nodisplay');
             });
          });
//                       $('body').removeClass("bodycolor1 bodycolor2 bodycolor3 bodycolor4 bodycolor5 bodycolor6 bodycolor7 bodycolor8 bodycolor9");

        
/*        function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}*/
    
	</script>
</html>

<!--    <script>
      $(document).ready(function () {
          /*
    var delay = setTimeout(function(){
        $(".header").addClass("animate");
     }, 100)
});*/
           $('.header').click(function () {
             $('body').addClass('bodycolor1').delay(800).queue(function(){
                 $('body').addClass('bodycolor2');
             });
        });
      });
        
        
	</script>-->
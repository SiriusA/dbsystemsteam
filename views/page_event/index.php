<!-- Prevent user from skipping login page -->
<?php
  session_start();

  if($_SESSION["userLoggedIn"] == false)
		 header('Location: /');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta property="og:url"           content="" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Eventi" />
    <meta property="og:description"   content="Check out this event!" />
    <meta property="og:image"         content="../image/logo.png" />
    <!-- Use title if it's in the page YAML frontmatter -->

    <title>Events - Eventi</title>

    <meta name="description" content="UCF Database Systems Spring 2017 Project" />

    <link href="/stylesheets/nav_bar.css" rel="stylesheet" type="text/css" />
    <link href="/stylesheets/footer.css" rel="stylesheet" type="text/css" />

    <link href="/images/favicon.png" rel="icon" type="image/png" />

      <!-- 3 links needed for bootstrap-->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link href="/stylesheets/comments.css" rel="stylesheet" type="text/css" />

<!--      <a href = "/db/logout.php" class = "topcorner">Log Out</a>-->

  </head>

<body>
  <!-- FACEBOOK PLUGIN -->
    <div id="fb-root"></div>
      <script>
        (function(d, s, id) {

          var js, fjs = d.getElementsByTagName(s)[0];

          if (d.getElementById(id))
            return;

          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
          fjs.parentNode.insertBefore(js, fjs);
        }
        (document, 'script', 'facebook-jssdk'));
      </script>
  <!-- END FACEBOOK PLUGIN-->

  <?php
    include_once "../nav_bar/only_nav_bar.php";
  ?>

  <?php function test_input($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
  } ?>

  <?php
    include_once "../db/query_events.php";


    //set index if not set
    if(!empty($_GET["time"]) && !empty($_GET["place"])){
      $time = test_input($_GET["time"]);
      $place = test_input($_GET["place"]);
    }
    else{
      $time = 0;
      $place = 0;
    }

    $eventData = getEventbyTimePlace($time, $place);

    echo "<script>var locId = " . $eventData["lid"] . ";</script>";

  ?>


  <script>
    function mapZoom(lid) {
      if(lid == -1)
      {
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
  //              console.log(this.responseText);
                eval(this.responseText);
            }
        };
        xmlhttp.open("GET", "../db/zoom_map.php?lid=" + lid, true);
        xmlhttp.send();
      }
    }

    // Starrr plugin (https://github.com/dobtco/starrr)
    var __slice = [].slice;

    (function($, window) {
        var Starrr;

        Starrr = (function() {
            Starrr.prototype.defaults = {
                rating: void 0,
                numStars: 5,
                change: function(e, value) {}
            };

            function Starrr($el, options) {
                var i, _, _ref,
                    _this = this;

                this.options = $.extend({}, this.defaults, options);
                this.$el = $el;
                _ref = this.defaults;
                for (i in _ref) {
                    _ = _ref[i];
                    if (this.$el.data(i) != null) {
                        this.options[i] = this.$el.data(i);
                    }
                }
                this.createStars();
                this.syncRating();
                this.$el.on('mouseover.starrr', 'span', function(e) {
                    return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
                });
                this.$el.on('mouseout.starrr', function() {
                    return _this.syncRating();
                });
                this.$el.on('click.starrr', 'span', function(e) {
                    return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
                });
                this.$el.on('starrr:change', this.options.change);
            }

            Starrr.prototype.createStars = function() {
                var _i, _ref, _results;

                _results = [];
                for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                    _results.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"));
                }
                return _results;
            };

            Starrr.prototype.setRating = function(rating) {
                if (this.options.rating === rating) {
                    rating = void 0;
                }
                this.options.rating = rating;
                this.syncRating();
                return this.$el.trigger('starrr:change', rating);
            };

            Starrr.prototype.syncRating = function(rating) {
                var i, _i, _j, _ref;

                rating || (rating = this.options.rating);
                if (rating) {
                    for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                        this.$el.find('span').eq(i).removeClass('glyphicon-star-empty').addClass('glyphicon-star');
                    }
                }
                if (rating && rating < 5) {
                    for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                        this.$el.find('span').eq(i).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
                    }
                }
                if (!rating) {
                    return this.$el.find('span').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
                }
            };

            return Starrr;

        })();
        return $.fn.extend({
            starrr: function() {
                var args, option;

                option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
                return this.each(function() {
                    var data;

                    data = $(this).data('star-rating');
                    if (!data) {
                        $(this).data('star-rating', (data = new Starrr($(this), option)));
                    }
                    if (typeof option === 'string') {
                        return data[option].apply(data, args);
                    }
                });
            }
        });
    })(window.jQuery, window);

    $(function() {
        return $(".starrr").starrr();
    });

    $( document ).ready(function() {

        $('#stars').on('starrr:change', function(e, value){
            $('#count').html(value);
        });

        $('#stars-existing').on('starrr:change', function(e, value){
            $('#count-existing').html(value);
        });
    });
  </script>


  <div class="container">


  </div>

    <div id="wrapper">
        <div class="hero">
          <div class="row">
            <div class="col-md-10">
              <?php
                echo '<h3 class="title_bar">' . $eventData["ename"] . "</h3>";
              ?>

            </div>
            <div class="col-md-2">
              <?php
              echo '<form class="form-vertical" role="form" action="../db/attend_event.php?time='.$time.'&place='.$place.'&sid='.$_SESSION["sid"].'" method="post">';
              echo '<input type="submit" value="Attend">';
              echo '</form>';
              ?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <h3>This is where an image would go, if you had one.</h3>
            </div>
            <div class="col-md-6">
              <div id="googleMap" style="width:100%;height:400px;"></div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <?php
              echo '<h1 class="title_bar"><font size = "4%"' . $eventData["start_time"] . "</font></h1>";
              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo '<h1 class="title_bar"><font size = "4%"' . $eventData["end_time"] . "</font></h1>";
              ?>
            </div>
          </div>

            <div class="row lead">
                <div id="stars" class="starrr"></div>
                You gave a rating of <span id="count">0</span> star(s)
            </div>
          <div class="col-md-12">
            <?php
              echo '<h1 class="title_bar"><font size = "5%">' . $eventData["description"] . "</font></h1>";
            ?>
          </div>
        </div>
      </div>

      <!-- Facebook share button-->
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-2"></div>

      <div class="col-md-2">
        <div class="fb-share-button" data-href="" data-layout="button" data-mobile-iframe="true">
          <a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2FshareURL.com%2F&amp;src=sdkpreparse">Share</a>
        </div>
      </div>
    </div>

    <!-- COMMMENTS/RATINGS -->
    <form action = "http://localhost/page_event/modify_comment.php" method= "post">

    <div class="container">
      <div class="row">
        <div class="col-md-14">
          <h2 class="page-header">Comments</h2>

            <div class="container">
              <I>Add a comment</I><br>
              <textarea name="comment_to_submit" rows="4" cols="60"></textarea><br>
              <input type="hidden" name="time" value='<?php echo $time ?>'>
              <input type="hidden" name="place" value='<?php echo $place ?>'>
              <input type="submit" name="Submit">
            </div>

            <section class="comment-list">

    <?php

      include_once "../db/query_comments.php";

      /*
      if(!empty($_GET["index"])){
        $index = test_input($_GET["index"]);
      }
      else{
        $index = 0;
      }

      */

      $eventComments = getEventComments($time, $place);

      $i = 0;

      if(sizeof($eventComments) <= 0){
        echo '<div class="list-group-item">
                <h3> No comments available! </h3>
              </div>';
      }

      else
        while($i < 20 && $i < sizeof($eventComments)){

          $timestamp = date_create_from_format("Y-m-d H:i:s", $eventComments[$i]["timestamp"]);
          $timestamp = $timestamp->format("F d, Y");

          echo '<article class="row">
                  <div class="col-md-10 col-sm-10">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <header class="text-left">
                          <div class="comment-user"><i class="fa fa-user"></i>'.$eventComments[$i]["first_name"]. ' ' .$eventComments[$i]["last_name"].'</div>
                          <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i>' .$timestamp. '</time>
                        </header>
                        <div class="comment-post">
                          <p>
                          '.$eventComments[$i]["comment"].'
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
              </article> ';

          $i++;
        }
    ?>
          </section>
        </div>
      </div>
    </div>

    <script>

           var map;
           var marker;
           function myMap() {

               var haightAshbury = {lat: 37.769, lng: -122.446};

               var mapProp= {
                   center:new google.maps.LatLng(37.769,-122.446),
                   zoom:15,
               };
               map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
               placeMarker(haightAshbury);

               //get marker position after dragging
               marker.addListener('dragend', function(event) {
                   var latlng = marker.getPosition();
                   console.log("latlng: " + latlng);
                   console.log("lat(): " + latlng.lat() + ", lng(): " + latlng.lng());
                   document.getElementById("lat").value = latlng.lat();
                   document.getElementById("lng").value = latlng.lng();
               });

               mapZoom(locId);

           }

           function placeMarker(location) {

               marker = new google.maps.Marker({
                   position: location,
                   map: map,
                   draggable:true
               });
           }
       </script>
         <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCttR_s1Fawjgb7lQGP9Yk8T4VAU6vsAbQ&callback=myMap"></script>

    <!---- END COMMENTS ---->

  </body>
</html>

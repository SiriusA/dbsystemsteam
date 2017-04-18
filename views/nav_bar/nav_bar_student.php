<!DOCTYPE html>
<html >
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300' rel='stylesheet' type='text/css'>
  <link href='http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel="stylesheet" href="../stylesheets/nav_bar.css">

</head>

<body>

  <div class="menu-container">
    <div class="menu">
      <ul class="clearfix">
        <li><a href="/home">Home</a></li>
        <li><a href="/list_events">Events</a>
          <ul>
            <li><a href="/list_events">List Events</a></li>
            <li><a href="/events_attending">My Events</a></li>
          </ul>
        </li>
        <li><a href="/rso">RSOs</a>
          <ul>
            <li><a href="/list_rso">List RSOs</a></li>
            <li><a href="/rso">My RSOs</a></li>
            <li><a href="/create_rso">Create an RSO</a></li>
          </ul>
        </li>
        <li><a href="/list_university">University</a>
          <ul>
            <li><a href="/university_description">My University</a></li>
          </ul>
        </li>
        <li><a href="#">Search</a></li>
        <li><a href="/db/logout.php">Logout</a></li>

      </ul>
    </div>
  </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
    <script src="../javascripts/nav_bar.js"></script>

</body>
</html>

<!-- Prevent user from skipping login page -->
<?php
  session_start();

  include "../db/connection.php";

  if($_SESSION["userLoggedIn"] == false)
    header('Location: /');

    $first_name;
    $last_name;
    $uid;
    $email = $_SESSION["email"];


    $result = db_query("SELECT U.email, U.uid, U.first_name, U.last_name FROM `user` U
                WHERE `email` = '$email' ");

    if($result == false)
        echo "something went wrong";

    while($row = mysqli_fetch_array($result))
    {
        $uid = $row[1];
        $first_name = $row[2];
        $last_name = $row[3];
    }
    $result = db_query("SELECT U.uname FROM `university_created` U WHERE `uid` = '$uid' ");
    while($row = mysqli_fetch_array($result))
    {
        $uname = $row[0];
    }



?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>

    <link rel="stylesheet" href="/stylesheets/create_university.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>

    <!--Display correct navbar-->
    <?php
      if($_SESSION["usertype"] == 1){
          include_once "../nav_bar/nav_bar_super.php";
      }
      if($_SESSION["usertype"] == 2){
          include_once "../nav_bar/nav_bar_admin.php";
      }
      else if ($_SESSION["usertype"] == 3){
          include_once "../nav_bar/nav_bar_student.php";
      }

        echo '<div class="list-group-item">';
        echo '<h3>Welcome '.$first_name.' '.$last_name.'!</h3>';
        echo '<h5> Your University: '.$uname.' </h5>';
        echo '</div>';
        echo '<div class="list-group-item">';
        echo '<h4> Pending RSOs:</h4>';
        $sid = $_SESSION["sid"];
        $rid = array();
        $rname = array();

        $result = db_query("SELECT J.rid FROM `joins` J  WHERE `sid` = '$sid' AND `approval` = '0' ");
        while($row = mysqli_fetch_array($result))
        {
            $rid = $row[0];
            $result1 = db_query("SELECT R.rname FROM `rso_owned` R  WHERE `rid` = '$rid'");
            $approve_button = '0';
            while($row1 = mysqli_fetch_array($result1))
            {
                $rname= $row1[0];
                $choice = '0';
                echo $rname;
                $rid2 = $rid;
                echo '<form action = "http://localhost/home/pending_rso.php" method = "post">
                    <input type = "submit" name = "'.$rid2.'" value = "Join"/>
                    <input type = "submit" name = "'.$rid2.'" value = "Deny"/>
                    </form>';
            }

        }

    ?>


<script>
    function approve()
    {
         alert("You chose approve");
         '<?php $choice = '1';?>';

    }

    function deny()
    {
        alert("You chose deny");
        '<?php $choice = '2';?>';
    }

</script>

</body>

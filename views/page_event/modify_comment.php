<html>
<head>
</head>
<body>
<?php

    session_start();

    include_once "../db/connection.php";

    $comment = trim($_POST['comment_to_submit']);


    	$data_missing = array();

    	if(empty($_POST['comment_to_submit']))
    	{
    		$data_missing[] = 'comment';
    	}
    	else
    	{
    		$comment = trim($_POST['comment_to_submit']);
    	}

    $sid = $_SESSION["sid"];

    if(empty($data_missing))
    {

    	$result = db_query("INSERT INTO comment (timestamp, sid, start_time, lid, comment)
    		                  VALUES(CURRENT_TIMESTAMP(), '$sid', '".$_POST["time"]."', '".$_POST["place"]."', '$comment')");

    	if($result === false)
            echo "Insertion went wrong";
        else
        {
        	echo "insertion went through";
          /*
        	$rid = 'mysqli_insert_id';

            $connection = db_connect();
            $GLOBALS["rid"] = mysqli_insert_id($connection);
            */
        }


  }

/*

    $result = db_query("SELECT U.sid FROM `user` U WHERE `email` = '$mem1' OR `email` = '$mem2' OR `email` = '$mem3' OR `email` = '$mem4'");

    $sid = array();

    while($row = mysqli_fetch_array($result)){
    	$sid[]= $row[0];
    }

    $result = db_query("INSERT INTO joins(sid, rid) VALUES('$sid[0]', '$rid')");
    $result = db_query("INSERT INTO joins(sid, rid) VALUES('$sid[1]', '$rid')");
    $result = db_query("INSERT INTO joins(sid, rid) VALUES('$sid[2]', '$rid')");
    $result = db_query("INSERT INTO joins(sid, rid) VALUES('$sid[3]', '$rid')");
    */
?>

</body>
</html>

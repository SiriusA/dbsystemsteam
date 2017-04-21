<?php
include_once "connection.php";


function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if(!empty($_GET["time"]) && !empty($_GET["place"]) && !empty($_GET["sid"])) {
  $time = test_input($_GET["time"]);
  $place = test_input($_GET["place"]);
  $sid = test_input($_GET["sid"]);

  $query = "INSERT INTO attends(sid, start_time, timestamp, lid, value)
                      VALUES(".$sid.", ".$time.", CURRENT_TIMESTAMP, ".$place.", 0)";

  $result = db_query($query);

  if($result != FALSE)
  {
    echo "you are now attending";
  }
  else {
    echo "you are not attending, error.";
//    echo $query;
  }
}
else{
}



 ?>

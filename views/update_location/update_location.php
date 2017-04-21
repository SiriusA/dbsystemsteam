<?php

include_once "../db/connection.php";

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$conn = getConnObj();
$conn2 = getConnObj();

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $latitude = test_input($_POST["lat"]);
  $longitude = test_input($_POST["lng"]);
  $lid = test_input($_POST["lid"]);
  $lname = test_input($_POST["lname"]);

  if($lid == -1)
	{
		$redog = $conn2->query("INSERT INTO location (longitude, latitude, lname, uid)
									VALUES (".$longitude.", ".$latitude.", '".$lname."', ".$_SESSION["uid"].")");
		if($redog !== TRUE)
		{
			echo $conn2->error;
		}
	}
	else {
    $zoomMapQ = $conn->prepare("UPDATE location L
                               SET L.latitude = ?, L.longitude = ?
                               WHERE l.lid = ?");
    $zoomMapQ->bind_param("ddi", $latitude, $longitude, $lid);

    $zoomMapQ->execute();
	}



}

$conn->close();
?>

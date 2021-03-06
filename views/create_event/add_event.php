<!-- Kyle Picinich -->
<html>
<head>



<?php
include_once "../db/connection.php";
session_start();

$conn = getConnObj();

$eventname = $starttime = $endtime = $desc = $phone = $email = $lat = $lng = $lname = $lid = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$eventname = test_input($_POST["eventname"]);
	$starttime = test_input($_POST["starttime"]);
	$endtime = test_input($_POST["endtime"]);
	$rso = test_input($_POST["rso"]);
	$location = "1";
	$desc = test_input($_POST["description"]);
	$phone = test_input($_POST["phone"]);
	$email = test_input($_POST["email"]);
	$lid = test_input($_POST["lid"]);
	$lname = test_input($_POST["lname"]);
	$lat = test_input($_POST["lat"]);
	$lng = test_input($_POST["lng"]);


	//echo("testing insert");

	$timetable_collision = "SELECT e2.lid, e2.start_time
	FROM Events_Hosted_Located e2
	WHERE " . $location . " = e2.lid
	AND (
	(e2.start_time <= '" . $starttime . "' AND '" . $starttime . "' < e2.end_time)
	OR (e2.start_time <= '" . $endtime . "' AND '" . $endtime . "' < e2.end_time)
	OR ('" . $starttime . "' <= e2.start_time AND e2.start_time < '" . $endtime . "')
	OR ('" . $starttime . "' <= e2.end_time AND e2.end_time < '" . $endtime . "')
	);";
	//echo($timetable_collision);
	//$insert_def_str = "(start_time, end_time, rid, lid, approved, type, visibility, ename, phone, email, description) ";

	/*
	$res2 = $conn->query("SELECT L.lname
								FROM location L
								WHERE L.lid = " . $lid . "");
	*/

	$uid = 1;

	if($rso < 0)
	{
		$uid = $rso + (2*$rso);
		$rso = NULL;
	} else {
		$uid = $_SESSION["uid"];
	}

	if($lid == -1)
	{
		$redog = $conn->query("INSERT INTO location (longitude, latitude, lname, uid)
									VALUES (".$lng.", ".$lat.", '".$lname."', ".$uid.")");
		if($redog !== TRUE)
		{
			echo $conn->error;
		}
	}
	else {
		$location = $lid;
	}

	$approved = 0;
	if($_SESSION["usertype"] == 3)
	{
		$approved = 1;
	} else if($rso > 0)
	{
		$approved = 1;
	}
	$conn2 = getConnObj();
	$eventIns = $conn2->prepare("INSERT INTO events_hosted_located (approved, description, email, ename, end_time, lid, phone, rid, start_time, type, visibility)
															VALUES ('0', ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)");
	$eventIns->bind_param("ssssisisi", $desc, $email, $eventname, $endtime, $location, $phone, $rso, $starttime, $approved);
	//$insert_data_str = "VALUES ('" . $starttime . "', '" . $endtime . "', " . $rso . ", '" . $location . "', ".$approved.", 1, 1, " . $eventname . ", " . $phone . ", '" . $email . "', " . $desc . ");";
	//echo $insert_data_str;
	//$insert_actual = "INSERT INTO Events_Hosted_Located" . $insert_def_str . " " . $insert_data_str;
	db_query("USE event;");

	$result = $conn->query($timetable_collision);
	if($result->num_rows == 0) {
		//if($conn->query($insert_actual)=== TRUE) {
		if($eventIns->execute()) {
			//echo "new record created <br>";
			echo("insert successful");
		} else {
			//echo "Error: " . $insert_actual . "<br>" . $conn->error;
		}
	} else {
		echo "Collision Detected";
	}

	$conn->close();
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>
</head>
<body>
</body>
</html>

<!-- Kyle Picinich -->
<html>
<head>



<?php
include_once "../db/connection.php";
$conn = getConnObj();

$eventname = $starttime = $endtime = $desc = $phone = $email = $lat = $lng"";

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$eventname = test_input($_POST["eventname"]);
	$starttime = test_input($_POST["starttime"]);
	$endtime = test_input($_POST["endtime"]);
	$rso = test_input($_POST["rso"]);
	$location = "1";
	$desc = test_input($_POST["description"]);
	$phone = test_input($_POST["phone"]);
	$email = test_input($_POST["email"]);
	$lat = test_input($_POST["latitude"]);
	$lng = test_input($_POST["longitude"]);


	echo("testing insert");

	$timetable_collision = "SELECT e2.lid, e2.start_time
	FROM Events_Hosted_Located e2
	WHERE " . $location . " = e2.lid
	AND (
	(e2.start_time <= '" . $starttime . "' AND '" . $starttime . "' < e2.end_time)
	OR (e2.start_time <= '" . $endtime . "' AND '" . $endtime . "' < e2.end_time)
	OR ('" . $starttime . "' <= e2.start_time AND e2.start_time < '" . $endtime . "')
	OR ('" . $starttime . "' <= e2.end_time AND e2.end_time < '" . $endtime . "')
	);";
	echo($timetable_collision);
	$insert_def_str = "(start_time, end_time, rid, lid, approved, type, visibility, ename, phone, email, description) ";
	$insert_data_str = "VALUES ('" . $starttime . "', '" . $endtime . "', " . $rso . ", " . $location . ", 1, 1, 1, '" . $eventname . "', '" . $phone . "', '" . $email . "', '" . $desc . "');";
	echo $insert_data_str;
	$insert_actual = "INSERT INTO Events_Hosted_Located" . $insert_def_str . " " . $insert_data_str;
	db_query("USE event;");

	$result = $conn->query($timetable_collision);
	echo("<br> ye <br>");
	if($result->num_rows == 0) {
		if($conn->query($insert_actual)=== TRUE) {
			echo "new record created <br>";
			echo("insert successful");
		} else {
			echo "Error: " . $insert_actual . "<br>" . $conn->error;
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

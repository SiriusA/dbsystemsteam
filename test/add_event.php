<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if($conn->connect_error) {
	die("connection failed: " . $conn->connect_error);
}

echo("connection successful");
?>

<!DOCTYPE html>
<html>
<body>

<h1>Add Event</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	Event Name: <input type="text" name="eventname"><br>
	Format:YYYY-MM-DD HH:MM:SS<br>
	Start Time: <input type="datetime-local" name="starttime"> End Time: <input type="datetime-local" name="endtime"><br>
	Description: <textarea name="description" rows="10" cols="40"></textarea><br>
	Phone: <input type="text" name="phone"> Email: <input type="text" name="email"><br>
	<input type="submit" name="Submit"><br>
</form>

<?php
$eventname = $starttime = $endtime = $desc = $phone = $email = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$eventname = test_input($_POST["eventname"]);
	$starttime = test_input($_POST["starttime"]);
	$endtime = test_input($_POST["endtime"]);
	$location = "1";
	$desc = test_input($_POST["description"]);
	$phone = test_input($_POST["phone"]);
	$email = test_input($_POST["email"]);
	
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
	$insert_data_str = "VALUES ('" . $starttime . "', '" . $endtime . "', 1, 1, 1, 1, 1, '" . $eventname . "', '" . $phone . "', '" . $email . "', '" . "1" . "');";
	echo $insert_data_str;
	$insert_actual = "INSERT INTO Events_Hosted_Located" . $insert_def_str . " " . $insert_data_str;
	$conn->query("USE event;");
	
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
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>

</body>
</html>
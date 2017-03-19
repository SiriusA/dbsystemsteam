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
	Start Time: <input type="text" name="starttime"> End Time: <input type="text" name="endtime"><br>
	Description: <textarea name="description" rows="10" cols="40"></textarea><br>
	Phone: <input type="text" name="phone"> Email: <input type="text" name="email"><br>
	<input type="submit" name="Submit"><br>
</form>

<?php
$eventname = $starttime = $endtime = $desc = $phone = $email = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$eventname = test_input($_POST["eventname"]);
	$sStarttime = test_input($_POST["starttime"]);
	$endtime = test_input($_POST["endtime"]);
	$desc = test_input($_POST["description"]);
	$phone = test_input($_POST["phone"]);
	$email = test_input($_POST["email"]);
	
	echo("testing insert");

	$timetable_collision = "SELECT e.lid
	FROM Events_temp e
	WHERE ( EXISTS (
		SELECT e2.lid
		FROM Events_Hosted_Located e2
		WHERE e.lid = e2.lid
		AND (
		(e2.start_time <= e.start_time AND e.start_time < e2.end_time)
		OR (e2.start_time <= e.end_time AND e.end_time < e2.end_time)
		OR (e.start_time <= e2.start_time AND e2.start_time < e.end_time)
		OR (e.start_time <= e2.end_time AND e2.end_time < e.end_time)
		)
		)
	);";
	$insert_def_str = "(start_time, end_time, rid, lid, approved, type, visibility, ename, phone, email, description) ";
	$insert_data_str = "VALUES (" . $starttime . ", " . $endtime . ", 1, 1, 1, 1, 1, " . $eventname . ", " . $phone . ", " . $email . ", " . "1" . ");";
	echo $insert_data_str;
	$insert_temp = "INSERT INTO Events_Temp(start_time, end_time, rid, lid, approved, type, visibility, ename, phone, email, description)
	VALUES ('2017-03-02 12:10:00', '2017-03-02 12:40:00', 1, 1, 1, 1, 1, 'cirno', '999-999-9999', 'the_strongest@gensokyo.gov', '3');";
	$delete_temp = "DELETE FROM Events_Temp;";
	$insert_actual = "INSERT INTO Events_Hosted_Located(start_time, end_time, rid, lid, approved, type, visibility, ename, phone, email, description)
	VALUES ('2017-03-02 12:10:00', '2017-03-02 12:50:00', 1, 1, 1, 1, 1, 'cirno', '999-999-9999', 'the_strongest@gensokyo.gov', '3');";
	$conn->query("USE event;");
	$conn->query($delete_temp);
	if($conn->query($insert_temp)=== TRUE) {
		echo "new record created <br>";
	} else {
		echo "Error: " . $insert_temp . "<br>" . $conn->error;
	}
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
	$conn->query($delete_temp);
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>

<!-- Kept for reference
<?php
echo("testing insert");
$timetable_collision = "SELECT e.lid
FROM Events_temp e
WHERE ( EXISTS (
	SELECT e2.lid
	FROM Events_Hosted_Located e2
	WHERE e.lid = e2.lid
    AND (
	(e2.start_time <= e.start_time AND e.start_time < e2.end_time)
	OR (e2.start_time <= e.end_time AND e.end_time < e2.end_time)
	OR (e.start_time <= e2.start_time AND e2.start_time < e.end_time)
	OR (e.start_time <= e2.end_time AND e2.end_time < e.end_time)
	)
	)
);";
$insert_temp = "INSERT INTO Events_Temp(start_time, end_time, rid, lid, description, approved, type, visibility, ename, phone, email)
VALUES ('2017-03-02 12:10:00', '2017-03-02 12:40:00', 1, 1, 3, 1, 1, 1, 'cirno', '999-999-9999', 'the_strongest@gensokyo.gov');";
$delete_temp = "DELETE FROM Events_Temp;";
$insert_actual = "INSERT INTO Events_Hosted_Located(start_time, end_time, rid, lid, description, approved, type, visibility, ename, phone, email)
VALUES ('2017-03-02 12:10:00', '2017-03-02 12:50:00', 1, 1, 3, 1, 1, 1, 'cirno', '999-999-9999', 'the_strongest@gensokyo.gov');";
$conn->query("USE event;");
$conn->query($delete_temp);
if($conn->query($insert_temp)=== TRUE) {
	echo "new record created <br>";
} else {
    echo "Error: " . $insert_temp . "<br>" . $conn->error;
}
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
$conn->query($delete_temp);

?>
-->

</body>
</html>
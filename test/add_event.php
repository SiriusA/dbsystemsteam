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

<?php
echo("testing insert");
$timetable_collision = "SELECT e.eid
FROM Event_temp e
WHERE ( EXISTS (
	SELECT e2.eid
	FROM Events e2
	WHERE e.eid <> e2.eid
    AND e.campus = e2.campus
	AND e.building = e2.building
	AND e.room_no = e2.room_no
	AND (
	(e2.estart <= e.estart AND e.estart < e2.eend)
	OR (e2.estart <= e.eend AND e.eend < e2.eend)
	OR (e.estart <= e2.estart AND e2.estart < e.eend)
	OR (e.estart <= e2.eend AND e2.eend < e.eend)
	)
	)
);";
$insert_temp = "INSERT INTO Event_Temp(eid, estart, eend, campus, building, room_no, unid)
VALUES (2, '2017-03-02 12:10:00', '2017-03-02 12:40:00', 'a', 'aa', '202a', 1);";
$delete_temp = "DELETE FROM Event_Temp;";
$insert_actual = "INSERT INTO Events(eid, estart, eend, campus, building, room_no, unid)
VALUES (2, '2017-03-02 12:10:00', '2017-03-02 12:40:00', 'a', 'aa', '202a', 1);";
$conn->query("USE dbsys;");
$conn->query($delete_temp);
if($conn->query($insert_temp)=== TRUE) {
	echo "new record created <br>";
} else {
    echo "Error: " . $insert_temp . "<br>" . $conn->error;
}
$result = $conn->query($timetable_collision);
echo("<br> ye <br>");
if($result->num_rows == 0) {
	$result = $conn->query($insert_actual);
	echo("insert successful");
} else {
	echo "Collsion Detected";
}

$conn->query($delete_temp);

?>


</body>
</html>
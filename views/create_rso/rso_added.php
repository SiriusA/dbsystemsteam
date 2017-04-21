<html>
<body>
<?php

session_start();

include_once "../db/connection.php";
if(empty($_POST["rso_name"] ) || empty($_POST["rso_description"]) || empty($_POST["rso_member_email_1"] ) || empty($_POST["rso_member_email_2"] ) || empty($_POST["rso_member_email_3"] ) || empty($_POST["rso_member_email_4"] ))
{
    	echo "Something is not set";
    	header('Location: index.php?error=1');
    	exit();
 }
$rname = trim($_POST['rso_name']);
$description = trim($_POST['rso_description']);
$mem1 = trim($_POST['rso_member_email_1']);
$mem2 = trim($_POST['rso_member_email_2']);
$mem3 = trim($_POST['rso_member_email_3']);
$mem4 = trim($_POST['rso_member_email_4']);
$usersid = $_SESSION["sid"];
$approved = 0;
$rpicture = "empty";
$rid;


$result = db_query("INSERT INTO rso_owned (rid, sid, rname, description, approved, rpicture)
		VALUES(NULL, '$usersid', '$rname', '$description', '$approved', '$rpicture')");


	if($result == false)
	    echo "<script>alert('Error: Something Went Wrong with Insertion!');
		window.location.replace(\"../create_rso\");</script>";
	else
	{
		$rid = 'mysqli_insert_id';

	    $connection = db_connect();
	    $GLOBALS["rid"] = mysqli_insert_id($connection);
	}


$result = db_query("SELECT U.sid FROM `user` U WHERE `email` = '$mem1' OR `email` = '$mem2' OR `email` = '$mem3' OR `email` = '$mem4' OR `email` = '$mem4'");

$sid = array();

while($row = mysqli_fetch_array($result)){
	$sid[]= $row[0];
}

if (!empty($sid[3]))
{
	for($i = '0'; $i < '4'; $i++)
	{
		if($sid[$i] == $_SESSION["sid"])
		{
			echo "<script>alert('You cannot enter your own email!');</script>";
			$result = db_query("DELETE FROM rso_owned WHERE `sid` = '$usersid' AND `rid` = '$rid'");
			echo "<script>window.location.replace(\"../create_rso\");</script>";
		}

	}

	$result = db_query("INSERT INTO joins(sid, rid) VALUES('$sid[0]', '$rid')");
	$result = db_query("INSERT INTO joins(sid, rid) VALUES('$sid[1]', '$rid')");
	$result = db_query("INSERT INTO joins(sid, rid) VALUES('$sid[2]', '$rid')");
	$result = db_query("INSERT INTO joins(sid, rid) VALUES('$sid[3]', '$rid')");
	echo "<script>alert('Your RSO Has Been Created!');
	window.location.replace(\"../rso\");</script>";


}
else
{
	echo "<script>alert('You are missing a valid user email!')</script>";
	$result = db_query("DELETE FROM rso_owned WHERE `sid` = '$usersid' AND `rid` = '$rid'");
	echo "<script>window.location.replace(\"../create_rso\");</script>";
}

?>
</body>
</html>

	

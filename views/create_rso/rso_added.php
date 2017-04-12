<html>
<body>
<?php

session_start();

include_once "../db/connection.php";
$rname = trim($_POST['rso_name']);
$description = trim($_POST['rso_description']);
if(isset($_POST['submit']))
{
	$data_missing = array();

	if(empty($_POST['university_name']))
	{
		$data_missing[] = 'University Name';
	}
	else
	{
		$uname = trim($POST['university_name']);
	}

	if(empty($_POST['rso_name']))
	{
		$data_missing[] = 'RSO Name';
	}
	else
	{
		$rname = trim($POST['rso_name']);
	}

	if(empty($_POST['rso_description']))
	{
		$data_missing[] = 'RSO Description';
	}
	else
	{
		$description = trim($POST['rso_description']);
	}

	if(empty($_POST['rso_member_email_1']))
	{
		$data_missing[] = 'Member 1 Email';
	}
	else
	{
		$rsoemail = trim($POST['rso_member_email_1']);
	}

	if(empty($_POST['rso_member_email_2']))
	{
		$data_missing[] = 'Member 2 Email';
	}
	else
	{
		$rsoemail = trim($POST['rso_member_email_2']);
	}

	if(empty($_POST['rso_member_email_3']))
	{
		$data_missing[] = 'Member 3 Email';
	}
	else
	{
		$rsoemail = trim($POST['rso_member_email_3']);
	}

	if(empty($_POST['rso_member_email_4']))
	{
		$data_missing[] = 'Member 4 Email';
	}
	else
	{
		$rsoemail = trim($POST['rso_member_email_4']);
	}
}

$sid = $_SESSION["sid"];
$approved = 0;
$rpicture = "empty";
$rid;

if(empty($data_missing))
{
	$result = db_query("INSERT INTO rso_owned (rid, sid, rname, description, approved, rpicture)
		VALUES(NULL, '$sid', '$rname', '$description', '$approved', '$rpicture')");
	if($result == false)
        echo "Insertion went wrong";
    else
    {
    	echo "insertion went through";

        $connection = db_connect();
        $GLOBALS["rid"] = mysqli_insert_id($connection);
    }
}

?>
</body>
</html>

	
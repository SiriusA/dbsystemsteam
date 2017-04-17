
<?php

include 'index.php';

foreach($_POST as $key => $value) 
{
	if($value == "Join")
	{
		$result2 = db_query("UPDATE joins SET approval = '1' WHERE `sid` = '$sid' AND `rid` = '$key'");
		if($result2 == false)
        	echo "Insertion went wrong";
    	else
    		header('Location: /home');

	}
	elseif($value == "Deny")
	{
		$result3 = db_query("DELETE FROM joins WHERE `sid` = '$sid' AND `rid` = '$key'");
		if($result3 == false)
        	echo "Insertion went wrong";
    	else
    		header('Location: /home');

	}

}
	

	


	

?>
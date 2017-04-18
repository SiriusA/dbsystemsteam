
<?php

include 'index.php';

foreach($_POST as $key => $value) 
{
	if($value == "Join")
	{
		$result2 = db_query("UPDATE joins SET approval = '1' WHERE `sid` = '$sid' AND `rid` = '$key'");
        $numapproved = array();
        $result3 = db_query("SELECT J.approval FROM joins J WHERE `approval` = '1'");
        while($row = mysqli_fetch_array($result3)){
            $numapproved[] = $row;
         }
        if($numapproved[3]!= null)
        {
            $result1 = db_query("UPDATE rso_owned SET approved = '1' WHERE `rid` = '$key'");
            $result4 = db_query("SELECT R.sid FROM rso_owned R WHERE `rid` = '$key'");
            while($row = mysqli_fetch_array($result4)){
            $adminsid = $row[0];
            }
            $result5 = db_query("UPDATE user SET utype = '2' WHERE `sid` = '$adminsid'");

        }
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

function approveRSO($rid){
    
    
}
	

	


	

?>
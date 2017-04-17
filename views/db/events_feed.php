<?php

// Bring database connection into file
include_once "../db/connection.php";

function fillEventTable($feed_url) {

    // Feed the RSS URL into function and pull each element
    $rss_feed = file_get_contents($feed_url);
    $element = new SimpleXmlElement($rss_feed);

    $i = 0;
    $conn = getConnObj();
    $conn2 = getConnObj();
    $conn3 = getConnObj();
    $eventIns = $conn->prepare("INSERT INTO events_hosted_located (approved, description, email, ename, end_time, lid, phone, rid, start_time, type, visibility)
                                VALUES ('0', ?, ?, ?, ?, ?, ?, ?, ?, 0, 1)");
    $eventIns->bind_param("ssssisis", $description, $contact_email, $name, $end_time, $locationid, $contact_phone, $rid, $start_time);
    $locIns = $conn2->prepare("INSERT INTO location (uid, lname, url)
              VALUES ('1', ?, ?)");
    $locIns->bind_param("ss", $location_name, $location_url);
    $locQuery = $conn3->prepare("SELECT L.lid
                               FROM location L
                               WHERE L.lname = ?");
    $locQuery->bind_param("s", $location_name);
    $locQuery->bind_result($locationidres);

    // Go through each event in the RSS and pull the data
    foreach($element->channel->item as $event) {

        $ename = $event->title;
        $description = $event->description;
        $start_time = $event->children('http://events.ucf.edu')->startdate;
        $end_time = $event->children('http://events.ucf.edu')->enddate;
        $name = $event->children('http://events.ucf.edu')->location->children('http://events.ucf.edu')->name;
        $contact_name = $event->children('http://events.ucf.edu')->contact->children('http://events.ucf.edu')->contactname;
        $contact_phone = $event->children('http://events.ucf.edu')->contact->children('http://events.ucf.edu')->contactphone;
        $contact_email = $event->children('http://events.ucf.edu')->contact->children('http://events.ucf.edu')->contactemail;
    		$location_name = $event->children('http://events.ucf.edu')->location->children('http://events.ucf.edu')->name;
		    $location_url = $event->children('http://events.ucf.edu')->location->children('http://events.ucf.edu')->mapurl;

        /*
        $ename = test_input($ename);
        $description = test_input($description);
        $start_time = test_input($start_time);
        $end_time = test_input($end_time);
        $name = test_input($name);
        $contact_name = test_input($contact_name);
        $contact_phone = test_input($contact_phone);
        $contact_email = test_input($contact_email);
        $location_name = test_input($location_name);
        $location_url = test_input($location_url);
        */

        //`Sat, 15 Apr 2017 08:00:00 -0400`
        //Fix dates
        $start_time = date_create_from_format( "D, d M Y H:i:s O", $start_time);
        $end_time = date_create_from_format( "D, d M Y H:i:s O", $end_time);

        $start_time = $start_time->format("Y-m-d H:i:s");
        $end_time = $end_time->format("Y-m-d H:i:s");


      	//fill location table
      	//db_query("INSERT INTO location (uid, lname, url)
      	//	      VALUES ('1', '$location_name', '$location_url')");

        if(!$locIns->execute())
        {
//          echo "insert location failed<br>" . $locIns->error . "<br>";
        }

//      $locationidres = db_query('SELECT L.lid
//                                   FROM location L
//                                   WHERE L.lname = "' . $location_name . '"');



        $locationid = 0;

        if($locQuery->execute() == FALSE){
//          echo "something failed<br>";
        }
        else if($locQuery->fetch() != NULL){
          $locationid = $locationidres;
        }
        else {
//          echo "no data:" . $location_name . "<br>";
        }

        $rid = 1;

        // Feed each event into the database event table
        //db_query("INSERT INTO events (e_approved, e_description, e_email, e_name, e_end, lid, e_phone, rid, e_start)
        //            VALUES ('0', '$description', '$contact_email', '$ename', '$end_time', '$locationid', '$contact_phone', '1', '$start_time')");

        if($eventIns->execute() == FALSE)
        {
//          echo $eventIns->error . "<br>";
        }

        $i++;
      }

      $eventIns->close();
      $locIns->close();
      $locQuery->close();

      $conn->close();
      $conn2->close();
      $conn3->close();

}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}



?>

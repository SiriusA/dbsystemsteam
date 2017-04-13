<?php

// Bring database connection into file
include_once "../db/connection.php";

function fillEventTable($feed_url) {

    // Feed the RSS URL into function and pull each element
    $rss_feed = file_get_contents($feed_url);
    $element = new SimpleXmlElement($rss_feed);

    $i = 0;

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


      	//fill location table
      	db_query("INSERT INTO location (uid, lname, url)
      			      VALUES ('1', '$location_name', '$location_url')");

        $locationidres = db_query('SELECT L.lid
                                   FROM location L
                                   WHERE L.lname = "' . $location_name . '"');

        $locationid = -1;

        if($locationidres === FALSE){
          echo "something failed";
        }

        else {
          $locationid = $locationidres->fetch_row()[0];
        }
            // Feed each event into the database event table
            db_query("INSERT INTO events (e_approved, e_description, e_email, e_name, e_end, lid, e_phone, rid, e_start)
                      VALUES ('0', '$description', '$contact_email', '$ename', '$end_time', '$locationid', '$contact_phone', '1', '$start_time')");
           $i++;
      }
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}



?>

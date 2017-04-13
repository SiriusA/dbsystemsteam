<?php

// Bring database connection into file
include_once "../db/connection.php";

function fillEventTable($feed_url) {

    // Feed the RSS URL into function and pull each element
    $rss_feed = file_get_contents($feed_url);
    $element = new SimpleXmlElement($rss_feed);

    // Testin/Display purposes only
    echo "<ul>";

    $i = 0;
    // Go through each event in the RSS and pull the data
    foreach($element->channel->item as $event) {

//        echo "<li>".$event->title."</li>";
        $ename = $event->title;

//        echo "<li>".$event->description."</p>";
        $description = $event->description;

//        echo "<li>" .$event->children('http://events.ucf.edu')->startdate. "</li>";
        $start_time = $event->children('http://events.ucf.edu')->startdate;

//        echo "<li>" .$event->children('http://events.ucf.edu')->enddate. "</li>";
        $end_time = $event->children('http://events.ucf.edu')->enddate;

//        echo "<li>" .$event->children('http://events.ucf.edu')->location->children('http://events.ucf.edu')->name. "</li>";
        $name = $event->children('http://events.ucf.edu')->location->children('http://events.ucf.edu')->name;

//        echo "<li>" .$event->children('http://events.ucf.edu')->contact->children('http://events.ucf.edu')->contactname. "</li>";
        $contact_name = $event->children('http://events.ucf.edu')->contact->children('http://events.ucf.edu')->contactname;

//        echo "<li>" .$event->children('http://events.ucf.edu')->contact->children('http://events.ucf.edu')->contactphone. "</li>";
        $contact_phone = $event->children('http://events.ucf.edu')->contact->children('http://events.ucf.edu')->contactphone;

//        echo "<li>" .$event->children('http://events.ucf.edu')->contact->children('http://events.ucf.edu')->contactemail."</li>";
        $contact_email = $event->children('http://events.ucf.edu')->contact->children('http://events.ucf.edu')->contactemail;

        echo "<li>" . $event->children('http://events.ucf.edu')->location->children('http://events.ucf.edu')->name . "</li>";
    		$location_name = $event->children('http://events.ucf.edu')->location->children('http://events.ucf.edu')->name;

//		    echo "<li>" . $event->children('http://events.ucf.edu')->location->children('http://events.ucf.edu')->mapurl . "</li>";
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
    if($locationidres === FALSE)
    {
      echo "something failed";
    }
    else {
      $locationid = $locationidres->fetch_row()[0];
    }
        /*
            events table holds
              start_time  datetime
              end_time    datetime
              rid         int(11)
              lid         int(11)
              description text
              approved    tinyint(4)
              type        int(11)
              visibility  int(11)
              ename       varchar(50)
              phone       varchar(50)
              email       varchar(50)
        */
        // Feed each event into the database event table

        db_query("INSERT INTO events (e_approved, e_description, e_email, e_name, e_end, lid, e_phone, rid, e_start)
                  VALUES ('0', '$description', '$contact_email', '$ename', '$end_time', '$locationid', '$contact_phone', '1', '$start_time')");


       $i++;
    }

    // Testing/ dispay purposes only
    echo "</ul>";
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}



?>

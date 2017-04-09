<?php

// Bring database connection into file
include "../db/connection.php";

function fillEventTable($feed_url) {

    // Feed the RSS URL into function and pull each element
    $rss_feed = file_get_contents($feed_url);
    $element = new SimpleXmlElement($rss_feed);

    // Testin/Display purposes only
    echo "<ul>";

    // Go through each event in the RSS and pull the data
    foreach($element->channel->item as $event) {

        echo "<li>".$event->title."</li>";
        $ename = $event->title;

        echo "<li>".$event->description."</p>";
        $description = $event->description;

        echo "<li>" .$event->children('http://events.ucf.edu')->startdate. "</li>";
        $start_time = $event->children('http://events.ucf.edu')->startdate;

        echo "<li>" .$event->children('http://events.ucf.edu')->enddate. "</li>";
        $end_time = $event->children('http://events.ucf.edu')->enddate;

        echo "<li>" .$event->children('http://events.ucf.edu')->location->children('http://events.ucf.edu')->name. "</li>";
        $name = $event->children('http://events.ucf.edu')->location->children('http://events.ucf.edu')->name;

        echo "<li>" .$event->children('http://events.ucf.edu')->contact->children('http://events.ucf.edu')->contactname. "</li>";
        $contact_name = $event->children('http://events.ucf.edu')->contact->children('http://events.ucf.edu')->contactname;

        echo "<li>" .$event->children('http://events.ucf.edu')->contact->children('http://events.ucf.edu')->contactphone. "</li>";
        $contact_phone = $event->children('http://events.ucf.edu')->contact->children('http://events.ucf.edu')->contactphone;

        echo "<li>" .$event->children('http://events.ucf.edu')->contact->children('http://events.ucf.edu')->contactemail."</li>";
        $contact_email = $event->children('http://events.ucf.edu')->contact->children('http://events.ucf.edu')->contactemail;

        // Feed each event into the database event table
        //db_query("INSERT INTO event_test (ename, description, start_time, end_time, phone)
        //          VALUES ('$ename', '$description', '$start_time', '$end_time', '$phone')");
    }

    // Testing/ dispay purposes only
    echo "</ul>";
}
?>

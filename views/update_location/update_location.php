<?php

$zoomMapQ = $conn->prepare("UPDATE location L
                           SET L.longitude = ?, L.latitude = ?
                           WHERE l.lid = ?");
$zoomMapQ->bind_param("ssssisis", $description, $contact_email, $name, $end_time, $locationid, $contact_phone, $rid, $start_time);

?>

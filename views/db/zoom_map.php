<?php
include_once "../db/connection.php";

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$conn = getConnObj();



if(!empty($_GET["lid"])){
  $lid = test_input($_GET["lid"]);
}
else{
  $lid = -1;
}

if($lid == -1)
{

} else {
  $zoomMapRes = $conn->query("SELECT L.latitude, L.longitude
                              FROM location L
                              WHERE l.lid = " . $lid . "");

  if($zoomMapRes != NULL)
  {
    $zoomMap = $zoomMapRes->fetch_array();
    echo "var loc = {lat: 0, lng: 0};";
    if($zoomMap["latitude"] == null || $zoomMap["longitude"] == null) {
      echo "loc = {lat: 0, lng: 0};";
    }
    else
    {
      echo "loc = {lat: ".$zoomMap["latitude"].", lng: ".$zoomMap["longitude"]."};";
    }
    echo "marker.setPosition(loc);";
    echo "map.setCenter(loc);";
  }
}

$conn->close();

?>

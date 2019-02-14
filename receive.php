<?php
// include "dbconnect.php";

	if(isset($_POST['d'])){
		$distance = $_POST['d'];
		$location = $_POST['l'];
	}elseif(isset($_GET['d'])){
		$distance = $_GET['d'];
		$location = $_GET['l'];
	}else{
		$distance = "";
		$location = "";
	}

	echo "<br/><h2>Receiving Data...</h2><br/>";

	if(empty($distance) || empty($location)){
		die("DISTANCE AND LOCATION REQUIRED");
	}

	echo "<h1>DISTANCE: $distance</h1>";
	echo "<h1>DISTANCE: $location</h1>";

	require('dbconnect.php');

	echo "<h1>MY RECEIVING PAGE - Receive</h1><br/>";


	// $dt = mktime(2,3,4,10,13,2020);
	$dt = date('Y-m-d G:i:s');

	$condb = $conn->insert($distance, $location, $dt);

	// var_dump($condb);

	// $stmt = $myPDO->prepare("INSERT INTO garbage_data (distance, location, cdatetime) VALUES (:distance, :location, NOW())");

	// // perform the query
	// $stmt->execute([
	// 	':distance' => $distance,
	// 	':location' => $location
	// ]);


	echo "<h4>DATA RECEIVED SUCCESSFULLY </h4>";

?>

<?php

	$mysqli = new mysqli('localhost', 'root', 'root', 'surveyDb');

	if ($mysqli->connect_errno) {
		echo "could not connect to db";
		exit();
	}

	$stored_data = array();
	$stored_header = array();

	$genres['kpop'] = Array();
	$genres['rnb'] = Array();
	$genres['opm'] = Array();
	$genres['lovesong'] = Array();
	$genres['rock'] = Array();

	$search = (isset($_REQUEST['search'])) ? " WHERE `name` LIKE '%{$_REQUEST['search']}%' " : '';

	$sql = "SELECT * 
			FROM `surveytable` 
			{$search}
			ORDER BY `survey_id` DESC
			";
			
	if ( ! $result = $mysqli->query($sql)) {
		echo $mysqli->error;
	}

	while ($row = $result->fetch_assoc()) {
		$stored_header = array_keys($row);

		foreach ($row as $key => $value) {
			if (in_array($key, Array('kpop', 'rnb', 'opm', 'rock', 'lovesong'))) {
				array_push($genres[$key], $value);
			}	
		}


		array_push($stored_data, $row);
	}

?>

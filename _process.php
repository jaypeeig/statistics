<?php

require_once 'connection.php';

$post = $_POST;
$get = $_GET;
$allowed_fields = Array('name', 'kpop', 'opm', 'rnb', 'rock', 'lovesong', 'survey_id');

if (isset($post['add-data'])) {

	foreach ($post as $key => $value) {
		if (! in_array($key, $allowed_fields)) {
			unset($post[$key]);
		}
	}

	$insert_data = $post;

	$sql = sprintf(
	    'INSERT INTO surveytable (%s) VALUES ("%s")',
	    implode(',',array_keys($insert_data)),
	    implode('","',array_values($insert_data))
	);

	if ( ! $result = $mysqli->query($sql)) {
		header('location: index.php?error='.urldecode($mysqli->error));
	}

	header('location: index.php?success');

}

if (isset($post['fetch-data']) AND (isset($post['id']))) {

	$sql = "SELECT * 
			FROM `surveytable`
			WHERE `survey_id` = {$post['id']}
			";
	
	if ( ! $result = $mysqli->query($sql)) {
		header('location: index.php?error='.urldecode($mysqli->error));
	}

	echo json_encode($result->fetch_assoc());	

}

if (isset($post['update-data']) AND (isset($post['survey_id']))) {

	foreach ($post as $key => $value) {
		if (! in_array($key, $allowed_fields)) {
			unset($post[$key]);
		}
	}

	$id = $post['survey_id'];
	unset($post['survey_id']);

	$sql = "
		UPDATE `surveytable`
		SET ";

	$counter = 1;
	$max = sizeof($post);
	foreach ($post as $key => $value) {
		$trail = ($max == $counter) ? '' : ', ';
		$sql .= "`{$key}` = '{$value}'" . $trail;
		$counter++;
	}
		
	$sql .= " WHERE `survey_id` = {$id}
	";

	if ( ! $result = $mysqli->query($sql)) {
		header('location: index.php?error='.urldecode($mysqli->error));
	}

	header('location: index.php?success');

}	

if (isset($get['delete-data']) AND (isset($get['id']))) {
	$sql = "DELETE  
			FROM `surveytable`
			WHERE `survey_id` = {$get['id']}
			";
	
	if ( ! $result = $mysqli->query($sql)) {
		header('location: index.php?error='.urldecode($mysqli->error));
	}

	header('location: index.php?success');
}


?>

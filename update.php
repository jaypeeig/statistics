<?php

if (isset($_REQUEST['sub'])) {
	require "class.php";
		$db = new Stats;
		$db->connect();
	if (isset($_REQUEST['id'])) {
		$id = $_REQUEST['id'];
	}
	else
	{
		die("no id");
	}

	$nme= $_REQUEST['nme'];
	$sun= $_REQUEST['sun'];
	$mon= $_REQUEST['mon'];
	$tue= $_REQUEST['tue'];
	$wed= $_REQUEST['wed'];
	$thu= $_REQUEST['thu'];
	$fri= $_REQUEST['fri'];
	$sat= $_REQUEST['sat'];

	$setquery = "UPDATE `dbstats`.`tbstats` SET `name` = '{$nme}', `sun` = '{$sun}', `mon` = '{$mon}',";
	$setquery .= " `tue` = '{$tue}', `wed` = '{$wed}', `thu` = '{$thu}', `fri` = '{$fri}', `sat` = '{$sat}' WHERE `tbstats`.`id` = {$id};";

	if (mysql_query($setquery)) {
		echo "<script>alert('data updated.');</script>";
		echo "<script>location.href = 'homepage.php?update_success';</script>";
	}else{
		die(mysql_error());
	}

}



?>
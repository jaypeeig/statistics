<?php

	if (isset($_REQUEST['id'])) {
		$id = $_REQUEST['id'];
		require "class.php";
		$db = new Stats;
		$db->connect();
		$qry = "delete from tbstats where id = " . $id;
		
		if ( mysql_query($qry) ){
			echo "<script>alert('data deleted.');</script>";
			echo "<script>location.href = 'homepage.php?delete_success';</script>";
	
		}
	}
	else
	{
		die("no id");
	}
?>

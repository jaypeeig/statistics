<?php

require "class.php";
	$db = new Stats;
	$db->connect();
	$res = array();

	
		for ($i=0; $i < (1 + 3.322 * log10($db->cntrow("name"))); $i++) { 
			echo "sadas  as";

		}


?>
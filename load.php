<?php

if (isset($_REQUEST['day'])) {
	require "class.php";
	$db = new Stats;
	$db->connect();
	$data = array();
	$day = $_REQUEST['day'];
}else{
	die("no day");
}


?>

	<table class="table table-striped table-hover ">
		  <thead>
		    <tr class="success">
		      <th>Class</th>
		      <th>Frequency</th>
		      <th>CFrequency</th>
		      <th>UpperB</th>
		      <th>LowerB</th>
		      <th>Class Mark</th>
		    </tr>
		  </thead>
		  <tbody>
		    	   

		    <?php
		    
		    switch ($day) {
		    	case 'allday':
		    		$ht = 0; 
		    		$ave =0;
		    		$freq = 0;
					$cfreq = 0;
					$weekly_each = array();
		    		//count allday
		    		$alldata = $db->fillarray('tbstats');
		    		foreach ($alldata as $row) {
		    				$wk = (($row['sun'] + $row['mon'] + $row['tue'] + $row['wed'] + $row['thu'] + $row['fri'] + $row['sat']));
							$ave += $wk;							
							$weekly_each[$ht] = $wk;
							$ht++;	
		    		}
		    		
		    			$total = $db->cntrow("name");
		    			$upper = max($weekly_each);
						$lower = min($weekly_each);
						$ave = ($ave/($ht+1));
						$ttl = $db->rangeweek($total,$upper,$lower);
						$rwek = $db->rangeweek($total,$upper,$lower);
						$freq = 0;
						$cfreq = 0;
						$miiin = ($wk/7);
		    		
		    		break;
		    	
		    	default:
			    		//declare variables for weekdays
			    		$total = $db->cntrow("sun");
			    		$ttl = $db->ranges($db->select_min($day),$db->select_max($day),$total);
			   			$freq = 0;
						$cfreq = 0;
						$miiin = $db->avemean($day);
			    		break;
		    }

		    

			for ($i=0; $i < (1 + 3.322 * log10( $total )); $i++) { 
				switch ($day) {
					case 'allday':
						//all day
						$datatb = array();
						$min =  ($i * $ttl);
						$max =	($min + ($ttl)) - 1; $lb = (max($min - 0.5,0)); $ub = ($max + 0.5);
						$x = (($min+$max)/2);
						$datatb = $db->fillarray("tbstats");
						foreach ($datatb as $row) {
							 $wk = (($row['sun'] + $row['mon'] + $row['tue'] + $row['wed'] + $row['thu'] + $row['fri'] + $row['sat']));
							 if (($wk >= $min) && ($wk <= $max)) {
								$freq = $freq + 1; $cfreq++;
					      	 }
						}	 
						break;
					
					default:
						//for every row data
						$min =  ($i * $ttl);
						$max =	($min + ($ttl)) - 1; 
						$lb = (max($min - 0.5,0)); 
						$ub = ($max + 0.5);
						$x = (($min+$max)/2);

						$qry = "select " . $day . " from tbstats";
						$res = mysql_query($qry) or die(mysql_error());
						while ($tally = mysql_fetch_array($res)) {
							$fre = $tally[$day];
							if (($fre >= $min) && ($fre <= $max)) {
							    $freq = $freq + 1; $cfreq++;
							}			
						}

						break;
				}

				



				echo "<tr>";	
					echo  "<td>" .$min." - ".$max . "</td>";
					echo "<td>" . $freq . "</td>";
					echo "<td>" . $cfreq . "</td>";
					echo "<td>" . $lb . "</td>";
					echo "<td>" . $ub . "</td>";
					echo "<td>" . $x . "</td>";

				echo "</tr>";
				
					$farray[$i]["min"] = $min;
					$farray[$i]["max"] = $max;
					$farray[$i]["f"] = $freq;
					$farray[$i]["cf"] = $cfreq;
					$farray[$i]["ub"] = $ub;
					$farray[$i]["lb"] = $lb;
					$farray[$i]["x"] = $x;
					$farray[$i]["xx"] = ($x - $miiin);
					$farray[$i]["xxx"] = ($farray[$i]["xx"] * $farray[$i]["xx"]);
					$farray[$i]["fxx"] = $farray[$i]["xxx"] * $freq;

				//reset freq.
				$freq = 0;
			}


		    ?>
		
		
		  </tbody>
		</table> 

		<br/>

		<table class="table table-striped table-hover ">
		  <thead>
		    <tr class="success">
		      <th>Mean</th>
		      <th>Median</th>
		      <th>Mode</th>
		      <th>Variance</th>
		      <th>Standard Devation</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<tr>
		      <th><?php $day == 'allday' ? $out = $db->averag() : $out = $db->mean($day); echo $out; ?></th>
		      <th><?php echo $db->median($day,$farray); ?></th>
		      <th><?php echo $db->modal($day,$farray); ?></th>
		      <th><?php echo $db->varian($farray); ?></th>
		      <th><?php echo $db->sd($farray); ?></th>
		    </tr>
		   </tbody>
		</table> 

		<!-- end of page -->
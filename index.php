<?php

 //header("location:homepage.php");

?>
<!DOCTYPE html>

<head>
	<title>Facebook Survey Site</title>
	<link href="styles.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="page">
	<div id="site_title">
		<span class = "color02">Facebook Time Survey Site</span>
	</div>
		<div id="primary_content">
			<div id="menu">
					<ul>
					<li><span class="color04">|</span></li>
					<li><span class="color01"><a href="index.php">Statistics</a></span> </li>
					<li><span class="color04">|</span></li>
					<li><span class="color02"> <a href="new.php">New Entry</a></span></li>
					<li><span class="color04">|</span></li>
				</ul>
			</div>

		      <div id="page_content">
	     <h1>Survey</h1><h2> for Facebook Usage.</h2>
			<div id = 'container1'>	
			    <p align="center">Table showing no. of minute(s) spent browsing facebook.</p>
				 <hr>
				<?php

					//require('computations.php');
					mysql_connect("localhost","root","root") or die(mysql_error());
					mysql_query('CREATE DATABASE IF NOT EXISTS dbstats');
					mysql_select_db('dbstats');
					//create view for weekly average

						//---------------insert
						//require ("insert.php");

					     $viewd = ("CREATE VIEW weeks
									AS SELECT
										sum(sun) as sun,
										sum(mon) as mon,
										sum(tue) as tue,	
										sum(wed) as wed,
										sum(thu) as thu,
										sum(fri) as fri,
										sum(sat) as sat 
										From tbstats;");
					
					     $wkstbl = ("DROP TABLE if EXISTS wksave;");
					     $commit = mysql_query($wkstbl) or die (mysql_error());
					     mysql_query($commit);//execute the view

					     mysql_query('CREATE TABLE wksave
							(
								wks int
							)');

					    $exec1 = ("insert into wksave(wks) values ((SELECT sum(sun) From tbstats));");
						$exec2 = ("insert into wksave(wks) values ((SELECT sum(mon) From tbstats));");
						$exec3 = ("insert into wksave(wks) values ((SELECT sum(tue) From tbstats));");
						$exec4 = ("insert into wksave(wks) values ((SELECT sum(wed) From tbstats));");
						$exec5 = ("insert into wksave(wks) values ((SELECT sum(thu) From tbstats));");
						$exec6 = ("insert into wksave(wks) values ((SELECT sum(fri) From tbstats));");
						$exec7 = ("insert into wksave(wks) values ((SELECT sum(sat) From tbstats));");

					    
					    	mysql_query("START TRANSACTION");
					    	
						if ($exec1 && $exec2 && $exec3 && $exec4 && $exec5 && $exec6 && $exec7){
							mysql_query($exec1) or die (mysql_error());
							mysql_query($exec2) or die (mysql_error());
							mysql_query($exec3) or die (mysql_error());
							mysql_query($exec4) or die (mysql_error());
							mysql_query($exec5) or die (mysql_error());
							mysql_query($exec6) or die (mysql_error());
							mysql_query($exec7) or die (mysql_error());
							mysql_query("COMMIT");
						}
						else{
							mysql_query("ROLLBACK");
						}	
					    

					   /* */

					$query = "Select * from tbstats";
					$result = mysql_query($query) or die(mysql_error());		
							echo "<div class = 'tbl'>";
							echo 	"<table class= 'gridtable' align = 'center'>
									<tr>
									<th>ID</th>
									<th>Student Name</th>
									<th>Sunday</th>
									<th>Monday</th>
									<th>Tuesday</th>
									<th>Wednesday</th>
									<th>Thursday</th>
									<th>Friday</th>
									<th>Saturday</th>
 									</tr>";
					while($row = mysql_fetch_array($result))
							{
								echo "<tr>";
								echo "<td>" . $row['id'] . "</td>";
								echo "<td>" . $row['name'] . "</td>";
								echo "<td>" . $row['sun'] . "</td>";
								echo "<td>" . $row['mon'] . "</td>";
								echo "<td>" . $row['tue'] . "</td>";
								echo "<td>" . $row['wed'] . "</td>";
								echo "<td>" . $row['thu'] . "</td>";
								echo "<td>" . $row['fri'] . "</td>";
								echo "<td>" . $row['sat'] . "</td>";
								echo "</tr>";
							}
							echo "</table>";
							echo "</div>";
							echo "<hr>";
                   //end of line          
                 ?>
					
					<br>
		

<?php
	function modal($day){
	    global $farray;
	    $counter = 0; $divt = 0;
		for ($i=0; $i <(count($farray)) ; $i++) {
			if ($farray[$i]["f"] >= $counter){
				$counter =  $farray[$i]["f"];
				$divt = $i;
			}
			
		}
		switch ($day) {
			case 'allday':
				global $rwek;
				$rng = $rwek;
				break;
			
			default:
				$rng = ranges(select_min($day),select_max($day),cnt($day));
				break;
		}
		//$rng = ranges(select_min($day),select_max($day),cnt($day));
		$mol = $farray[$divt]["lb"]; $mof = $farray[$divt]["f"];
		$f_1 = $divt > 0 ? $farray[$divt - 1]["f"] : 0;
		$f_2 = $divt < count($farray) ? $farray[$divt + 1]["f"] : 0;
		$mode = ($mol + ($mof - $f_1) * $rng / (2 * $mof - $f_1 - $f_2));
		$mode = round($mode,2);
	return $mode;
	}

    function select_min($day){
		$output = "select min(".$day.") from tbstats";



		$qr = mysql_query($output);
		$row = mysql_fetch_row($qr);
		$final = $row[0];
		return $final;
	}

	function select_max($day){
		$output =  "select max(".$day.") from tbstats";
		$qr = mysql_query($output);
		$row = mysql_fetch_row($qr);
		$final = $row[0];
		return $final;
	}
//ranges(select_min('sun'),select_max('sun'),cnt('sun'));

	function ranges($min,$max,$count){
		$trow =	round( ($max - $min) / (1 + 3.322 * log10($count)));
		return $trow;
	}

	function rangeweek($count,$u,$l){

		$trow =	round( ($u-$l) / (1 + 3.322 * log10($count)));
		return $trow;
	}
				
	function avemean($day){
		$output =  "select avg(".$day.") from tbstats";
		$qr = mysql_query($output);
		$row = mysql_fetch_row($qr);
		$final = $row[0];
		return $final;
	}

	function summit($day){
		$output =  "select sum(".$day.") from tbstats";
		$qr = mysql_query($output);
		$row = mysql_fetch_row($qr);
		$final = $row[0];
		return $final;
	}

	function cnt($nm){
		$count = "select count(".$nm.") from tbstats";
		$query_count =  mysql_query($count);
		$row = mysql_fetch_row($query_count);
		$total = $row[0];
		return $total;
	}

	function mean_dis($id_d){
		echo "<table class = 'gridtable' style='display: inline-block'>";
		echo "<th>Mean</th>";
		echo "<tr><td>". round(avemean($id_d),2) ."</td></tr>";
		echo "</table>";
	}


	function varian(){
					global $farray;
					$final = 0;
					$cnn = (cnt('name')-1);
					$limit = count($farray);
					for ($i=0; $i < $limit ; $i++) { 
						$final += $farray[$i]["fxx"];
					}
					$final = ($final/$cnn);
					$final = round($final,2);
					return $final;
			}

	function sd(){
					$ret = sqrt(varian());
					$ret = round($ret,2);
					return $ret;
				}


	function med($day){
			
			
			global $farray;
			$destined = 100;
			$totaled = cnt($day);
			$div = ($totaled/2);
			
			for ($i=0; $i < (count($farray) - 1) ; $i++) { 
				
				if($farray[$i]["cf"] <= $div){
					$destined = $i+1;
				}
				
			}
			if ($destined == 100) {
				$destined = 0;
			}
			
					
			$lb = $farray[$destined]["lb"];
			$preceed =  $destined > 0 ? $farray[$destined - 1]["cf"] : 0;
			$rng = ranges(select_min($day),select_max($day),cnt($day));
			$fm = $farray[$destined+1]["f"];
			$median = ($lb + (($div)-$preceed) * $rng / $fm);

			return round($median,2);
			}


	function averag()
	{
		$query = "Select * from tbstats";
					$result = mysql_query($query) or die(mysql_error());		
					$ht = 0;$ave = 0;
					$weekly_each = array();
					while($row = mysql_fetch_array($result))
							{
							
							$wk = (($row['sun'] + $row['mon'] + $row['tue'] + $row['wed'] + $row['thu'] + $row['fri'] + $row['sat']));
							$ave = $ave + $wk;
							$weekly_each[$ht] = $wk;
							$ht++;			
							}
					$ave =  ($ave/($ht+1));
					$ave = round($ave, 2);
	return $ave;
	}

?>

<script language="JavaScript" type="text/javascript">
    function selectTab(num) {
        for (var i=1; i <= 8; i++) {
          document.getElementById("tab" + i).className = "";
          document.getElementById("box" + i).className = "infobox";
 	    }
	document.getElementById("tab" + num).className = "selected";
  	document.getElementById("box" + num).className = "infobox enabled";
	}
</script>

	<body onload="selectTab(1);">
  	    <div id="tabs"> 
      		<ul id="buttons">
      			    <li><a href="#" id="tab1" onclick="selectTab(1); return false;" onfocus="blur();">Sunday</a></li>
  					<li><a href="#" id="tab2" onclick="selectTab(2); return false;" onfocus="blur();">Monday</a></li>
     				<li><a href="#" id="tab3" onclick="selectTab(3); return false;" onfocus="blur();">Tuesday</a></li>
      				<li><a href="#" id="tab4" onclick="selectTab(4); return false;" onfocus="blur();">Wednesday</a></li>
      				<li><a href="#" id="tab5" onclick="selectTab(5); return false;" onfocus="blur();">Thursday</a></li>
      				<li><a href="#" id="tab6" onclick="selectTab(6); return false;" onfocus="blur();">Friday</a></li>
      				<li><a href="#" id="tab7" onclick="selectTab(7); return false;" onfocus="blur();">Saturday</a></li>
      				<li><a href="#" id="tab8" onclick="selectTab(8); return false;" onfocus="blur();">Week</a></li>
    		</ul>
   		<div id="box1" class="infobox"> 
           		<?php
           		echo "<table align = 'center'>";
           		echo "<tr>";
           		echo "<td>";
           		$total = cnt('name');
           		dis('sun');
           		echo "</td>";
           		echo "<td valign = 'baseline'>";
           		mean_dis('sun');
           		echo "<table class = 'gridtable' style = 'margin-top: 12px'><th>Median</th><tr><td>".med('sun')."</td></tr></table>";
           		echo "<table class = 'gridtable' style = 'margin-top: 12px'><th>Mode</th><tr><td>".modal('sun')."</td></tr></table>";
           		echo "</td>";


           		echo "<td valign = 'top'>";
           		echo "<table class = 'gridtable' style = 'margin-left: 12px'><th>Variance</th><tr><td>".varian()."</td></tr></table>";
           		echo "<table class = 'gridtable' style = 'margin-top: 19px; margin-left: 12px' ><th>SDevation</th><tr><td>".sd()."</td></tr></table>";
           	

           		echo "</tr>";
           		echo "</table>";
           	
           		?>
    	</div>
        
        <div id="box2" class="infobox"> 
          		<?php
           		echo "<table align = 'center'>";
           		echo "<tr>";
           		echo "<td>";
           		$total = cnt('name');
           		dis('mon');
           		echo "</td>";
           		echo "<td valign = 'baseline'>";
           		mean_dis('mon');
           		echo "<table class = 'gridtable' style = 'margin-top: 12px'><th>Median</th><tr><td>".med('mon')."</td></tr></table>";
           		echo "<table class = 'gridtable' style = 'margin-top: 12px'><th>Mode</th><tr><td>".modal('mon')."</td></tr></table>";
           		echo "</td>";


           		echo "<td valign = 'top'>";
           		echo "<table class = 'gridtable' style = 'margin-left: 12px'><th>Variance</th><tr><td>".varian()."</td></tr></table>";
           		echo "<table class = 'gridtable' style = 'margin-top: 19px; margin-left: 12px' ><th>SDevation</th><tr><td>".sd()."</td></tr></table>";
           	

           		echo "</tr>";
           		echo "</table>";
           		?>
        </div>
                        	
        <div id="box3" class="infobox">
       
           		<?php
           		echo "<table align = 'center'>";
           		echo "<tr>";
           		echo "<td>";
           		$total = cnt('name');
           		dis('tue');
           		echo "</td>";
           		echo "<td valign = 'baseline'>";
           		mean_dis('tue');
           		echo "<table class = 'gridtable' style = 'margin-top: 12px'><th>Median</th><tr><td>".med('tue')."</td></tr></table>";
           		echo "<table class = 'gridtable' style = 'margin-top: 12px'><th>Mode</th><tr><td>".modal('tue')."</td></tr></table>";
           		echo "</td>";


           		echo "<td valign = 'top'>";
           		echo "<table class = 'gridtable' style = 'margin-left: 12px'><th>Variance</th><tr><td>".varian()."</td></tr></table>";
           		echo "<table class = 'gridtable' style = 'margin-top: 19px; margin-left: 12px' ><th>SDevation</th><tr><td>".sd()."</td></tr></table>";
           	

           		echo "</tr>";
           		echo "</table>";
           		?>
        </div>
        
        <div id="box4" class="infobox"> 
         
           		<?php
           		echo "<table align = 'center'>";
           		echo "<tr>";
           		echo "<td>";
           		$total = cnt('name');
           		dis('wed');
           		echo "</td>";
           		echo "<td valign = 'baseline'>";
           		mean_dis('wed');
           		echo "<table class = 'gridtable' style = 'margin-top: 12px'><th>Median</th><tr><td>".med('wed')."</td></tr></table>";
           		echo "<table class = 'gridtable' style = 'margin-top: 12px'><th>Mode</th><tr><td>".modal('wed')."</td></tr></table>";
           		echo "</td>";
           	
           		echo "<td valign = 'top'>";
           		echo "<table class = 'gridtable' style = 'margin-left: 12px'><th>Variance</th><tr><td>".varian()."</td></tr></table>";
           		echo "<table class = 'gridtable' style = 'margin-top: 19px; margin-left: 12px' ><th>SDevation</th><tr><td>".sd()."</td></tr></table>";
           	

           		echo "</td>";
           		echo "</tr>";
           		echo "</table>";
           		?>
        </div>
        
        <div id="box5" class="infobox"> 
       
           		<?php
           		echo "<table align = 'center'>";
           		echo "<tr>";
           		echo "<td>";
           		$total = cnt('name');
           		dis('thu');
           		echo "</td>";
           		echo "<td valign = 'baseline'>";
           		mean_dis('thu');
           		echo "<table class = 'gridtable' style = 'margin-top: 12px'><th>Median</th><tr><td>".med('thu')."</td></tr></table>";
           		echo "<table class = 'gridtable' style = 'margin-top: 12px'><th>Mode</th><tr><td>".modal('thu')."</td></tr></table>";
           		echo "</td>";


           		echo "<td valign = 'top'>";
           		echo "<table class = 'gridtable' style = 'margin-left: 12px'><th>Variance</th><tr><td>".varian()."</td></tr></table>";
           		echo "<table class = 'gridtable' style = 'margin-top: 19px; margin-left: 12px' ><th>SDevation</th><tr><td>".sd()."</td></tr></table>";
           	

           		echo "</tr>";
           		echo "</table>";
           		?>
        </div>
         
        <div id="box6" class="infobox"> 
             
           		<?php
           		echo "<table align = 'center'>";
           		echo "<tr>";
           		echo "<td>";
           		$total = cnt('name');
           		dis('fri');
           		echo "</td>";
           		echo "<td valign = 'baseline'>";
           		mean_dis('fri');
           		echo "<table class = 'gridtable' style = 'margin-top: 12px'><th>Median</th><tr><td>".med('fri')."</td></tr></table>";
           		echo "<table class = 'gridtable' style = 'margin-top: 12px'><th>Mode</th><tr><td>".modal('fri')."</td></tr></table>";
           		echo "</td>";


           		echo "<td valign = 'top'>";
           		echo "<table class = 'gridtable' style = 'margin-left: 12px'><th>Variance</th><tr><td>".varian()."</td></tr></table>";
           		echo "<table class = 'gridtable' style = 'margin-top: 19px; margin-left: 12px' ><th>SDevation</th><tr><td>".sd()."</td></tr></table>";
           	

           		echo "</tr>";
           		echo "</table>";
           		?>
        </div>
        
        <div id="box7" class="infobox"> 
    
           		<?php
           		echo "<table align = 'center'>";
           		echo "<tr>";
           		echo "<td>";
           		$total = cnt('name');
           		dis('sat');
           		echo "</td>";
           		echo "<td valign = 'baseline'>";
           		mean_dis('sat');
           		echo "<table class = 'gridtable' style = 'margin-top: 12px'><th>Median</th><tr><td>".med('sat')."</td></tr></table>";
           		echo "<table class = 'gridtable' style = 'margin-top: 12px'><th>Mode</th><tr><td>".modal('sat')."</td></tr></table>";
           		echo "</td>";


           		echo "<td valign = 'top'>";
           		echo "<table class = 'gridtable' style = 'margin-left: 12px'><th>Variance</th><tr><td>".varian()."</td></tr></table>";
           		echo "<table class = 'gridtable' style = 'margin-top: 19px; margin-left: 12px' ><th>SDevation</th><tr><td>".sd()."</td></tr></table>";
           	

           		echo "</tr>";
           		echo "</table>";
           		?>
        </div>
 
        <div id="box8" class="infobox"> 
       		<?php
           		echo "<table align = 'center'>";
           		echo "<tr>";
           		echo "<td>";
           		$total = cnt('name');
           		dis('allday');
           		echo "</td>";
           		echo "<td valign = 'baseline'>";
           		echo "<table class = 'gridtable'>";
           		echo "<th>Mean</th>";
           		echo "<tr><td>";
           		echo  averag();
           		echo "</tr></td>";
           		echo "<table class = 'gridtable' style = 'margin-top: 19px'><th>Median</th><tr><td>".med('sat')."</td></tr></table>";
           		echo "<table class = 'gridtable' style = 'margin-top: 12px'><th>Mode</th><tr><td>".modal('allday')."</td></tr></table>";
           		
           		echo "</td>";



           		echo "<td valign = 'top'>";
           		echo "<table class = 'gridtable' style = 'margin-left: 12px'><th>Variance</th><tr><td>".varian()."</td></tr></table>";
           		echo "<table class = 'gridtable' style = 'margin-top: 19px; margin-left: 12px' ><th>SDevation</th><tr><td>".sd()."</td></tr></table>";
           	
				echo "</table>";
                echo "</tr>";
           		echo "</table>";
           		?>
        </div>
    </div>

					<?php 
					$datatb = array();
					
					$count = "select count(name) from tbstats";
					$query_count =  mysql_query($count);
					$row = mysql_fetch_row($query_count);
					$total = $row[0]; // total number of students in the table

                    $a = array(array());
                    $farray = array(array());
					$rwek = 0;
					function dis($idd){
					//---------------------------------------
					
					$total = $GLOBALS['total'];
					global $farray;
					$farray[2]["g"] = "aaaaaaa";
					$freq;
					$cfreq;

					switch ($idd) {
						case 'allday':
							# code...
							$ht = 0; $ave =0;
							$weekly_each = array();
							$query = "Select * from tbstats";
							$result = mysql_query($query) or die(mysql_error());		
				
							while($row = mysql_fetch_array($result))
							{
							$wk = (($row['sun'] + $row['mon'] + $row['tue'] + $row['wed'] + $row['thu'] + $row['fri'] + $row['sat']));
							$ave += $wk;							
							$weekly_each[$ht] = $wk;
							$ht++;		
							}
							$upper = max($weekly_each);
							$lower = min($weekly_each);
							$ave = ($ave/($ht+1));
							$ttl = rangeweek($total,$upper,$lower);
							global $rwek;
							$rwek = rangeweek($total,$upper,$lower);
							$freq = 0;
							$cfreq = 0;
							$miiin = ($wk/7);
							break;
						default:
							# code...
							$ttl = ranges(select_min($idd),select_max($idd),$total);
							$freq = 0;
							$cfreq = 0;
							$miiin = avemean($idd);
							break;
					}


					echo "<table table class= 'gridtable' align ='center'>";
					echo "<tr>
									<th>Class</th>
									<th>Freq</th>
									<th>CFreq.</th>
									<th>UpperB</th>
									<th>LowerB</th>
									<th>Class Mark</th>
 							</tr>";
					for ($i=0; $i < (1 + 3.322 * log10($total)); $i++) { 
					
					switch ($idd) {
						case 'allday':
							$min =  ($i * $ttl);
							$max =	($min + ($ttl)) - 1; $lb = (max($min - 0.5,0)); $ub = ($max + 0.5);
							 
							$query = "Select * from tbstats";
							$result = mysql_query($query) or die(mysql_error());		
							$x = (($min+$max)/2);
							
							while($row = mysql_fetch_array($result))
								{
							
								$wk = (($row['sun'] + $row['mon'] + $row['tue'] + $row['wed'] + $row['thu'] + $row['fri'] + $row['sat']));
								/*
							$weekly_each('$ht') = $wk;
							$ht++;*/				
								if (($wk >= $min) && ($wk <= $max)) {
								# code...
								$freq = $freq + 1; $cfreq++;
								//echo "andito ako";
									}
								}

							break;
						default:
							$min =  ($i * $ttl);
							$max =	($min + ($ttl)) - 1; 
							$lb = (max($min - 0.5,0)); 
							$ub = ($max + 0.5);
							$x = (($min+$max)/2);
							 #code...
							//n = count
							//class width = range
							$q1 = "select ".$idd." from tbstats";


							if (mysql_query($q1)) {
							$res = mysql_query($q1);
							while ($tally = mysql_fetch_array($res)) {
							$fre = $tally[$idd];

							if (($fre >= $min) && ($fre <= $max)) {
								# code...
								$freq = $freq + 1; $cfreq++;
								//echo "andito ako";
									}
								}
							}
							else
							{
								mysql_error();
								}
							break;
							}

					
		
					echo "<tr>";
					echo "<td>" . $min." - ".$max . "</td>";
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


					$freq = 0;

					}
					echo "</table>";

				}//end of func
			


			?>

				</div>
			   </div>
		      </div>
	         </div>


</body>
</html>
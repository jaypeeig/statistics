<?php

Class Stats{

	public $server = 'localhost';
	public $user = 'root';
	public $password = '';
	public $dbase = 'dbstats';

	function connect(){
		$conn = mysql_connect($this->server, $this->user, $this->password) or die(mysql_error());
    	mysql_select_db($this->dbase, $conn);

	}

	function collectdata($id){
		$query = "select * from tbstats where id = " . $id;
		$run = mysql_query($query) or die(mysql_error());
		$container = array();
		while ($row = mysql_fetch_array($run)) {
			array_push($container, $row);
		}
		return $container;
	}

	function rangeweek($count,$u,$l){
		$trow =	round( ($u-$l) / (1 + 3.322 * log10($count)));
		return $trow;
	}

	function fillarray($tbname){
		$container = array();
		$query = "select * from " . $tbname;
		$run = mysql_query($query) or die(mysql_error());
		while ($row = mysql_fetch_array($run)) {
			array_push($container, $row);
		}
		return $container;
	}

	function avemean($day){
		$output =  "select avg(".$day.") from tbstats";
		$qr = mysql_query($output);
		$row = mysql_fetch_row($qr);
		$final = $row[0];
		return $final;
	}

	function mean($day){
	
		return round($this->avemean($day),2);
	
	}

	function median($day, $farray){
			if ($day == 'allday') {
				$day = 'sat';
			}
			$destined = 100;
			$totaled = $this->cntrow($day);
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
			$rng = $this->ranges($this->select_min($day),$this->select_max($day),$this->cntrow($day));
			$fm = $farray[$destined+1]["f"];
			$median = ($lb + (($div)-$preceed) * $rng / $fm);

			return round($median,2);
	}
	

	function cntrow($nm){
		$count = "select count(".$nm.") from tbstats";
		$query_count =  mysql_query($count);
		$row = mysql_fetch_row($query_count);
		$total = $row[0];
		return $total;
	}

	function filltb(){
		$qry = "select * from tbstats";
		$result = mysql_query($qry) or die(mysql_error());

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

	function ranges($min,$max,$count){
		$trow =	round( ($max - $min) / (1 + 3.322 * log10($count)));
		return $trow;
	}

	function modal($day,$farray){

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
				$rng = $this->ranges($this->select_min($day),$this->select_max($day),$this->cntrow($day));
				break;
		}

		$mol = $farray[$divt]["lb"]; $mof = $farray[$divt]["f"];
		$f_1 = $divt > 0 ? $farray[$divt - 1]["f"] : 0;
		$f_2 = $divt < count($farray) ? $farray[$divt + 1]["f"] : 0;
		$mode = ($mol + ($mof - $f_1) * $rng / (2 * $mof - $f_1 - $f_2));
		$mode = round($mode,2);
		return $mode;
	}


	function varian($farray){
			
		$final = 0;
		$cnn = ($this->cntrow('name')-1);
		$limit = count($farray);
		for ($i=0; $i < $limit ; $i++) { 
			$final += $farray[$i]["fxx"];
		}
		$final = ($final/$cnn);
		$final = round($final,2);
		return $final;
	}

	function sd($farray){
		$ret = sqrt($this->varian($farray));
		$ret = round($ret,2);
		return $ret;
	}


	function averag()
	{
		$query = "Select * from tbstats";
		$result = mysql_query($query) or die(mysql_error());		
		$ht = 0;$ave = 0;
		$weekly_each = array();
		while($row = mysql_fetch_array($result)){
			$wk = (($row['sun'] + $row['mon'] + $row['tue'] + $row['wed'] + $row['thu'] + $row['fri'] + $row['sat']));
			$ave = $ave + $wk;
			$weekly_each[$ht] = $wk;
			$ht++;			
		}
			$ave =  ($ave/($ht+1));
			$ave = round($ave, 2);
	    return $ave;
	}













}


?>
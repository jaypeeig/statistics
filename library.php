<?php

class Formulas 
{
	var $headers = Array('class', 'frequency', 'c_frequency', 'lower_bracket', 'upper_bracket', 'class_mark');

	public function calc_frames($genre = Array())
	{
		$opts = Array();

		$opts['min'] = min($genre);
		$opts['max'] = max($genre);
		$opts['count'] = sizeof($genre);
		$opts['interval'] = round( ($opts['max'] - $opts['min']) / 
			( 1 + 3.322 * log($opts['count']))
			 ) ?: 1;

		return $opts;
		
	}

	public function build_table($genre = Array())
	{

		$struct = $this->calc_frames($genre);

		$table = Array();
		array_push($table, $this->headers);

		$row = Array();
		$c_frequency = 0;

		for ($i=0; $i <= ($struct['max']); $i++) { 

			$min =  ($i * $struct['interval']);
			$max =	($min + ($struct['interval'])) - 1;

			$row[0] = ($struct['interval'] == '1') ? $max : $min . '-' . $max; //class			
			$frequency = 0;
			foreach ($genre as $val) {
				if (($val >= $min) && ($val <= $max)) {
					$frequency++;
					$c_frequency++;
				}
			}

			$row[1] = $frequency;
			$row[2]= $c_frequency;
			$row[3]= (max($min - 0.5,0));
			$row[4]= ($max + 0.5);
			$row[5]= ($min - $max / 2);

			array_push($row); 
			array_push($table, $row);
		}

		return $table;

	}

	public function tendency($genre = Array())
	{
		$data = Array();

		$data['mean'] = ((array_sum($genre))/(sizeof($genre)));
		
		sort($genre);
		if (sizeof($genre) & 1) //odd
		{
			$mid_key = round(sizeof($genre) / 2);
			$data['median'] = $genre[$mid_key - 1];
		}else{ 					//even
			$mid_key = sizeof($genre) / 2;
			$mid_key2 = $mid_key + 1;
			$data['median'] = (( $genre[$mid_key - 1] + $genre[$mid_key2 -1]) / 2); 
		}

		$duple = Array();
		foreach ($genre as $val) {
			if (! array_key_exists('class_' . $val, $duple)) {
				$duple['class_' . $val] = 1;
			}else{
				$duple['class_' . $val] += 1;
			}
		}

		//get the mode value(s)
		$max_val = max($duple);
		$maxes = Array();

		foreach($duple as $key => $g) {
			if($g == $max_val){
				array_push($maxes, $key);
			}
		}

		if (sizeof($maxes) > 1) {
			$data['mode'] = implode(', ', $maxes);
		}else{
			$data['mode'] = $maxes[0];
		}

		return $data;
	}

}

?>
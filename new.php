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
				<div id="container1">

					<p>Please fill-up the survey form:</p>
				<form method="post" action = "#">
				 <div id="wrapper">	
					   <p>First Name: </p>
					   <input type = 'text' required name = fname>
					   <p>Last Name: </p>
					   <input type="text" required name = lname>
				 </div>
					    <hr>
					<p color = 'gray' align = 'center'>Minute(s) spent using Facebook per Day</p>
			
				 <div id = "wrap2">
			 		<table>	
					<tr><td><p>Sunday:</p></td>
					<td><input type = 'number' required min = '0' max = '1380' name = 'sun' onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
					</tr>
					<tr><td><p>Monday:</p></td>
					<td><input type = 'number'  required min = '0' max = '1380' name = 'mon' onkeypress='return event.charCode >= 48 && event.charCode <= 57' ></td>
					</tr>
					<tr><td><p>Tuesday:</p></td>
					<td><input type = 'number'  required min = '0' max = '1380' name = 'tue' onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
					</tr>
					<tr><td><p>Wednesday:</p></td>
					<td><input type = 'number' required min = '0' max = '1380'  name = 'wed' onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
					</tr>
					<tr><td><p>Thursday:</p></td>
					<td><input type = 'number' required min = '0' max = '1380'  name = 'thu' onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
					</tr>
					<tr><td><p>Friday: </p></td>
					<td><input type = 'number'  required min = '0' max = '1380' name = 'fri' onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
					</tr>
					<tr><td><p>Saturday:</p></td>
					<td><input type = 'number'  required min = '0' max = '1380' name = 'sat' onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
					</tr>
					</table>
				 </div>
				 <div id = "button">
						<input type="submit"  name="sub" value="New Entry"/>
				 </div>
					<hr>
				</form>
			</div>
		</div>
	</div>
</div>
</body>



<?php

	mysql_connect("localhost","root","") or die(mysql_error());
	mysql_query('CREATE DATABASE IF NOT EXISTS DBStats');
	mysql_select_db('DBStats');


	mysql_query('CREATE TABLE if NOT EXISTS tbstats
	(
	id int AUTO_INCREMENT NOT NULL PRIMARY KEY,
	name varchar(32) not null,
	sun int,
	mon int,
	tue int,
	wed int,
	thu int,
	fri int,
	sat int
	)');


	$fname = "";
	$lname = ""; $name = "";
	$sun=0; $tue=0; $wed=0;$thu=0; $fri=0; $sat=0; $mon = 0;


	if (isset($_POST['sub'])) {
	# code...
	//$fname = "";$lname = "";$sun=0; $tue=0; $wed=0;$thu=0; $fri=0; $sat=0; $mon = 0;

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$sun=	$_POST['sun'];
	$mon=	$_POST['mon'];
	$tue=	$_POST['tue'];
	$wed=	$_POST['wed'];
	$thu=	$_POST['thu'];
	$fri=	$_POST['fri'];
	$sat=	$_POST['sat'];

   $name = $lname . ", " . $fname;
}

	if ($fname == "" || $lname == "" ) {
	# code...exit
	exit();
	}

//echo $fname . " " . $lname . " ". $mon . $sun.$tue.$wed.$thu.$fri.$sat;

mysql_query("START TRANSACTION");
$add = "insert into tbstats(name,sun,mon,tue,wed,thu,fri,sat) values('$name','$sun','$mon','$tue','$wed','$thu','$fri','$sat')";
if ($add){
	mysql_query($add);
	mysql_query("COMMIT");
	echo "<script>alert('Successfully Added Bitch!')</script>";
	echo "<script>window.open('index.php','_self')</script>";
	clear();

}
else{
	mysql_query("ROLLBACK");
}

function clear(){

}
$fname = "";
$lname = "";
$name = "";
$sun=0; 
$tue=0; 
$wed=0;
$thu=0; 
$fri=0;
$sat=0;
$mon = 0;
?>
</html>
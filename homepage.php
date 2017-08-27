<?php
	require "class.php";
	$db = new Stats;
	$db->connect();
	$data = array();
	$data = $db->fillarray("tbstats");
	global $farray;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Facebook Survey site</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<nav class="navbar navbar-default">
  <div class="container-fluid">
   
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="homepage.php">IT Facebook Statisics</a>
    </div>


    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="add.php">Add Entry<span class="sr-only">(current)</span></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Jaypee M. Igncaio</a></li>
      </ul>
    </div>
  </div>
</nav>

<body>
<div class="container">
	<div class="jumbotron colfb">
 
	  <h2>Survey for IT students in Facebook usage.</h2>
	<table class="table table-bordered table-hover">
	  <thead>
	    <tr class="success">
	      <th>Name</th>
	      <th>Sunday</th>
	      <th>Monday</th>
	      <th>Tuesday</th>
	      <th>Wednesday</th>
	      <th>Thursday</th>
	      <th>Friday</th>
	      <th>Saturday</th>
	    </tr>
	  </thead>
	  <tbody>

	  
		<?php

			foreach ($data as $row) {
				echo "<tr>";
				echo "<td><a href='modify.php?id=".$row['id'] ."' >".$row['name']."</a></td>";
				echo "<td>".$row['sun']."</td>";
				echo "<td>".$row['mon']."</td>";
				echo "<td>".$row['tue']."</td>";
				echo "<td>".$row['wed']."</td>";
				echo "<td>".$row['thu']."</td>";
				echo "<td>".$row['fri']."</td>";
				echo "<td>".$row['sat']."</td>";
				echo "</tr>";
			}

		?>
	  </tbody>
	</table> 
	
	<div class="well">

		<ul class="nav nav-tabs nav-justified">
		<li id="sun" role="presentation"><a>Sunday</a></li>
		<li id="mon" role="presentation"><a>Monday</a></li>
		<li id="tue" role="presentation"><a>Tuesday</a></li>
		<li id="wed" role="presentation"><a>Wednesday</a></li>
		<li id="thu" role="presentation"><a>Thursday</a></li>
		<li id="fri" role="presentation"><a>Friday</a></li>
		<li id="sat" role="presentation"><a>Saturday</a></li>
		<li id="tot" role="presentation"><a>Total</a></li>
		</ul>

		<br/>
	<div id="bodyof">
	
	</div> <!--body of -->


	</div>



	</div>
</div>


</body>
 <script src="js/jquery.js"></script>
 <script src="js/bootstrap.js"></script>
  <script src="js/controller.js"></script>
</html>




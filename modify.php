<?php
	if (isset($_REQUEST['id'])) {
		$id = $_REQUEST['id'];
	}
	else
	{
		die("no id");
	}

	if (isset($_REQUEST['sub'])){

	}
?>

<?php
	require "class.php";
	$db = new Stats;
	$db->connect();
	$data = $db->collectdata($id);
	//var_dump($data);
	foreach ($data as $row) {
		$name = $row["name"];
		$sun = $row["sun"];
		$mon = $row["mon"];
		$tue = $row["tue"];
		$wed = $row["wed"];
		$thu = $row["thu"];
		$fri = $row["fri"];
		$sat = $row["sat"];
	}


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
   <div class="jumbotron">
   		<form class="form-horizontal" method="post" action="update.php?id=<?php echo $id;?>">
		  <fieldset>
		    <legend>IT Student Data</legend>
		    <div class="form-group">
		      <label for="hr" class="col-lg-2 control-label">Name</label>
		      <div class="col-lg-10">
		        <input type="text" name="nme" value = "<?php if(isset($name)){ echo $name; } ?>" class="form-control" id="name" placeholder="Fullname">
		      </div>
		    </div>

		    <div class="form-group">
		      <label for="hr" class="col-lg-2 control-label">Sunday</label>
		      <div class="col-lg-10">
		        <input type="number" name="sun" value = "<?php if(isset($sun)){ echo $sun; } ?>" class="form-control" id="hr" placeholder="Hours">
		      </div>
		    </div>

		    <div class="form-group">
		      <label for="hr" class="col-lg-2 control-label">Monday</label>
		      <div class="col-lg-10">
		        <input type="number" name="mon"  value = "<?php if(isset($mon)){ echo $mon; } ?>" class="form-control" id="hr" placeholder="Hours">
		      </div>
		    </div>

		    <div class="form-group">
		      <label for="hr" class="col-lg-2 control-label">Tuesday</label>
		      <div class="col-lg-10">
		        <input type="number" name="tue" value = "<?php if(isset($tue)){ echo $tue; } ?>" class="form-control" id="hr" placeholder="Hours">
		      </div>
		    </div>

		    <div class="form-group">
		      <label for="hr" class="col-lg-2 control-label">Wednesday</label>
		      <div class="col-lg-10">
		        <input type="number" name="wed" value = "<?php if(isset($wed)){ echo $wed; } ?>" class="form-control" id="hr" placeholder="Hours">
		      </div>
		    </div>
		
			 <div class="form-group">
		      <label for="hr" class="col-lg-2 control-label">Thursday</label>
		      <div class="col-lg-10">
		        <input type="number" name="thu" value = "<?php if(isset($thu)){ echo $thu; } ?>" class="form-control" id="hr" placeholder="Hours">
		      </div>
		    </div>

		    <div class="form-group">
		      <label for="hr" class="col-lg-2 control-label">Friday</label>
		      <div class="col-lg-10">
		        <input type="number" name="fri" value = "<?php if(isset($fri)){ echo $fri; } ?>" class="form-control" id="hr" placeholder="Hours">
		      </div>
		    </div>


		    <div class="form-group">
		      <label for="hr" class="col-lg-2 control-label">Saturday</label>
		      <div class="col-lg-10">
		        <input type="number" name="sat" value = "<?php if(isset($sat)){ echo $sat; } ?>" class="form-control" id="hr" placeholder="Hours">
		      </div>
		    </div>

		    <div class="form-group">
		      <div class="col-lg-10 col-lg-offset-2">
		            <button type="submit" name="sub" class="btn btn-primary">Update Information</button>
		            <a href="delete.php?id=<?php echo $id ?>" class="btn btn-success">Delete Information</a>
		      </div>
		    </div>
		  </fieldset>
		</form>
   </div>
 </div>
</body>

 <script src="js/jquery.js"></script>
 <script src="js/bootstrap.js"></script>
</html>





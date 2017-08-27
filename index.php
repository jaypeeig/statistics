<!DOCTYPE html>
<html>
<head>
	<title>Statistics</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap.min.css">
</head>
<body>

	<?php require_once 'connection.php'; ?>
	<?php require_once 'library.php'; ?>

	<div class="container">
		<h3>Music Genre dataset</h3>
		
		<?php
			$kpop = new Formulas;
			$kpop_table = ($kpop->build_table($genres['kpop']));
			$kpop_tnc   = ($kpop->tendency($genres['kpop']));

			$rnb = new Formulas;
			$rnb_table = ($rnb->build_table($genres['rnb']));
			$rnb_tnc   = ($rnb->tendency($genres['rnb']));

			$opm = new Formulas;
			$opm_table = ($opm->build_table($genres['opm']));
			$opm_tnc   = ($opm->tendency($genres['opm']));

			$rock = new Formulas;
			$rock_table = ($rock->build_table($genres['rock']));
			$rock_tnc   = ($rock->tendency($genres['rock']));

			$lovesong = new Formulas;
			$lovesong_table = ($lovesong->build_table($genres['lovesong']));
			$lovesong_tnc   = ($lovesong->tendency($genres['lovesong']));
		?>

		<div class="jumbotron">
			<table class="table table-bordered">
				<tr>
					<?php if (sizeof($stored_header) > 0): ?>
						<?php foreach ($stored_header as $header): ?>
							<th>
								<?php echo ucwords(str_replace('_', ' ', $header));  ?>
							</th>
						<?php endforeach ?>
					<?php endif ?>
				</tr>

				<?php if ($stored_data && (sizeof($stored_data) > 0)): ?>
					<?php foreach ($stored_data as $data): ?>
						<tr>
							<?php if (is_array($data)): ?>
								<?php foreach ($data as $record): ?>
									<td>
										<?php echo $record; ?>
									</td>
								<?php endforeach ?>
							<?php endif ?>
						</tr>
					<?php endforeach ?>
				<?php endif ?>

			</table>
		</div>

		<div class="genre_tables">

		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs nav-justified" role="tablist">
		    <li role="presentation" class="active"><a href="#kpop" aria-controls="kpop" role="tab" data-toggle="tab">Kpop</a></li>
		    <li role="presentation"><a href="#opm" aria-controls="opm" role="tab" data-toggle="tab">Opm</a></li>
		    <li role="presentation"><a href="#rnb" aria-controls="rnb" role="tab" data-toggle="tab">Rnb</a></li>
		    <li role="presentation"><a href="#rock" aria-controls="rock" role="tab" data-toggle="tab">Rock</a></li>
		    <li role="presentation"><a href="#lovesong" aria-controls="lovesong" role="tab" data-toggle="tab">Lovesong</a></li>
		  </ul>

		  <!-- Tab panes -->
		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="kpop">
		    	<div class="container-fluid">
		    	<div id="kpop_table">
				<h4 class="header">Kpop</h4>
				
				<div class="row">
					<div class="col-sm-9">
						<table class="table table-bordered">
							<?php foreach ($kpop_table as $row): ?>
								<tr>
									<?php foreach ($row as $col): ?>
										<td>
											<?php echo $col; ?>
										</td>
									<?php endforeach ?>
								</tr>
							<?php endforeach ?>
						</table>
					</div>
					<div class="col-sm-3">
						<ul class="list-group">
						  <li class="list-group-item">
						    <span class="badge"><?php echo ($kpop_tnc['mean']); ?></span>
						    Mean
						  </li>
						  <li class="list-group-item">
						    <span class="badge"><?php echo $kpop_tnc['median']; ?></span>
						    Median
						  </li>
						  <li class="list-group-item">
						    <span class="badge"><?php echo str_replace('class_', '', $kpop_tnc['mode']); ?></span>
						    Mode
						  </li>
						</ul>
					</div>
				</div>

				</div>
		    	</div>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="opm">
		    	<div class="container-fluid">
		    	<div id="opm_table">
				<h4 class="header">Opm</h4>
				
				<div class="row">
					<div class="col-sm-9">
						<table class="table table-bordered">
							<?php foreach ($opm_table as $row): ?>
								<tr>
									<?php foreach ($row as $col): ?>
										<td>
											<?php echo $col; ?>
										</td>
									<?php endforeach ?>
								</tr>
							<?php endforeach ?>
						</table>
					</div>
					<div class="col-sm-3">
						<ul class="list-group">
						  <li class="list-group-item">
						    <span class="badge"><?php echo ($opm_tnc['mean']); ?></span>
						    Mean
						  </li>
						  <li class="list-group-item">
						    <span class="badge"><?php echo $opm_tnc['median']; ?></span>
						    Median
						  </li>
						  <li class="list-group-item">
						    <span class="badge"><?php echo str_replace('class_', '', $opm_tnc['mode']); ?></span>
						    Mode
						  </li>
						</ul>
					</div>
				</div>

				</div>
		    	</div>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="rnb">
		    	
		    	<div class="container-fluid">
		    	<div id="rnb_table">
				<h4 class="header">Rnb</h4>
				
				<div class="row">
					<div class="col-sm-9">
						<table class="table table-bordered">
							<?php foreach ($rnb_table as $row): ?>
								<tr>
									<?php foreach ($row as $col): ?>
										<td>
											<?php echo $col; ?>
										</td>
									<?php endforeach ?>
								</tr>
							<?php endforeach ?>
						</table>
					</div>
					<div class="col-sm-3">
						<ul class="list-group">
						  <li class="list-group-item">
						    <span class="badge"><?php echo ($rnb_tnc['mean']); ?></span>
						    Mean
						  </li>
						  <li class="list-group-item">
						    <span class="badge"><?php echo $rnb_tnc['median']; ?></span>
						    Median
						  </li>
						  <li class="list-group-item">
						    <span class="badge"><?php echo str_replace('class_', '', $rnb_tnc['mode']); ?></span>
						    Mode
						  </li>
						</ul>
					</div>
				</div>

				</div>
		    	</div>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="rock">
		    	<div class="container-fluid">
		    	<div id="rock_table">
				<h4 class="header">Rock</h4>
				
				<div class="row">
					<div class="col-sm-9">
						<table class="table table-bordered">
							<?php foreach ($rock_table as $row): ?>
								<tr>
									<?php foreach ($row as $col): ?>
										<td>
											<?php echo $col; ?>
										</td>
									<?php endforeach ?>
								</tr>
							<?php endforeach ?>
						</table>
					</div>
					<div class="col-sm-3">
						<ul class="list-group">
						  <li class="list-group-item">
						    <span class="badge"><?php echo ($rock_tnc['mean']); ?></span>
						    Mean
						  </li>
						  <li class="list-group-item">
						    <span class="badge"><?php echo $rock_tnc['median']; ?></span>
						    Median
						  </li>
						  <li class="list-group-item">
						    <span class="badge"><?php echo str_replace('class_', '', $rock_tnc['mode']); ?></span>
						    Mode
						  </li>
						</ul>
					</div>
				</div>

				</div>
		    	</div>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="lovesong">
		    	<div class="container-fluid">
		    	<div id="lovesong_table">
				<h4 class="header">Lovesong</h4>
				
				<div class="row">
					<div class="col-sm-9">
						<table class="table table-bordered">
							<?php foreach ($lovesong_table as $row): ?>
								<tr>
									<?php foreach ($row as $col): ?>
										<td>
											<?php echo $col; ?>
										</td>
									<?php endforeach ?>
								</tr>
							<?php endforeach ?>
						</table>
					</div>
					<div class="col-sm-3">
						<ul class="list-group">
						  <li class="list-group-item">
						    <span class="badge"><?php echo ($lovesong_tnc['mean']); ?></span>
						    Mean
						  </li>
						  <li class="list-group-item">
						    <span class="badge"><?php echo $lovesong_tnc['median']; ?></span>
						    Median
						  </li>
						  <li class="list-group-item">
						    <span class="badge"><?php echo str_replace('class_', '', $lovesong_tnc['mode']); ?></span>
						    Mode
						  </li>
						</ul>
					</div>
				</div>

				</div>
		    	</div>
		    </div>
		  </div>

		</div>

	</div>

	<footer>
		<hr>
	</footer>

</body>
	<script src="assets/jquery.js"></script>
	<script src="assets/bootstrap.min.js"></script>
</html>
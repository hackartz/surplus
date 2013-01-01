<!-- 
	============================================
	DECISION SUPPORT SYSTEM FOR WATER SURPLUS
	============================================

	Developer : Tan Andre Kurniawan
	build : beta
	website : earth.hol.es | github.com/hackartz

	============================================
 -->

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Surplus Dashboard</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Le styles -->
		<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/bootstrap-modal.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/jquery-ui.custom.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css" rel="stylesheet">
		<style type="text/css">
		body {
				background: hsl(65, 7%, 47%);
			}
		</style>
	</head>

	<body>
	<div class="wrapper"> <!-- start wrapper -->
		<div class="navbar navbar-inverse navbar-fixed-top"> <!-- start main navigatian -->
			 <div class="navbar-inner"> <!-- start inner -->
				<div class="container-fluid"> <!-- start fluid -->
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <!-- start mobile navigation -->
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a> <!-- end mobile navigation -->
					<a href="#" class="brand">Surplus DSS</a> <!-- brand -->
					<div class="nav-collapse collapse"> <!-- start collapse -->
						<ul class="nav"> <!-- start nav -->
							<li class="active"> <!-- nav manage client -->
								<a href="<?php echo base_url(); ?>dashboard" id="togmgclient">
									<i class="icon-plus-sign icon-white"></i>
									Manage Client
								</a>
							</li> <!-- end manage client -->

							<li class="active"> <!-- start manage kalkulasi -->
								<a href="<?php echo base_url(); ?>dashboard/kalkulasi/" id="togkalkulasi">
									<i class="icon-tasks icon-white"></i>
									Surplus Calculation
								</a>
							</li> <!-- end manage kalkulasi -->

							<li class="dropdown active"> <!-- start dropdown change password -->
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
									<i class="icon-user icon-white"></i>
									Change Password
									<b class="caret"></b>
								</a>
								<div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
									<form action="#" method="post" accept-charset="UTF-8">
										<label for="oldpassword">Old Password</label>
										<input type="password" placeholder="old password" id="oldpassword" name="oldpassword" style="margin-bottom: 10px;" required>
										<label for="oldpassword">New Password</label>
										<input type="password" placeholder="New password" id="newpassword" name="newpassword" style="margin-bottom: 10px;" required>
										<label for="repassword">Re-type Password</label>
										<input type="password" placeholder="new password" id="repassword" name="repassword" style="margin-bottom: 10px;" required>
										<input class="btn btn-primary btn-block" type="submit" id="Save" value="Save">
									</form>
								</div>
							</li> <!-- end dropdown change password -->

						</ul> <!-- end nav -->

						<ul class="nav pull-right"> <!-- start right nav -->
							<li class="active">
								<a href="<?php echo base_url(); ?>dashboard/logout">
									<i class="icon-off icon-white"></i>
									logout
								</a>
							</li>
						</ul> <!-- end right nav -->

					</div> <!-- end collapse -->
				</div> <!-- end fluid -->
			</div> <!-- end inner -->
		</div> <!-- end main navigation -->  
		<div class="pushkalkulasi"></div>
		<div class="ikalkulasi">
			<div class="row-fluid">
				<form action="<?php echo base_url(); ?>dashboard/kalkulasi/1" class="form-inline" method="post">
					<label for="jmlsurplus">Jumlah Surplus</label>
					<div class="input-append">
						<input class="span9" id="appendedInput" type="text" name="jmlSp" required="" pattern="\d+">
						<span class="add-on" style="color: #000;">m<sup>3</sup></span>
					</div>
					<label for="">Bobot <i class="icon-arrow-right icon-white"></i> </label>
					<label for="okp "> | Okupansi</label>
					<input type="text" name="okp" class="input-mini" pattern="\d+" required="">
					<label for="keba "> | Kebutuhan Air</label>
					<input type="text" name="keba" class="input-mini" pattern="\d+" required="">
					<label for="jenis"> | Jenis</label>
					<input type="text" name="jenis" class="input-mini" pattern="\d+" required="">
					<input type="submit" class="btn btn-success" value="kalkulasi">
				</form>
			</div>
		</div>

    <div class="kalkulasi-content"> <!-- start main content -->
      
        <div class="fordatagrid"> <!-- start span11 -->
        	<?php 
        		if(!empty($l_jenis) && !empty($jml_jenis) && !empty($pv_jenis)) {	?>
	        <table class="table table-stripped table-bordered table-condensed dtgrid">
	        	<thead>
	        		<th>Jenis</th>
	        		<?php 
	        			foreach ($l_jenis as $key => $value) { ?>
	        			<th><?php echo $key; ?></th>
					<?php	        				
	        			}
	        		 ?>
	        		<th>Priority Vector</th>
	        	</thead>
	        	<tbody>
	        		<?php 
	        			foreach ($l_jenis as $key1 => $value1) { 
	        				echo "<tr>"; ?>
	        				<?php
									echo "<td style='font-weight:bold;'>".$key1."</td>";
	        				foreach ($l_jenis as $key2 => $value2) { ?>
	        				<td><!-- <?php echo $key2."/".$key1; ?> -->
								<?php echo number_format(($value2/$value1),2); ?>
							</td>
							<?php }
								echo "<td>".number_format($pv_jenis[$key1],4)."</td></tr>";
								$total = $total + $pv_jenis[$key1];
							}
 							?>
 							<tr class="success">
							<td style='font-weight:bold;'>Jumlah</td>
						<?php 
						foreach ($jml_jenis as $key => $value) {
							echo "<td>".number_format($value,2)."</td>";
						}

						echo "<td>".number_format($total,2)."</td>";
						?>
							</tr>
	        	</tbody>
	        </table>
	        <a href="<?php echo base_url(); ?>dashboard/kalkulasi/5" class="btn btn-inverse" style="float:right;">next</a>
	        <p style="clear:both;" ></p>
						<?php
					} else { echo "<span style='color:white'>insert needed value to start calculating...</span>"; }
						?>	
        </div><!-- end span11 -->

    </div> <!-- end main content -->

	</div> <!-- end wrapper -->
		<!-- Modal -->
		<div id="moddelete" class="modal hide fade">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">Delete Confirmation</h3>
			</div>
			<div class="modal-body">
				Yakin akan dihapus ?
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
				<a class="btn btn-danger" id="mod_del_client" href="<?php echo base_url(); ?>dashboard/del_client/">Delete</a>
			</div>
		</div>

		<script type="text/javascript">
			$(function() {
				// Setup drop down menu
				$('.dropdown-toggle').dropdown();
			 
				// Fix input element click problem
				$('.dropdown input, .dropdown label').click(function(e) {
					e.stopPropagation();
				});
			});
		</script>

		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>js/jquery-ui.custom.min.js"></script>
		<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
		
	</body>
</html>

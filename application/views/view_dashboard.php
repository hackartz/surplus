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
								<a href="#" id="togmgclient">
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

    <div class="main-content" id="maincontent"> <!-- start main content -->
      <div class="container"> <!-- start container -->
        <div class="span11 fordatagrid"> <!-- start span11 -->
          <div class="justadd" style="margin-bottom: 5px;">
            <a href="<?php echo base_url(); ?>dashboard/add" class="btn btn-small btn-success"><i class="icon-plus-sign icon-white"></i> Add</a>  
          </div>
          <table class="table table-bordered table-condensed table-hover dtgrid"> <!-- start table -->
            <thead>
              <tr>
                <th width="25px">No</th>
                <th width="150px">Nama</th>
                <th width="200px">Alamat</th>
                <th width="150px">Kecamatan</th>
                <th width="130px">Jenis</th>
                <th width="100px">Keb. Air (m<sup>3</sup>)</th>
                <th width="100px">Okupansi (%)</th>
                <th style="text-align: center;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (!empty($client_list)) {
                $i = 1;
                foreach ($client_list->result() as $row) :
              ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row->nama_konsumen; ?></td>
                <td><?php echo $row->alamat; ?></td>
                <td><?php echo $row->nama_kecamatan; ?></td>
                <td><?php echo $row->nama_jenis; ?></td>
                <td><?php echo $row->kebutuhan_air; ?></td>
                <td><?php echo $row->okupansi; ?></td>
                <td>
                  <a class="btn btn-mini btn-primary" href="<?php echo base_url(); ?>dashboard/edit_client/<?php echo $row->kode_konsumen; ?>">
                    <i class="icon-edit icon-white"></i> edit
                  </a>
                  <a class="btn btn-mini btn-danger" id="del_client" data-toggle="modal" data-target="#moddelete" href="#" name="<?php echo $row->kode_konsumen; ?>">
                    <i class="icon-remove icon-white"></i> delete
                  </a>
                </td>
              </tr>
              <?php 
                $i++;
                endforeach;
              }
              ?>
            </tbody>
          </table> <!-- end table -->
          <div class="pagination pagination-small"> <!-- start paging -->
            <?php
              echo $this->pagination->create_links();
            ?>
          </div> <!-- end paging -->
        </div> <!-- end span11 -->
      </div> <!-- end container -->
    </div> <!-- end main content -->
  <div class="push"></div>
	</div> <!-- end wrapper -->

  <footer class="bawah">
    <div class="container">
      <p>
        &copy; copyright 2012 | surplus dashboard
      </p>
    </div>
  </footer>


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

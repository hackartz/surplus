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
    <style type="text/css">
      body {
        padding-bottom: 40px;
      }
    </style>
    <link href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css" rel="stylesheet">
  </head>

  <body>
    <div class="nav-wrapper">
      <div class="navbar navbar-inverse navbar-fixed-top"> <!-- start navigatian -->
      <div class="navbar-inner"> <!-- start inner -->
        <div class="container-fluid"> <!-- start fluid -->
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <!-- start mobile navigation -->
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a> <!-- end mobile navigation -->
          <a href="#" class="brand">Surplus DSS</a>
          <div class="nav-collapse collapse"> <!-- start collapse -->
            <ul class="nav"> <!-- start nav -->

              <li class="active"> 
                <a href="<?php echo base_url(); ?>dashboard">
                  <i class="icon-plus-sign icon-white"></i>
                  Manage Client
                </a>
              </li>

              <li class="active">
                <a href="<?php echo base_url(); ?>dashboard">
                  <i class="icon-tasks icon-white"></i>
                  Surplus Calculation
                </a>
              </li>

              <li class="dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <!-- start dropdown change password -->
                  <i class="icon-user icon-white"></i>
                  Change Password
                  <b class="caret"></b>
                </a> <!-- end dropdown change password -->
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
              </li>

            </ul>

            <ul class="nav pull-right">
              <li class="active">
                <a href="<?php echo base_url(); ?>dashboard/logout">
                  <i class="icon-off icon-white"></i>
                  logout
                </a>
              </li>
            </ul>

          </div> <!-- end collapse -->
        </div> <!-- end fluid -->
      </div> <!-- end inner -->
    </div> <!-- end navigation -->  
    </div>
    

    <div class="main-content">
      <div class="container">
        <div class="span6 addclient">
          <form class="form-horizontal" action='<?php echo base_url(); ?>dashboard/save_client' method="POST">
            <fieldset>
              <div id="legend">
                <legend class="">Add New Client</legend>
              </div>
              <!-- nama konsumen -->
              <div class="control-group">
                <label class="control-label" for="nama">Nama</label>
                <div class="controls">
                  <input type="text" id="nama" name="nama" placeholder="nama" class="input-xlarge" required="">
                </div>
              </div>
              <!-- alamat -->
              <div class="control-group">
                <label class="control-label" for="alamat">Alamat</label>
                <div class="controls">
                  <input type="text" id="alamat" name="alamat" placeholder="JL. KaliGawe No. 5" class="input-xlarge" required="">
                </div>
              </div>
              <!-- kecamatan -->
              <div class="control-group">
                <label class="control-label" for="kecamatan">Kecamatan</label>
                <div class="controls">
                  <select name="kecamatan" id="kecamatan">
                    <?php 
                      if (!empty($kec_list)) {
                        foreach ($kec_list->result() as $row) : ?>
                    <option value="<?php echo $row->kode_kecamatan; ?>"><?php echo $row->nama_kecamatan; ?></option>
                    <?php endforeach; } ?>
                  </select>
                </div>
              </div>
              <!-- jenis -->
              <div class="control-group">
                <label class="control-label" for="jenis">jenis</label>
                <div class="controls">
                  <select name="jenis" id="jenis">
                    <?php 
                      if (!empty($jenis_list)) {
                        foreach ($jenis_list->result() as $row) : ?>
                    <option value="<?php echo $row->kode_jenis; ?>"><?php echo $row->nama_jenis; ?></option>
                    <?php endforeach; } ?>
                  </select>
                </div>
              </div>
              <!-- Kebutuhan Air -->
              <div class="control-group">
                <label class="control-label" for="n">Kebutuhan Air</label>
                <div class="controls">
                  <div class="input-append">
                    <input class="span1" type="text" id="kebair" name="kebair" placeholder="100" required=""><span class="add-on">m<sup>3</sup></span>
                  </div>
                </div>
              </div>
              <!-- Okupansi -->
              <div class="control-group">
                <label class="control-label" for="okupansi">Okupansi</label>
                <div class="controls">
                  <div class="input-append">
                    <input class="span1" type="text" id="okupansi" name="okupansi" placeholder="10" required=""><span class="add-on">%</span>
                  </div>
                </div>
              </div>
              <div class="control-group">
                <div class="controls">
                  <input type="submit" class="btn btn-success" value="Save">
                </div>
              </div>
            </fieldset>
          </form>
        </div>
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

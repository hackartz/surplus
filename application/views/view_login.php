<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/site/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/site/reset.css">

</head>
<body>

	<div class="top">
		<div class="pucukatas"></div>
	</div>
	<div class="container"> <!-- start container -->
		<div class="header"> <!-- start header -->
		
			<div class="kiri"> <!-- start kiri -->
				<h1 class="logo"></h1>
			</div><!-- end kiri -->

			<div class="kanan"> <!-- start kanan -->
				LOGIN TO SYSTEM
				<hr noshade="" color="#fff">
				<form action="<?php echo base_url(); ?>site/login" method="post"> <!-- start form login -->
	        		<p>
	          			<label for="username">Username</label>
	          			<input type="text" placeholder="username" required="" name="username">  
	        		</p>
					<p>
	          			<label for="Password">Password</label>
	          			<input type="password" placeholder="password" required="" name="password">
	        		</p>
	        		<input type="submit" value="Login" class="submit button">
				</form> <!-- end form login -->
			</div> <!-- end start kanan -->
		</div> <!-- end header -->
		<div class="pucukbawah"></div>
	</div> <!-- end container -->
	
	<div class="contain">
		<div class="tengah"></div>
	</div>
	
	<div class="bottomwrapper">
		<div class="info col1">
			<p><h1></h1>KELOMPOK</p>
			<div class="garis"></div>
			<ul>
				<li>
					<h2 class="nim">A12.2009.03400</h2>
					<h2>Tan Andre Kurniawan</h2>
				</li>
				<li>
					<h2 class="nim">A12.2009.03401</h2>
					<h2>Julian Adhika Widodo</h2>
				</li>
				<li>
					<h2 class="nim">A12.2009.03413</h2>
					<h2>Ekhsandra Yusuf Lasamanov</h2>
				</li>
				<li>
					<h2 class="nim">A12.2009.03423</h2>
					<h2>Fandi Rahmad Darmawan</h2>
				</li>
				<li>
					<h2 class="nim">A12.2009.03782</h2>
					<h2>Aji Sulistyono</h2>
				</li> 
			</ul>
		</div>

		<div class="info col2">
			Dibuat menggunakan
			<div class="garis"></div>
			<div class="sponsor">
				<h1 class="sponsorci">
					<a href="">codeigniter</a>
				</h1>
				open-source Fully Baked PHP Framework
				<br>
				find at <a class="weblink" href="https://github.com/EllisLab/CodeIgniter/">Codeigniter github</a>
				<h1 class="sponsorcompass">
					<a href="">compass</a>
				</h1>
				open-source CSS Authoring Framework
				<br>
				find at <a class="weblink" href="http://github.com/chriseppstein/compass">Compass-style github</a>
			</div>
		</div>
	</div>
</body>
</html>
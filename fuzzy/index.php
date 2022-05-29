<!DOCTYPE html>
<html>
  <head>
    <title>STATUS PRODUKTIVITAS AYAM PETELUR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
  </head>
  <body class="login-bg">
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-12">
	              <div class="logo">
	                 <h1 align="center"><a href="index.php">SPK Status Produktivitas Ayam Petelur dengan Fuzzy Mamdani</a></h1>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>
	<?php
    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == "gagal") {
        }else if($_GET['pesan'] == "logout"){
        }else if ($_GET['pesan'] == "belum_login") {
        }
    }
    ?>
	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box">
			            <div class="content-wrap">
			                <h6>Login Page</h6>
			                <form method="post" action="src/proses_login.php">
		                        <div class="form-group">
		                            <input type="text" id="username" name="username" for="username" class="form-control" placeholder="Username">
		                        </div>
		                        <div class="form-group">
		                            <input type="password" id="password" name="password" for="password" class="form-control" placeholder="Password">
		                        </div>
		                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
		                    </form>               
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>
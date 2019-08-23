<html>
<head>
<title>
Login
</title>
<link rel="stylesheet" href="templates/default/bootstrap/css/bootstrap.min.css" crossorigin="anonymous">
<script src="templates/default/js/jquery.js"></script>
<script src="templates/default/bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
	<div class="container">
		<div class="row" style="margin-top:40px;">
			<div class="col-lg-4">
				 
			</div>
			<div class="col-lg-4">
			
			</div>
			<div class="col-lg-4">
				 
			</div>
		</div>
	
		<div class="row">
			<div class="col-lg-4">
				 
			</div>
			<div class="col-lg-4">
				<form method="post" action="<?php echo site_url('verifylogin');?>">
					
				<div class="panel panel-default">
				  <div class="panel-heading">Login</div>
				  <div class="panel-body">
				  <?php 
				  if(isset($_SESSION['error_msg'])){
					echo "<div class='alert alert-danger'>".$_SESSION['error_msg']."</div>";
				  }
					?>
				  <div class="form-group">
					<input type="text" name="username"  class="form-control" placeholder="Username"  required >
				  </div>
				  <div class="form-group">
					<input type="password" name="password" class="form-control" placeholder="Password" required >
				  </div>
				  <div class="form-group">
					<input type="submit" class="btn btn-success" value="Login">
				  </div>

				  </div>
				</div>
				</form>
				
			</div>
			<div class="col-lg-4">
				 
			</div>
		</div>
	 
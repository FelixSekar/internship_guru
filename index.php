<?php
	session_start();
	if(isset($_SESSION['std_id'])){
		header('Location:std_dash.php');
	}
	elseif(isset($_SESSION['emp_id'])) {
		header('Location:emp_dash.php');
	}
	else{
?>		
<html>
	<head>
		<title>Internshala</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

		<!-- jquery -->
		<script src="jquery.js"></script>
		
		<!-- bootstrap css and js -->
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />		
		<script src="bootstrap/js/bootstrap.min.js"></script>

		<!-- for pwd cnf -->
		<script>

			$(document).ready(function(){
				//std cnf pwd
	 			$('#std_reg_pwd, #std_cnf_pwd').on('keyup', function () {
				  if ($('#std_reg_pwd').val() == $('#std_cnf_pwd').val()) {
				    $('#std_cnf_msg').html('Matching').css('color', 'green');
				  } else 
				    $('#std_cnf_msg').html('Not Matching').css('color', 'red');
				});

	 			//emp cnf pwd
				$('#emp_reg_pwd, #emp_cnf_pwd').on('keyup', function () {
				  if ($('#emp_reg_pwd').val() == $('#emp_cnf_pwd').val()) {
				    $('#emp_cnf_msg').html('Matching').css('color', 'green');
				  } else 
				    $('#emp_cnf_msg').html('Not Matching').css('color', 'red');
				});
			});
						
		</script>

	</head>
	<body>
		<!-- Navigation -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		  <a class="navbar-brand" href="#">Internshala	</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="navbar-nav ml-auto">
		    	<li class="nav-item">
		     		<a class="nav-link" href="search.php">Internships</a>
		      </li>		      
		      <li class="nav-item">
		      	<a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Login</a>
		      </li>
		      <li class="nav-item">
		      	<a class="nav-link" href="#" data-toggle="modal" data-target="#registerModal">Register</a>
		      </li>		      
		    </ul>
		  </div>
		</nav>

		<!-- Login Modal -->
		<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Modal title</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<div class="container">
						  <ul class="nav nav-tabs">
						    <li class="nav-item active"><a class="nav-link active" data-toggle="tab" href="#std_lgo_tab">Student</a></li>
						    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#emp_log_tab">Employer</a></li>
						  </ul>
						  <div class="tab-content">
						    <div id="std_log_tab" class="tab-pane fade show active">
						    	<!-- student login form -->
						      <form method="POST" action="std_login_val.php">
						      	<div class="form-group row">
						      		<label for="std_log_email" class="col-form-label">Email: </label>
						      		<input id="std_log_email" name="std_email" type="email" class="form-control"> 
						      	</div>
						      	<div class="form-group row">
						      		<label for="std_log_pwd" class="col-form-label">Password: </label>
						      		<input id="std_log_pwd" name="std_pwd" type="password" class="form-control">
						      	</div>
						      	<div class="form-group row">
						      		<input type="submit" class="btn btn-primary" value="Login">
						      	</div>
						      </form>
						      <!-- form ends -->
						    </div>
						    <div id="emp_log_tab" class="tab-pane fade">
						    	<!-- employer login form -->
						      <form method="POST" action="emp_login_val.php">
						      	<div class="form-group row">
						      		<label for="emp_log_email" class="col-form-label">Email: </label>
						      		<input id="emp_log_email" name="emp_email" type="email" class="form-control"> 
						      	</div>
						      	<div class="form-group row">
						      		<label for="emp_log_pwd" class="col-form-label">Password: </label>
						      		<input id="emp_log_pwd" name="emp_pwd" type="password" class="form-control">
						      	</div>
						      	<div class="form-group row">
						      		<input type="submit" class="btn btn-primary" value="Login">
						      	</div>
						      </form>
						      <!-- form ends -->
						    </div>
						  </div>
						</div>
		      </div>
		    </div>
		  </div>
		</div>

		<!-- Register Modal -->
		<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Modal title</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<div class="container">
						  <ul class="nav nav-tabs">
						    <li class="nav-item active"><a class="nav-link active" data-toggle="tab" href="#std_reg_tab">Student</a></li>
						    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#emp_reg_tab">Employer</a></li>
						  </ul>
						  <div class="tab-content">
						    <div id="std_reg_tab" class="tab-pane fade show active">
						    	<!-- student registration form -->
						      <form method="POST" action="std_register.php">
						      	<div class="form-group row">
						      		<label for="std_reg_name" class="col-form-label">Full Name: </label>
						      		<input id="std_reg_name" name="std_name" type="text" class="form-control"> 
						      	</div>
						      	<div class="form-group row">
						      		<label for="std_reg_email" class="col-form-label">Email: </label>
						      		<input id="std_reg_email" name="std_email" type="email" class="form-control"> 
						      	</div>
						      	<div class="form-group row">
						      		<label for="std_reg_pwd" class="col-form-label">Password: </label>
						      		<input id="std_reg_pwd" name="std_pwd" type="password" class="form-control">
						      	</div>
						      	<div class="form-group row">
						      		<label for="std_cnf_pwd" class="col-form-label">Confirm Password: </label>
						      		<input id="std_cnf_pwd" type="password" class="form-control">
						      		<span id="std_cnf_msg"></span>
						      	</div>
						      	<div class="form-group row">
						      		<input type="submit" class="btn btn-primary" value="Register">
						      	</div>
						      </form>
						      <!-- form ends -->
						    </div>
						    <div id="emp_reg_tab" class="tab-pane fade">
						    	<!-- employer registration form -->
						      <form method="POST" action="emp_register.php">
						      	<div class="form-group row">
						      		<label for="emp_reg_cmpName" class="col-form-label">Company Name: </label>
						      		<input id="emp_reg_cmpName" name="emp_cmpName" type="text" class="form-control"> 
						      	</div>
						      	<div class="form-group row">
						      		<label for="emp_reg_email" class="col-form-label">Email: </label>
						      		<input id="emp_reg_email" name="emp_email" type="email" class="form-control"> 
						      	</div>
						      	<div class="form-group row">
						      		<label for="emp_reg_pwd" class="col-form-label">Password: </label>
						      		<input id="emp_reg_pwd" name="emp_pwd" type="password" class="form-control">
						      	</div>
						      	<div class="form-group row">
						      		<label for="emp_cnf_pwd" class="col-form-label">Confirm Password: </label>
						      		<input id="emp_cnf_pwd" type="password" class="form-control">
						      		<span id="emp_cnf_msg"></span>
						      	</div>
						      	<div class="form-group row">
						      		<input type="submit" class="btn btn-primary" value="Register">
						      	</div>
						      </form>
						      <!-- form ends -->
						    </div>
						  </div>
						</div>
		      </div>
		    </div>
		  </div>
		</div>

		<img src="home_bg.jpg" width="100%" height="100%">

		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js " integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q " crossorigin="anonymous "></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

	</body>
</html>
<?php
	}
?>
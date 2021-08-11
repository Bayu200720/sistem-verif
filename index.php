<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login SIV</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="uploads/users/kominfo.jpg"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="libs/Login_v1/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="libs/Login_v1/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="libs/Login_v1/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="libs/Login_v1/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="libs/Login_v1/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="libs/Login_v1/css/util.css">
	<link rel="stylesheet" type="text/css" href="libs/Login_v1/css/main.css">
<!--===============================================================================================-->
</head>

<body>
<?php
  ob_start();
  require_once('includes/load.php');
  //$user=find_all('users'); var_dump($user);
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="libs/Login_v1/images/kominfo.png" alt="IMG">
					<?php echo display_msg($msg); ?>
				</div>

				<form method="post" action="auth.php" class="login100-form validate-form">
					<span class="login100-form-title">
						Member Login 
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid Username is required: ex@abc.xyz">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					

					<div class="text-center p-t-136">
						
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!--===============================================================================================-->
	<script src="libs/Login_v1/vendor/bootstrap/js/popper.js"></script>
	<script src="libs/Login_v1/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="libs/Login_v1/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="libs/Login_v1/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
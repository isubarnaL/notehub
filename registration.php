
<?php include 'template/header-login.php'; ?>
<body>
	
	<div class="limiter">
		<div class="container-login100"><center><a href="javascript:history.back()"><i class="fa fa-backward" aria-hidden="true"></i>Go Back</a></center>
	
			<div class="wrap-login100">
			
				<div class="login100-pic js-tilt" data-tilt>
				
					<img src="assets/img/3.png" alt="IMG">
				</div>
					<form action="manage-insert.php" method="POST" enctype="multipart/form-data">
					
					<span class="login100-form-title">
						Register Yourself						
					</span>
					<!-- manage-insert.php -->
					<div class="wrap-input100" >
                        <input class="input100" type="text" name="name" placeholder="First Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
						</div>
						
					<div class="wrap-input100">
						<input class="input100" type="email" name="email" placeholder="Email" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100">
						<input class="input100" type="password" name="password" placeholder="Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="regascus">
							Register
						</button>
					</div>
					

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Password?
						</a>
					</div>

					<div class="text-center p-t-36">
						<a class="txt2" href="login.php">
							Already have a account?<br>Log in
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
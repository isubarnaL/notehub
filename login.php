<?php
include 'security.php';
include 'template/header-login.php'; ?>
<body>

	<div class="limiter">

		<div class="container-login100">
		 <center><a href="javascript:window.close();"><i class="fa fa-backward" aria-hidden="true"></i>Go Back</a></center>
			<div class="wrap-login100">
				<?php
  if (isset($_POST['login'])) {
    csrf_check();

    $email    = $_POST['email'];
    $password = $_POST['password'];

    include 'dbCon.php';
    $con = connect();

    // Fetch user by email only, then verify password in PHP
    $stmt = $con->prepare("SELECT * FROM user_info WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
    ?>
   <div class="alert alert-danger alert-dismissible" role="alert">
  <strong>&emsp;Sorry!</strong> The given email does not exist.&emsp;
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <?php
    } else {
      $r = $result->fetch_assoc();
      if (!password_verify($password, $r['password'])) {
    ?>
   <div class="alert alert-warning alert-dismissible" role="alert">
  <strong>&emsp;Sorry!</strong> You have entered the wrong password.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <?php
      } else {
        $_SESSION['isLoggedIn'] = TRUE;
        $_SESSION['id']    = $r['id'];
        $_SESSION['name']  = $r['user_name'];
        $_SESSION['email'] = $r['email'];
        $_SESSION['role']  = $r['role'];

        if ($_SESSION['role'] == 1) {
          echo '<script>window.location="dashboard/index.php"</script>';
        } else {
          echo '<script>window.location="index.php"</script>';
        }
      }
    }
    $stmt->close();
  }
?>
				<div class="login100-pic js-tilt" data-tilt>
					<img src="assets/img/3.png" alt="IMG">
				</div>

	<form action="" method="POST" enctype="multipart/form-data" >
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					<span class="login100-form-title">
						Member Login
					</span>

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
						<button class="login100-form-btn" type="submit" name="login">
							Login
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
						<a class="txt2" href="registration.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
					<br><br><br>
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

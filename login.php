<?php
include 'security.php';

$login_error = '';

if (isset($_POST['login'])) {
    csrf_check();

    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';

    if (!check_rate_limit($ip)) {
        $login_error = 'Too many failed login attempts. Please try again in 15 minutes.';
    } else {
        $email    = $_POST['email'];
        $password = $_POST['password'];

        include 'dbCon.php';
        $con = connect();

        $stmt = $con->prepare("SELECT * FROM user_info WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows <= 0) {
            record_failed_attempt($ip);
            $login_error = 'Invalid email or password.';
        } else {
            $r = $result->fetch_assoc();
            if (!password_verify($password, $r['password'])) {
                record_failed_attempt($ip);
                $login_error = 'Invalid email or password.';
            } else {
                clear_rate_limit($ip);
                session_regenerate_id(true);
                $_SESSION['isLoggedIn'] = TRUE;
                $_SESSION['id']    = $r['id'];
                $_SESSION['name']  = $r['user_name'];
                $_SESSION['email'] = $r['email'];
                $_SESSION['role']  = $r['role'];

                if ($_SESSION['role'] == 1) {
                    header('Location: dashboard/index.php');
                } else {
                    header('Location: index.php');
                }
                exit;
            }
        }
        $stmt->close();
    }
}
?>
<?php include 'template/header-login.php'; ?>
<body>

	<div class="limiter">

		<div class="container-login100">
		 <center><a href="javascript:window.close();"><i class="fa fa-backward" aria-hidden="true"></i>Go Back</a></center>
			<?php if ($login_error !== ''): ?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <strong>&emsp;Sorry!</strong> <?php echo htmlspecialchars($login_error); ?>&emsp;
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<?php endif; ?>
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="assets/img/3.png" alt="IMG">
				</div>

	<form action="" method="POST">
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

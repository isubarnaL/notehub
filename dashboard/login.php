<?php
include '../security.php';

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
                    header('Location: index.php');
                } else {
                    header('Location: ../index.php');
                }
                exit;
            }
        }
        $stmt->close();
    }
}
?>
<!doctype html>
<html class="fixed">
	<head>
		<!-- Basic -->
		<meta charset="UTF-8">
		<meta name="description" content="notehub admin panel login">
		<link rel="icon" type="image/png" href="../assets/img/favicon.png"/>
		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="" class="logo pull-left">
					<img src="assets/images/logo.png" height="54" alt="Admin" />
				</a>
				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
					</div>
					<div class="panel-body">
						<?php if ($login_error !== ''): ?>
						<div class="alert alert-danger">
							<?php echo htmlspecialchars($login_error); ?>
						</div>
						<?php endif; ?>
						<form action="" method="POST">
						<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
							<div class="form-group mb-lg">
								<label>Email</label>
								<div class="input-group input-group-icon">
									<input name="email" type="email" class="form-control input-lg" required="" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">Password</label>
								</div>
								<div class="input-group input-group-icon">
									<input name="password" type="password" class="form-control input-lg" required="" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-8"></div>
								<div class="col-sm-4 text-right">
									<input type="submit" class="btn btn-primary btn-block" name="login" value="Sign In">
								</div>
							</div>

							<span class="mt-lg mb-lg line-thru text-center text-uppercase">
								<span>or</span>
							</span>

							<div class="mb-xs text-center">
								<a class="btn btn-success mb-md ml-xs mr-xs" href="../registration.php">Create a New Account</a>
							</div>

						</form>
					</div>
				</div>

			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>

		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>

		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

	</body>
</html>

<!--- subscribe --->
        <!-- Signup-->
        <section class="signup-section" id="signup">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-lg-8 mx-auto text-center" >

                        <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
						<?php
		if (isset($_POST['subscribe'])){
            csrf_check();
            $email = trim($_POST['subsemail']);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo '<div class="alert alert-danger">Invalid email address.</div>';
            } else {
                include_once dirname(__DIR__) . '/dbCon.php';
                $con = connect();

                $check = $con->prepare("SELECT subscriber_email FROM subscriber_info WHERE subscriber_email = ?");
                $check->bind_param('s', $email);
                $check->execute();
                $check->store_result();

                if ($check->num_rows > 0) {
		?>
		<br><div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>wow! Thanks again.</strong> But you have already subscribed to us.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <?php
                } else {
                    $check->close();
                    $ins = $con->prepare("INSERT INTO `subscriber_info`(`subscriber_email`) VALUES (?)");
                    $ins->bind_param('s', $email);
                    if ($ins->execute()) {
                        echo '<script>window.location="subscribed.php"</script>';
                    } else {
                        error_log('Subscribe DB error: ' . $con->error);
                        echo '<div class="alert alert-danger">Something went wrong. Please try again.</div>';
                    }
                    $ins->close();
                }
            }
        }
		?>
                        <h2 class="text-white mb-5">Subscribe to get notes when uploaded!</h2>
                        <form class="form-inline d-flex" action="#signup" method="POST">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" name="subsemail" type="email" placeholder="Enter email address..." required>
                            <button class="btn btn-primary mx-auto " type="submit" name="subscribe">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

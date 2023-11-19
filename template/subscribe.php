<!--- subscribe --->
        <!-- Signup-->
        <section class="signup-section" id="signup">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-lg-8 mx-auto text-center" >
					
                        <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
						<?php
		if (isset($_POST['subscribe'])){
        $email = $_POST['subsemail'];

        $con = connect();
  
        $checkSQL = "SELECT * FROM subscriber_info WHERE subscriber_email = '$email';";
        $checkresult = $con->query($checkSQL);
        if ($checkresult->num_rows > 0) {
			?>
			<br><div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>wow!Thanks again.</strong>but you have already subscribed to us.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <?php
				}else{
			

					$iquery="INSERT INTO `subscriber_info`(`subscriber_email`) 
			        		VALUES ('$email');";
		        	if ($con->query($iquery) === TRUE) {
		        		
		        		echo '<script>window.location="subscribed.php"</script>';
		        	}else {
		                echo "Error: " . $iquery . "<br>" . $con->error;
		            }
				}
        }
		?>
                        <h2 class="text-white mb-5">Subscribe to get notes when uploaded!</h2>
                        <form class="form-inline d-flex" action="#signup" method="POST" enctype="multipart/form-data" >
                            <input class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" name="subsemail" type="email" placeholder="Enter email address..." required>
                            <button class="btn btn-primary mx-auto " type="submit" name="subscribe">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
		
<!-- approve-reject.php -->
<?php 
	session_start();
   include_once 'dbCon.php';
   $con = connect();  
	//reject 
	if (isset($_GET['reject_id'])) {
		$id =$_GET['note_id'];
		$sql ="UPDATE note_list SET approved_status = 2 WHERE note_id = '$id';";
		// include_once 'dbCon.php';
		// $con = connect();
		if ($con->query($sql) === TRUE) {
		echo '<script>alert("Rejected.")</script>';
		echo '<script>window.location="note-list.php"</script>';
	    } else {
			echo "Error: " . $sql . "<br>" . $con->error;
		} 
	}

	// approve note request
	if (isset($_GET['approve_id'])) {
		$id =$_GET['note_id'];
		// include_once 'dbCon.php';
		// $con = connect();
		$sql2 ="UPDATE note_list SET approved_status = 1 WHERE note_id = '$id';";
		if ($con->query($sql2) === TRUE) {
            echo '<script>alert("Approved.")</script>';
            echo '<script>window.location="note-list.php"</script>';
            } else {
                echo "Error: " . $sql2 . "<br>" . $con->error;
            }
        } 
		/* $sql2 ="SELECT `id`, `c_id`, (SELECT `restaurent_name` FROM `restaurant_info` WHERE restaurant_info.id= booking_details.c_id) as username,(SELECT `email` FROM `restaurant_info` WHERE restaurant_info.id= booking_details.c_id) as email FROM booking_details WHERE id = '$id';";
		$result= $con->query($sql2);
		foreach ($result as $r ) {
			$cname = $r['username'];
			// $email = $r['email'];

			$email = "chartermonitoring2018@gmail.com";
		}
		if ($con->query($sql) === TRUE) {
			include 'mailSender.php'; 
			$mail->Body = '<html><body>
	                Hello '.$cname.' . <br>
					Your booking is confirmed by restaurent. <br>
					Thank You.
	                </body></html>'; 
	            $mail->addAddress($email, "Booking Approve");
	            if($mail->send()) {
	            	echo  '<script>alert("Booking Confirmed.")</script>';
	                echo '<script>window.location="booking-list.php"</script>';
	            }else{
	                echo  '<script>alert("mail not send")</script>';
	                 echo '<script>window.location="booking-list.php"</script>';
	            } 
		
	    } else {
			echo "Error: " . $sql . "<br>" . $con->error;
		} 
	}
 

?>
*/
 
 
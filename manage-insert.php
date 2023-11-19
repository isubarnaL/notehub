<!-- manage-insert.php -->
<?php 
session_start();
include_once 'dbCon.php';
$con = connect();
	if (isset($_POST['regascus'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = 2;

        // existing email chaeck
        $checkSQL = "SELECT * FROM `user_info` WHERE email = '$email';";
        $checkresult = $con->query($checkSQL);
        if ($checkresult->num_rows > 0) {
        	echo '<script>alert("This Email Already Exist.")</script>';
        	echo '<script>window.location="login.php"</script>';
				}else{
			

					$iquery="INSERT INTO `user_info`(`user_name`, `email`, `password`, `role`) 
			        		VALUES ('$name','$email', '$password','$role');";
		        	if ($con->query($iquery) === TRUE) {
		        		echo 'You are registered.';
						sleep(2);
		        		echo '<script>window.location="login.php"</script>';
		        	}else {
		                echo "Error: " . $iquery . "<br>" . $con->error;
		            }
				}
        }
		

?>
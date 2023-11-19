<!-- manage-insert.php -->
<?php 
session_start();
include_once 'dbCon.php';
$con = connect();

 	if (isset($_POST['regasres'])){
        $uni_id = $_POST['uni_name'];
		$college_id = $_POST['college_name'];
		$depart_id = $_POST['depart_name'];
		$subject_id = $_POST['subject_name'];
		$semester = $_POST['semester'];
		$notemaker_id = $_POST['notemaker_name'];
		$approved_status=$_SESSION['role'];


	        	if (isset($_FILES['pdf'])) {
			
				    // files handle
				    $targetDirectory = 'note-pdf';
				    // get the file name
				    $file_name ='NoteH-'.$depart_id.$uni_id.$subject_id.$notemaker_id.$_FILES['pdf']['name'];
				    // get the mime type
				    $file_mime_type = $_FILES['pdf']['type'];
				    // get the file size
				    $file_size = $_FILES['pdf']['size'];
				    // get the file in temporary
				    $file_tmp = $_FILES['pdf']['tmp_name'];
				    // get the file extension, pathinfo($variable_name,FLAG)
				    $extension = pathinfo($file_name,PATHINFO_EXTENSION);

				    if ($extension =="pdf"){
				    	move_uploaded_file($file_tmp,"$targetDirectory/$file_name");
				    	$iquery="INSERT INTO `note_list`(`uni_id` ,`college_id` ,`depart_id` ,`semester` ,`subject_id` ,`notemaker_id` ,`approved_status` ,`note`) 
			        		VALUES ('$uni_id','$college_id','$depart_id','$semester','$subject_id','$notemaker_id','$approved_status','$file_name');";
			        	if ($con->query($iquery) === TRUE) {
			        			echo '<script>alert("Note added successfully")</script>';
			        				echo '<script>window.location="index.php"</script>';

			        		// $id = $con->insert_id;
			        	
			        	}else {
			                echo "Error: " . $iquery . "<br>" . $con->error;
			            }
				    	
				    }
					else{
				    	echo '<script>alert("Required pdf in Field.")</script>';
		        		echo '<script>window.location="reg.php"</script>';
				    }
					 
				}
				else{
		                echo "Error: " . $iquery . "<br>" . $con->error;
		            }
				}
				


/*
    
    if (isset($_POST['book'])) {

    	$bdinsert = false;
    	$u_id = $_SESSION['id'];
    	$res_id = $_POST['res_id'];
  		$reservation_name = $_POST['reservation_name'];
		$reservation_phone = $_POST['reservation_phone'];
		$reservation_date = $_POST['reservation_date'];
		$reservation_time = $_POST['reservation_time'];
		$total_price = $_POST['total_price'];
		$transactionid = $_POST['transaction_id'];

		date_default_timezone_set("Asia/Dhaka");
         $make_time =date("h:i:sa");
         $make_date =date("Y-m-d");
		$booking_id= uniqid();

		$iquery="INSERT INTO `booking_details`(`booking_id`,`res_id`,`c_id`,`make_date`, `make_time`, `name`, `phone`, `booking_date`, `booking_time`, `bill`,`transactionid`) 
		    VALUES ('$booking_id','$res_id','$u_id','$make_date','$make_time','$reservation_name','$reservation_phone','$reservation_date','$reservation_time','$total_price','$transactionid');";
		if ($con->query($iquery) === TRUE) {
			$bdinsert = true;
		}else {
            echo "Error: " . $iquery . "<br>" . $con->error;
        }

        $cinsert = false;
        if ($bdinsert == true) {
        	for($q = 0; $q < count($_POST["chair"]); $q++){
                $c_id = $_POST['chair'][$q]; 
                $chair_no = ""; 
                $sql5 = "SELECT * FROM `restaurant_chair` WHERE id = '$c_id';";
                $result5 = $con->query($sql5);
                foreach ($result5 as $r5) {
                	$chair_no = $r5['chair_no'];
                }
                $ciQuery = "INSERT INTO `booking_chair`(`booking_id`, `chair_id`, `chair_no`) 
                		VALUES ('$booking_id','$c_id','$chair_no');";
                if ($con->query($ciQuery) === TRUE) {
					$cinsert = true;
				}else {
		            echo "Error: " . $ciQuery . "<br>" . $con->error;
		        }
            }
        }

        $iinsert = false;
        if ($cinsert == true) {
        	for($i = 0; $i < count($_POST["item"]); $i++){
                $i_id = $_POST['item'][$i];
                $qty = $_POST['qty'][$i];
                $itmQuery = "INSERT INTO `booking_menus`(`booking_id`, `item_id`, `qty`) 
                		VALUES ('$booking_id','$i_id','$qty');";
                if ($con->query($itmQuery) === TRUE) {
					$iinsert = true;
				}else {
		            echo "Error: " . $itmQuery . "<br>" . $con->error;
		        }
            }
        }

       if ($bdinsert == true && $cinsert == true && $iinsert == true) {
    		echo '<script>alert("Your booking is done. You will get an email soon.")</script>';
    		echo '<script>window.location="index.php"</script>';
    	}else {
    		echo "Error: " . $iquery . "<br>" . $con->error;
    		echo "Error: " . $ciQuery . "<br>" . $con->error;
            echo "Error: " . $iquery . "<br>" . $con->error;
        } 
    }	
*/	
?>
<!-- manage-insert.php -->
<?php
session_start();
include_once 'dbCon.php';
$con = connect();
    
    //add table
    if (isset($_POST['adduni'])){
        $uniname = $_POST['uniname'];
   //     $uni_id = $_SESSION['id'];

    	$iquery="INSERT INTO `uni_tables`(`uni_name`) 
            VALUES ('$uniname');";
    	if ($con->query($iquery) === TRUE) {
    		echo '<script>alert("New university added successfully")</script>';
    		echo '<script>window.location="university-add.php"</script>';
    	}else {
            echo "Error: " . $iquery . "<br>" . $con->error;
        }
    }
//add notemaker
    if (isset($_POST['addnotemaker'])){
        $notemakername = $_POST['notemakername'];
   //     $uni_id = $_SESSION['id'];

    	$iquery="INSERT INTO `notemaker_tables`(`notemaker_name`) 
            VALUES ('$notemakername');";
    	if ($con->query($iquery) === TRUE) {
    		echo '<script>alert("New notemaker added successfully")</script>';
    		echo '<script>window.location="notemaker-add.php"</script>';
    	}else {
            echo "Error: " . $iquery . "<br>" . $con->error;
        }
    }


/*
    if (isset($_POST['addItem'])){
        $itemname = $_POST['itemname'];
        $price = $_POST['price'];
        $madeby = $_POST['madeby'];
        $food_type = $_POST['food_type'];

        $res_id = $_SESSION['id'];
        

        //$ecnpassword= md5($password);

        $checkSQL = "SELECT * FROM `menu_item` WHERE res_id = '$res_id' and item_name = '$itemname' and price = '$price';";
        $checkresult = $con->query($checkSQL);
        if ($checkresult->num_rows > 0) {
            echo '<script>alert("Item With This information Is Already Exit.")</script>';
            echo '<script>window.location="menu-add.php"</script>';
        }else{

                if (isset($_FILES['image'])) {
                 // files handle
                    $targetDirectory = "item-image/";
                    // get the file name
                    $file_name = $_FILES['image']['name'];
                    // get the mime type
                    $file_mime_type = $_FILES['image']['type'];
                    // get the file size
                    $file_size = $_FILES['image']['size'];
                    // get the file in temporary
                    $file_tmp = $_FILES['image']['tmp_name'];
                    // get the file extension, pathinfo($variable_name,FLAG)
                    $extension = pathinfo($file_name,PATHINFO_EXTENSION);

                    if ($extension =="jpg" || $extension =="png" || $extension =="jpeg"){
                        move_uploaded_file($file_tmp,$targetDirectory.$file_name);
                        $iquery="INSERT INTO `menu_item`( `res_id`, `item_name`, `madeby`, `food_type`, `price`, `image`) 
                            VALUES ('$res_id','$itemname','$madeby','$food_type','$price','$file_name');";
                        if ($con->query($iquery) === TRUE) {
                            echo '<script>alert("Item added successfully")</script>';
                            echo '<script>window.location="menu-add.php"</script>';
                        }else {
                            echo "Error: " . $iquery . "<br>" . $con->error;
                        }
                        
                    }else{
                        echo '<script>alert("Required JPG,PNG,GIF in Logo Field.")</script>';
                        echo '<script>window.location="menu-add.php"</script>';
                    }
                }
        }
    }
	*/
?>
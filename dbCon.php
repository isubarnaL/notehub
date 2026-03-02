<!-- dbCon.php -->
<?php 
function connect($flag=TRUE){
	$servername = "sql203.infinityfree.com";
	$username = "if0_35454552";
	$password = "rB0vh9y99RI";
	$dbName = "if0_35454552_notehub";

	// Create connection
	if($flag){
		$conn = new mysqli($servername, $username, $password,$dbName);
	}else{
		$conn = new mysqli($servername, $username, $password);
	}
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: $conn->connect_error");
	} 
	//echo "Connected successfully";
	
	return $conn;
}

?>
<!-- delete-chair.php -->
<?php
	if (isset($_GET['college_id'])) {
		$id =$_GET['college_id'];
		$uni_id = $_GET['uni_id'];
		$sql ="DELETE FROM `college_names` WHERE college_id = '$id';";
		include_once 'dbCon.php';
		$con = connect();
		if ($con->query($sql) === TRUE) {
		echo '<script>alert("DELETED.")</script>'; ?>
		<script type="text/javascript">
			var dist = <?php echo $uni_id; ?>;
		</script>
<?php		
		echo '<script>window.location.href ="view-college-list.php?uni_id=" + dist;</script>';
		//header("Location: view-chair-list.php?table_id=".$tbl_id."");
	    } else {
			echo "Error: " . $sql . "<br>" . $con->error;
		} 
	}
?>
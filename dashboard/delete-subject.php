<!-- delete-subject.php -->
<?php
	if (isset($_GET['subject_id'])) {
		$id =$_GET['subject_id'];
		$depart_id =$_GET['depart_id'];
		$semester =$_GET['semester'];
		$uni_id = $_GET['uni_id'];
		$sql ="DELETE FROM `subject_names` WHERE subject_id = '$id' AND semester = '$semester' AND depart_id = '$depart_id';";
		include_once 'dbCon.php';
		$con = connect();
		if ($con->query($sql) === TRUE) {
		echo '<script>alert("DELETED.")</script>'; ?>
		<script type="text/javascript">
			var dist = <?php echo $uni_id; ?>;
		</script>
<?php		
		echo '<script>window.location.href ="view-subject-list.php?uni_id=" + dist;</script>';
		//header("Location: view-chair-list.php?table_id=".$tbl_id."");
	    } else {
			echo "Error: " . $sql . "<br>" . $con->error;
		} 
	}
?>
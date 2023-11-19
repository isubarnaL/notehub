<!-- delete-university.php -->
<?php
	if (isset($_GET['notemaker_id'])) {
		$notemaker_id = $_GET['notemaker_id'];
		$sql ="DELETE FROM `notemaker_tables` WHERE notemaker_id = '$notemaker_id';";
		include_once 'dbCon.php';
		$con = connect();
		if ($con->query($sql) === TRUE) {
		echo '<script>alert("DELETED.")</script>'; ?>
		<script type="text/javascript">
			var dist = <?php echo $notemaker_id; ?>;
		</script>
<?php		
		echo '<script>window.location.href ="notemaker-list.php?notemaker_id=" + dist;</script>';
		//header("Location: view-chair-list.php?table_id=".$tbl_id."");
	    } else {
			echo "Error: " . $sql . "<br>" . $con->error;
		} 
	}
?>
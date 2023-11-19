<!-- delete-university.php -->
<?php
	if (isset($_GET['note_id'])) {
		$note_id = $_GET['note_id'];
		$sql ="DELETE FROM `note_list` WHERE note_id = '$note_id';";
		include_once 'dbCon.php';
		$con = connect();
		if ($con->query($sql) === TRUE) {
		echo '<script>alert("DELETED.")</script>'; ?>
		<script type="text/javascript">
			var dist = <?php echo $note_id; ?>;
		</script>
<?php		
		echo '<script>window.location.href ="note-list.php?note_id=" + dist;</script>';
		//header("Location: view-chair-list.php?table_id=".$tbl_id."");
	    } else {
			echo "Error: " . $sql . "<br>" . $con->error;
		} 
	}
?>
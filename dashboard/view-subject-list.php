<!-- view-chair-list.php -->
<?php include 'template/header.php'; 
if (!isset($_SESSION['isLoggedIn'])) {
	echo '<script>window.location="login.php"</script>';
}

?>
	<body>
		<section class="body">

			<!-- start: header -->
			<?php include 'template/top-bar.php'; ?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include 'template/left-bar.php'; ?>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Table</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Colleges</span></li>
								<li><span>Subject List</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
						
						
						<section class="panel">
							<center><a href="#exampleModal" class="btn btn-success "  data-toggle="modal" >Add subject</a></center>
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>
								<h2 class="panel-title">All Subjects</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
										<th>No.</th>
										<th>Uni ID</th>
										<th>Depart ID</th>
										<th>Semester</th>
										<th>Subject ID</th>
										<th>Subject Name</th>
										<th class="hidden-phone">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$count = 1;
										include 'dbCon.php';
										$con = connect();
										$uni_id = $_GET['uni_id'];
										$sql = "SELECT * FROM `subject_names` WHERE uni_id = '$uni_id' ;";
										$result = $con->query($sql);
										foreach ($result as $r) {
										?>
										<tr class="gradeX">
											<td class="center hidden-phone"><?php echo $count; ?></td>
											<td><?php echo $r['uni_id']; ?></td>
											<td><?php echo $r['depart_id']; ?></td>
											<td><?php echo $r['semester']; ?></td>
											<td><?php echo $r['subject_id']; ?></td>
											<td><?php echo $r['subject_name']; ?></td>
											<td class="center hidden-phone">
												<a href="delete-subject.php?subject_id=<?php echo $r['subject_id'];?>&semester=<?php echo $r['semester'];?>&depart_id=<?php echo $r['depart_id'];?>&uni_id=<?php echo $r['uni_id'];?>" class="btn btn-danger"  onclick="if (!Done()) return false; ">Delete Subjects</a>
											</td>
										</tr>
										<?php $count++; } ?>
									</tbody>
								</table>
							</div>
						</section>
						
						
					<!-- end: page -->
				</section>
			</div>

			<?php include 'template/right-bar.php'; ?>
		</section>
		<script type="text/javascript">
	       function Done(){
	         return confirm("Are you sure?");
	       }
   		</script>
		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="assets/javascripts/tables/examples.datatables.default.js"></script>
		<script src="assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
		<script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script>

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form action="" method="POST">
		      <div class="modal-body">
		        <div class="form-group">
		        	<label>Name of Subject</label>
		        	<input type="text" name="name_of_subject" required="" class="form-control">
		    	</div>
				<div class="form-group">
		        	<select class="form-control " name="depart_name" required="">
                            <option value=""> -Select Department- </option>
                            <?php       
                              $con = connect();
                              $sql = "SELECT * FROM `depart_tables` ORDER BY id ASC;";							  
                              $result = $con->query($sql);
                              foreach ($result as $r) {
                            ?>
                              <option value="<?php echo $r['depart_id']; ?>"><?php echo $r['depart_name']; ?></option>
                            <?php } ?>
                         </select>
		    	</div>
				<div class="form-group">
		        	<select class="form-control " name="semester" required="">
                            <option value=""> -Select Semester- </option>
                            <?php 
                              
                              $con = connect();
                              $sql = "SELECT * FROM `semester`;";							  
                              $result = $con->query($sql);
                              foreach ($result as $r) {
                            ?>
                              <option value="<?php echo $r['semester']; ?>"><?php echo $r['sem_name']; ?></option>
                            <?php } ?>
                         </select>
		    	</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <input type="submit" name="addsubject" class="btn btn-primary" value="Add Subject">
		      </div>
		  	  </form>
		    </div>
		  </div>
		</div>
	</body>
</html>
<?php 
	if (isset($_POST['addsubject'])) {
		$name_of_subject = $_POST['name_of_subject'];
		$uni_id = $_GET['uni_id'];
		$depart_id = $_POST['depart_name'];
		$semester = $_POST['semester'];
		$indert = false;
		
			
			$iquery="INSERT INTO `subject_names`( `uni_id`,`depart_id`,`semester`, `subject_name`) 
            VALUES ('$uni_id','$depart_id','$semester','$name_of_subject');";
	        if ($con->query($iquery) === TRUE) {
	        	$insert = true;
	        }else {
	            echo "Error: " . $iquery . "<br>" . $con->error;
	        }
		if ($insert == true) {
			echo '<script>alert("subjects added successfully")</script>'; ?>
			<script type="text/javascript">
				var dist = <?php echo $uni_id; ?>;
			</script>
		<?php		
			echo '<script>window.location.href ="view-subject-list.php?uni_id=" + dist;</script>';
		}
	}
?>
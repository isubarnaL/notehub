<!-- view-subject-list.php -->
<?php
include '../security.php';
include 'template/header.php';
if (!isset($_SESSION['isLoggedIn'])) {
	echo '<script>window.location="login.php"</script>';
}
$tok = csrf_token();

include 'dbCon.php';
$con = connect();
$uni_id = (int) $_GET['uni_id'];

// Handle Add Subject (POST)
if (isset($_POST['addsubject'])) {
	csrf_check();
	$name_of_subject = trim($_POST['name_of_subject']);
	$depart_id       = $_POST['depart_name'];
	$semester        = $_POST['semester'];

	$stmt = $con->prepare("INSERT INTO `subject_names`(`uni_id`, `depart_id`, `semester`, `subject_name`) VALUES (?, ?, ?, ?)");
	$stmt->bind_param('isss', $uni_id, $depart_id, $semester, $name_of_subject);
	if ($stmt->execute()) {
		echo '<script>alert("Subject added successfully")</script>';
		echo '<script>window.location.href="view-subject-list.php?uni_id=' . $uni_id . '"</script>';
	} else {
		echo "Error: " . $con->error;
	}
	$stmt->close();
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
										$stmt = $con->prepare("SELECT * FROM `subject_names` WHERE uni_id = ?");
										$stmt->bind_param('i', $uni_id);
										$stmt->execute();
										$result = $stmt->get_result();
										$stmt->close();
										foreach ($result as $r) {
										?>
										<tr class="gradeX">
											<td class="center hidden-phone"><?php echo $count; ?></td>
											<td><?php echo htmlspecialchars($r['uni_id']); ?></td>
											<td><?php echo htmlspecialchars($r['depart_id']); ?></td>
											<td><?php echo htmlspecialchars($r['semester']); ?></td>
											<td><?php echo htmlspecialchars($r['subject_id']); ?></td>
											<td><?php echo htmlspecialchars($r['subject_name']); ?></td>
											<td class="center hidden-phone">
												<a href="delete-subject.php?subject_id=<?php echo (int)$r['subject_id']; ?>&semester=<?php echo (int)$r['semester']; ?>&depart_id=<?php echo (int)$r['depart_id']; ?>&uni_id=<?php echo $uni_id; ?>&_token=<?php echo $tok; ?>" class="btn btn-danger" onclick="if (!Done()) return false; ">Delete Subjects</a>
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
		      <input type="hidden" name="_token" value="<?php echo $tok; ?>">
		      <div class="modal-body">
		        <div class="form-group">
		        	<label>Name of Subject</label>
		        	<input type="text" name="name_of_subject" required="" class="form-control">
		    	</div>
				<div class="form-group">
		        	<select class="form-control " name="depart_name" required="">
                            <option value=""> -Select Department- </option>
                            <?php
                              $con2 = connect();
                              $sql = "SELECT * FROM `depart_tables` ORDER BY id ASC;";
                              $result2 = $con2->query($sql);
                              foreach ($result2 as $r) {
                            ?>
                              <option value="<?php echo htmlspecialchars($r['depart_id']); ?>"><?php echo htmlspecialchars($r['depart_name']); ?></option>
                            <?php } ?>
                         </select>
		    	</div>
				<div class="form-group">
		        	<select class="form-control " name="semester" required="">
                            <option value=""> -Select Semester- </option>
                            <?php
                              $con3 = connect();
                              $sql = "SELECT * FROM `semester`;";
                              $result3 = $con3->query($sql);
                              foreach ($result3 as $r) {
                            ?>
                              <option value="<?php echo htmlspecialchars($r['semester']); ?>"><?php echo htmlspecialchars($r['sem_name']); ?></option>
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

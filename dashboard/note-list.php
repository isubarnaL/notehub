<!-- table-list.php -->
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
								<li><span>Tables</span></li>
								<li><span>Notes</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
						
						
						<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>
						
								<h2 class="panel-title">All Notes</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
											<th>No</th>
											<th>University</th>
											<th>Department</th>
											<th>College</th>
											<th>Semester</th>
											<th>Subject</th>
											<th>Notemaker</th>
											<th>Approved Status</th>
											<th>note</th>
											<th class="hidden-phone">View</th>
											<th class="hidden-phone">Delete</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$count = 1;
										include 'dbCon.php';
										$con = connect();
										//$res_id = $_SESSION['id'];
										$sql = "SELECT * FROM `note_list` JOIN `subject_names` ON note_list.subject_id=subject_names.subject_id 
										JOIN `notemaker_tables` ON note_list.notemaker_id=notemaker_tables.notemaker_id
										JOIN `depart_tables` ON note_list.depart_id=depart_tables.depart_id
										JOIN `semester` ON note_list.semester=semester.semester
										JOIN `uni_tables` ON note_list.uni_id=uni_tables.uni_id
										JOIN `college_names` ON note_list.college_id=college_names.college_id 
										ORDER BY note_id ASC;";
										$result = $con->query($sql);
										foreach ($result as $r) {
										?>
										<tr class="gradeX">
											<td class="center hidden-phone"><?php echo $count; ?></td>
											<td class="center hidden-phone"><?php echo $r['uni_name']; ?></td>
											<td><?php echo $r['depart_id']; ?></td>
											<td><?php echo $r['college_name']; ?></td>
											<td><?php echo $r['semester']; ?></td>
											<td><?php echo $r['subject_name']; ?></td>
											<td><?php echo $r['notemaker_name']; ?></td>
											<td><?php 
													$status = $r['approved_status'];
                                                
													if ($status == 1) {
												?>
												<a href="approve-reject.php?reject_id=<?php echo $_SESSION['role'] ?>&note_id=<?php echo $r['note_id']?>" class="text-success" onclick="if (!Done()) return false; ">Approved</a>
												<?php }else{ ?>
												<a href="approve-reject.php?approve_id=<?php $_SESSION['role'] ?>&note_id=<?php echo $r['note_id']?>" class="text-danger" onclick="if (!Done()) return false; ">Not Approved</a>	
												<?php } ?></td>
											<td><?php echo $r['note']; ?></td>

											<td class="center hidden-phone">
												<a href="note-pdf/<?php echo $r['note']; ?>" target="_blank" class="btn btn-primary">View</a>
											</td>
											<td class="center hidden-phone">
												<a href="delete-note.php?note_id=<?php echo $r['note_id']; ?>" class="btn btn-danger">Delete</a>
											</td>
										</tr>
										<?php $count++; } ?>
									</tbody>
								</table>
							</div>
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
	</body>
</html>
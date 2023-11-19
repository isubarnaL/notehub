<!-- invoice.php -->
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
						<h2>Note</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Pages</span></li>
								<li><span>Notes</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->

					<section class="panel">
						<div class="panel-body">
							<div class="invoice">
								<header class="clearfix">
									<div class="row">
										<div class="col-sm-4 mt-md">
											<h2 class="h2 mt-none mb-sm text-dark text-bold">Note</h2>
											<h4 class="h4 m-none text-dark text-bold">
											
										</div>
										<?php 
											include 'dbCon.php';
											$con = connect();
											$id = $_GET['note_id'];
											//$res_id = $_SESSION['id'];
											$sql = "SELECT * FROM `note_list` where note_id = '$id';";
											$result = $con->query($sql);
											foreach ($result as $r) {
										?>
				                            <div class="col-sm-8 text-right mt-md mb-md">							
										
										</div>
										<?php } ?>
									</div>
								</header>
				
								</div>
								<div class="row">
										<div class="col-md-6">
											<div class="bill-to">
										<a href="note-pdf/<?php echo $r['note']; ?>" class="btn btn-primary" target="_blank">View Note</a>
											</div>
										</div>
										<div class="col-md-6">
											<div class="bill-data text-right">
												<p class="mb-none">
													<a href="delete-note.php?note_id=<?php echo $r['note_id']; ?>" class="btn btn-danger">Delete Note</a>
												</p>
											</div>
										</div>
									</div>
																	
								
	                                    

							<div class="text-right mr-lg">	
							</div>
						</div>
					</section>

					<!-- end: page -->
				</section>
			</div>

			<?php include 'template/right-bar.php'; ?>
		</section>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

	</body>
</html>
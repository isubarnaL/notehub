<?php
include '../security.php';
admin_guard();
include 'template/header.php';
$tok = csrf_token();
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
								<li><span>Registered Users</span></li>
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
						
								<h2 class="panel-title">All Users</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
											<th>No</th>
											<th>User Id</th>
											<th>Users</th>
											<th>Email</th>
											<th>Role(1=admin,2=user)</th>
										<th class="hidden-phone">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$count = 1;
										include 'dbCon.php';
										$con = connect();
										//$res_id = $_SESSION['id'];
										$sql = "SELECT * FROM `user_info`
										ORDER BY id ASC;";
										$result = $con->query($sql);
										foreach ($result as $r) {
										?>
										<tr class="gradeX">
											<td class="center hidden-phone"><?php echo $count; ?></td>
											<td><?php echo (int)$r['id']; ?></td>
											<td><?php echo htmlspecialchars($r['user_name']); ?></td>
											<td><?php echo htmlspecialchars($r['email']); ?></td>
											<td><?php echo (int)$r['role']; ?></td>
							<td class="center hidden-phone">
												<?php 
													$status = $r['role'];
                                                
													if ($status == 1) {
												?>
												<a href="make-admin.php?reject_id=1&user_id=<?php echo $r['id'] ?>&_token=<?php echo $tok ?>" class="btn btn-danger" onclick="if (!Done()) return false; " >make user</a>
												<?php }else{ ?>
												<a href="make-admin.php?approve_id=1&user_id=<?php echo $r['id'] ?>&_token=<?php echo $tok ?>" class="btn btn-success" onclick="if (!Done()) return false; ">make admin</a>	
												<?php } ?>
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

		<?php include 'template/script-res.php'; ?>
	</body>
</html>
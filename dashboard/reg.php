<?php include '../security.php'; admin_guard(); include 'template/header.php';

// Single connection for the whole page; each lookup table queried exactly once.
include 'dbCon.php';
$con = connect();

$unis      = $con->query("SELECT uni_id, uni_name FROM `uni_tables`")->fetch_all(MYSQLI_ASSOC);
$colleges  = $con->query("SELECT college_id, college_name FROM `college_names`")->fetch_all(MYSQLI_ASSOC);
$departs   = $con->query("SELECT depart_id, depart_name FROM `depart_tables` ORDER BY id ASC")->fetch_all(MYSQLI_ASSOC);
$semesters = $con->query("SELECT semester, sem_name FROM `semester`")->fetch_all(MYSQLI_ASSOC);
$subjects  = $con->query("SELECT subject_id, subject_name FROM `subject_names`")->fetch_all(MYSQLI_ASSOC);
$notemakers= $con->query("SELECT notemaker_id, notemaker_name FROM `notemaker_tables`")->fetch_all(MYSQLI_ASSOC);
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
									<a href="#">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Tables</span></li>
								<li><span>add notes</span></li>
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

							<h2 class="panel-title">Add Notes</h2>
						</header>
						<div class="panel-body">
						<div class="col-lg-8">
                  <div class="col-md-12">

				  <form action="manage-insert1.php" method="POST" enctype="multipart/form-data" >
						<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                          <div class="form-group">
                          <select class="form-control " name="uni_name" required="">
                            <option value=""> -Select University- </option>
                            <?php foreach ($unis as $r): ?>
                              <option value="<?php echo $r['uni_id']; ?>"><?php echo $r['uni_name']; ?></option>
                            <?php endforeach; ?>
                         </select>
                        </div>

                          <div class="form-group">
                          <select class="form-control " name="college_name">
                            <option value=""> -Select College- </option>
                            <?php foreach ($colleges as $r): ?>
                              <option value="<?php echo $r['college_id']; ?>"><?php echo $r['college_name']; ?></option>
                            <?php endforeach; ?>
                         </select>
                        </div>

						<div class="form-group">
                          <select class="form-control " name="depart_name" required="">
                            <option value=""> -Select Department- </option>
                            <?php foreach ($departs as $r): ?>
                              <option value="<?php echo $r['depart_id']; ?>"><?php echo $r['depart_name']; ?></option>
                            <?php endforeach; ?>
                         </select>
                        </div>

						<div class="form-group">
                          <select class="form-control " name="semester" required="">
                            <option value=""> -Select Semester- </option>
                            <?php foreach ($semesters as $r): ?>
                              <option value="<?php echo $r['semester']; ?>"><?php echo $r['sem_name']; ?></option>
                            <?php endforeach; ?>
                         </select>
                        </div>

                          <div class="form-group">
                          <select class="form-control " name="subject_name" required="">
                            <option value=""> -Select Subject- </option>
                            <?php foreach ($subjects as $r): ?>
                              <option value="<?php echo $r['subject_id']; ?>"><?php echo $r['subject_name']; ?></option>
                            <?php endforeach; ?>
                         </select>
                        </div>

                          <div class="form-group">
                          <select class="form-control " name="notemaker_name">
                            <option value="11"> -Select Notemaker- </option>
                            <?php foreach ($notemakers as $r): ?>
                              <option value="<?php echo $r['notemaker_id']; ?>"><?php echo $r['notemaker_name']; ?></option>
                            <?php endforeach; ?>
                         </select>
                        </div>

                        <div class="form-group">
                          <input type="file" name="pdf" class="form-control" required> <!-- multiple/-->
                        </div>

                        <div class="form-group">
                        <input type="submit" value="Add Note" name="regasres" class="btn btn-primary py-3 px-5">
                        </div>
                      </form>
                     <div class="text-right">*if you don't see your desired options contact admins.</div>
       <!--
             </div>
                  </div>
                  </div>
                </div>
              </div><!-- END -->
		  </div>
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

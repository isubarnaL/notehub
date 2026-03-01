  <!-- Note Projects-->
        <section class="projects-section bg-black" id="project">
            <div class="container">
	 <?php
      // Single connection for the whole page
      include_once 'dbCon.php';
      $con = connect();

      // Build share URL from actual server host — not hardcoded
      $protocol  = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
      $share_base = $protocol . '://' . htmlspecialchars($_SERVER['HTTP_HOST']) . '/notes.php?note_id=';

      // --- Search by Subject ---
      if (isset($_POST['subjsearch'])) {
        $uni_id     = $_POST['uni_id'];
        $depart_id  = $_POST['depart_id'];
        $subject_id = $_POST['subject_id'];
        $semester   = $_POST['semester'];

        $stmt = $con->prepare("SELECT * FROM note_list
            JOIN `subject_names`    ON note_list.subject_id   = subject_names.subject_id
            JOIN `notemaker_tables` ON note_list.notemaker_id  = notemaker_tables.notemaker_id
            JOIN `depart_tables`    ON note_list.depart_id     = depart_tables.depart_id
            JOIN `semester`         ON note_list.semester       = semester.semester
            JOIN `uni_tables`       ON note_list.uni_id         = uni_tables.uni_id
            WHERE note_list.uni_id = ? AND note_list.depart_id = ? AND note_list.semester = ? AND note_list.subject_id = ?");
        $stmt->bind_param('ssss', $uni_id, $depart_id, $semester, $subject_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows <= 0) {
	   ?>
	   <center>
	   <h1 class="text-white">Oops! Sorry, No Notes Found.</h1>
	   <br><br>
	   <a href="javascript:history.back()" class="btn btn-danger"><i class="fa fa-backward" aria-hidden="true"></i> Go Back</a>
	   <br><br><h5 class="text-warning"><center>OR<br>
	   <i class="fa fa-chevron-down" aria-hidden="true"></i>
	   </h5><br>
	   <p class="text-white">To Get Your Notes When we Upload em : <a href="#signup" class="btn btn-outline-info btn-sm js-scroll-trigger">Subscribe</a></p></center>
	   <?php
        } else {
          foreach ($result as $r) { ?>
				 <h1 class="text-white">Notes For <?php echo htmlspecialchars($r['uni_name']); ?> University <?php echo htmlspecialchars($r['depart_name']); ?> Department <?php echo htmlspecialchars($r['subject_name']); ?> <?php echo htmlspecialchars($r['sem_name']); ?> Semester</h1><br>

				 <div class="row align-items-center no-gutters mb-4 mb-lg-5">
                    <div class="col-xl-8 col-lg-7"> <iframe id="pdf-js-viewer" src="dashboard/note-pdf/<?php echo htmlspecialchars($r['note']); ?>" title="webviewer" frameborder="0" width="90%" height="600"></iframe></div>
				 <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
					 <p class="text-white"> <?php echo htmlspecialchars($r['uni_name']); ?> University <br><?php echo htmlspecialchars($r['depart_name']); ?> Department<br><?php echo htmlspecialchars($r['subject_name']); ?> Subject<br> <?php echo htmlspecialchars($r['sem_name']); ?> Semester<br>By:<?php echo htmlspecialchars($r['notemaker_name']); ?><br>Approved Status:<?php
												$status = $r['approved_status'];
                                                if ($status == 1) { ?>
											<a href="#" class="text-success" data-toggle="tooltip" data-placement="top" title="This note is approved by admins.">Approved</a>
											<?php } else { ?>
											<a href="#" class="text-danger" data-toggle="tooltip" data-placement="top" title="This note's not yet approved by admins.">Not Approved</a>
											<?php } ?>
										</p>
<div class="form-group">
<div class="text-white">Share This Note:</div>
    <input type="text" class="form-control text-white" value="<?php echo $share_base . (int)$r['note_id']; ?>" readonly>
  </div>
			<a href="dashboard/note-pdf/<?php echo htmlspecialchars($r['note']); ?>" target="_blank" class="btn btn-success">FullScreen</a><br><br><br><br><br><br><br></div></div>
            </div>
		<hr style="border-width:2;color:white;background-color:white"><br>
			<?php } }
      }
 ?>

  <?php
      // --- Search by College ---
      if (isset($_POST['clzsearch'])) {
        $uni_id     = $_POST['uni_id'];
        $college_id = $_POST['college_id'];
        $depart_id  = $_POST['depart_id'];
        $semester   = $_POST['semester'];

        $stmt = $con->prepare("SELECT * FROM note_list
            JOIN `subject_names`    ON note_list.subject_id   = subject_names.subject_id
            JOIN `notemaker_tables` ON note_list.notemaker_id  = notemaker_tables.notemaker_id
            JOIN `depart_tables`    ON note_list.depart_id     = depart_tables.depart_id
            JOIN `semester`         ON note_list.semester       = semester.semester
            JOIN `uni_tables`       ON note_list.uni_id         = uni_tables.uni_id
            JOIN `college_names`    ON note_list.college_id     = college_names.college_id
            WHERE note_list.uni_id = ? AND note_list.depart_id = ? AND note_list.semester = ? AND note_list.college_id = ?");
        $stmt->bind_param('ssss', $uni_id, $depart_id, $semester, $college_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows <= 0) {
	   ?>
	   <center><h1 class="text-white">Oops! Sorry, No Notes Found.</h1>
	   <br><br>
	   <a href="javascript:history.back()" class="btn btn-danger"><i class="fa fa-backward" aria-hidden="true"></i> Go Back</a>
	  <br><br>
	   <h5 class="text-warning">OR<br>
	   <i class="fa fa-chevron-down" aria-hidden="true"></i>
	   </h5><br>
	   <p class="text-white">To Get Your Notes When we Upload em : <a href="#signup" class="btn btn-outline-info btn-sm js-scroll-trigger">Subscribe</a></p></center>
	   <?php
        } else {
          foreach ($result as $r) { ?>
				<h1 class="text-white">Note Results For <?php echo htmlspecialchars($r['uni_name']); ?> University <?php echo htmlspecialchars($r['depart_name']); ?> Department <?php echo htmlspecialchars($r['college_name']); ?> College <?php echo htmlspecialchars($r['sem_name']); ?> Semester</h1><br>

				<div class="row align-items-center no-gutters mb-4 mb-lg-5">
                    <div class="col-xl-8 col-lg-7"> <iframe id="pdf-js-viewer" src="dashboard/note-pdf/<?php echo htmlspecialchars($r['note']); ?>" title="webviewer" frameborder="0" width="90%" height="600"></iframe></div>
				 <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
					 <p class="text-white"> <?php echo htmlspecialchars($r['uni_name']); ?> University <br><?php echo htmlspecialchars($r['depart_name']); ?> Department<br><?php echo htmlspecialchars($r['subject_name']); ?> Subject<br> <?php echo htmlspecialchars($r['sem_name']); ?> Semester<br>By:<?php echo htmlspecialchars($r['notemaker_name']); ?><br>Approved Status:<?php
												$status = $r['approved_status'];
                                                if ($status == 1) { ?>
											<a href="#" class="text-success" data-toggle="tooltip" data-placement="top" title="This note is approved by admins.">Approved</a>
											<?php } else { ?>
											<a href="#" class="text-danger" data-toggle="tooltip" data-placement="top" title="This note's not yet approved by admins.">Not Approved</a>
											<?php } ?>
										</p>
<div class="form-group">
<div class="text-white">Share This Note:</div>
    <input type="text" class="form-control text-white" value="<?php echo $share_base . (int)$r['note_id']; ?>" readonly>
  </div>
			<a href="dashboard/note-pdf/<?php echo htmlspecialchars($r['note']); ?>" target="_blank" class="btn btn-success">FullScreen</a><br><br><br><br><br><br><br></div></div>
            </div>
		<hr style="border-width:2;color:white;background-color:white"><br>
			<?php } }
      }
 ?>

 <?php
      // --- Search by Notemaker ---
      if (isset($_POST['ntmkrsearch'])) {
        $notemaker_id = $_POST['notemaker_id'];

        $stmt = $con->prepare("SELECT * FROM note_list
            JOIN `depart_tables`    ON note_list.depart_id     = depart_tables.depart_id
            JOIN `uni_tables`       ON note_list.uni_id         = uni_tables.uni_id
            JOIN `semester`         ON note_list.semester       = semester.semester
            JOIN `subject_names`    ON note_list.subject_id    = subject_names.subject_id
            JOIN `notemaker_tables` ON note_list.notemaker_id  = notemaker_tables.notemaker_id
            WHERE note_list.notemaker_id = ?");
        $stmt->bind_param('s', $notemaker_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows <= 0) {
	   ?>
	   <center><h1 class="text-white">Oops! Sorry, No Notes Found.</h1>
	   <br><br>
	   <a href="javascript:history.back()" class="btn btn-danger"><i class="fa fa-backward" aria-hidden="true"></i> Go Back</a>
	   <br><br>
	   <h5 class="text-warning">OR<br>
	   <i class="fa fa-chevron-down" aria-hidden="true"></i>
	   </h5>
	   <p class="text-white">To Get Your Notes When we Upload em : <a href="#signup" class="btn btn-outline-info btn-sm js-scroll-trigger">Subscribe</a></p></center>
	   <?php
        } else {
          foreach ($result as $r) { ?>
				 <h1 class="text-white">Notes By <?php echo htmlspecialchars($r['notemaker_name']); ?></h1><br>
				 <div class="row align-items-center no-gutters mb-4 mb-lg-5">
                    <div class="col-xl-8 col-lg-7"> <iframe id="pdf-js-viewer" src="dashboard/note-pdf/<?php echo htmlspecialchars($r['note']); ?>" title="webviewer" frameborder="0" width="90%" height="600"></iframe></div>
				 <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
					 <p class="text-white"> <?php echo htmlspecialchars($r['uni_name']); ?> University <br><?php echo htmlspecialchars($r['depart_name']); ?> Department<br><?php echo htmlspecialchars($r['subject_name']); ?> Subject<br> <?php echo htmlspecialchars($r['sem_name']); ?> Semester<br>By:<?php echo htmlspecialchars($r['notemaker_name']); ?><br>Approved Status:<?php
												$status = $r['approved_status'];
                                                if ($status == 1) { ?>
											<a href="#" class="text-success" data-toggle="tooltip" data-placement="top" title="This note is approved by admins.">Approved</a>
											<?php } else { ?>
											<a href="#" class="text-danger" data-toggle="tooltip" data-placement="top" title="This note's not yet approved by admins.">Not Approved</a>
											<?php } ?>
										</p>
<div class="form-group">
<div class="text-white">Share This Note:</div>
    <input type="text" class="form-control text-white" value="<?php echo $share_base . (int)$r['note_id']; ?>" readonly>
  </div>
			<a href="dashboard/note-pdf/<?php echo htmlspecialchars($r['note']); ?>" target="_blank" class="btn btn-success">FullScreen</a><br><br><br><br><br><br><br></div></div>
            </div>
		<hr style="border-width:2;color:white;background-color:white"><br>
			<?php } }
      }
 ?>

<?php
      // --- View by note_id (shareable link) ---
      if (isset($_GET['note_id'])) {
        $note_id = (int) $_GET['note_id'];

        $stmt = $con->prepare("SELECT * FROM note_list
            JOIN `depart_tables`    ON note_list.depart_id     = depart_tables.depart_id
            JOIN `uni_tables`       ON note_list.uni_id         = uni_tables.uni_id
            JOIN `semester`         ON note_list.semester       = semester.semester
            JOIN `subject_names`    ON note_list.subject_id    = subject_names.subject_id
            JOIN `notemaker_tables` ON note_list.notemaker_id  = notemaker_tables.notemaker_id
            WHERE note_list.note_id = ?");
        $stmt->bind_param('i', $note_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows <= 0) {
	   ?>
	   <center><h1 class="text-white">Oops! Sorry, No Notes Found.</h1>
	   <br><br>
	   <a href="javascript:history.back()" class="btn btn-danger"><i class="fa fa-backward" aria-hidden="true"></i> Go Back</a>
	   <br><br>
	   <h5 class="text-warning">OR<br>
	   <i class="fa fa-chevron-down" aria-hidden="true"></i>
	   </h5>
	   <p class="text-white">To Get Your Notes When we Upload em : <a href="#signup" class="btn btn-outline-info btn-sm js-scroll-trigger">Subscribe</a></p></center>
	   <?php
        } else {
          foreach ($result as $r) { ?>
				 <h1 class="text-white">Note of <?php echo htmlspecialchars($r['subject_name']); ?> By <?php echo htmlspecialchars($r['notemaker_name']); ?></h1><br>
				 <div class="row align-items-center no-gutters mb-4 mb-lg-5">
                    <div class="col-xl-8 col-lg-7"> <iframe id="pdf-js-viewer" src="dashboard/note-pdf/<?php echo htmlspecialchars($r['note']); ?>" title="webviewer" frameborder="0" width="95%" height="700"></iframe></div>
				 <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
					 <p class="text-white"> <?php echo htmlspecialchars($r['uni_name']); ?> University <br><?php echo htmlspecialchars($r['depart_name']); ?> Department<br><?php echo htmlspecialchars($r['subject_name']); ?> Subject<br> <?php echo htmlspecialchars($r['sem_name']); ?> Semester<br>By:<?php echo htmlspecialchars($r['notemaker_name']); ?><br>Approved Status:<?php
												$status = $r['approved_status'];
                                                if ($status == 1) { ?>
											<a href="#" class="text-success" data-toggle="tooltip" data-placement="top" title="This note is approved by admins.">Approved</a>
											<?php } else { ?>
											<a href="#" class="text-danger" data-toggle="tooltip" data-placement="top" title="This note's not yet approved by admins.">Not Approved</a>
											<?php } ?>
										</p>
<div class="form-group">
<div class="text-white">Share This Note:</div>
    <input type="text" class="form-control text-white" value="<?php echo $share_base . (int)$r['note_id']; ?>" readonly>
  </div>
			<a href="dashboard/note-pdf/<?php echo htmlspecialchars($r['note']); ?>" target="_blank" class="btn btn-success">FullScreen</a><br><br><br><br><br><br><br></div></div>
            </div>
		<hr style="border-width:2;color:white;background-color:white"><br>
			<?php } }
      }
 ?>


			                <!-- Project One Row-->

                <!-- Project Two Row-->
                <div class="row justify-content-center no-gutters">
                    <div class="col-lg-6 order-lg-first">
                        <div class="bg-black text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-center">
                                    <h4 class="text-white">PUBLISH YOUR NOTES</h4>
                                    <p class="mb-0 text-white-50">If you want to publish your notes here, please <a class="nav-link js-scroll-trigger" href="#contact">contact us.</a></p>
                                    <hr class="d-none d-lg-block mb-0 mc-0" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

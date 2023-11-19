  <!-- Note Projects-->
        <section class="projects-section bg-black" id="project">
            <div class="container">
		 <?php 
      include_once 'dbCon.php';
      $con = connect();
      if (isset($_POST['subjsearch'])) {
        $uni_id = $_POST['uni_id'];	
		$depart_id = $_POST['depart_id'];
		$subject_id = $_POST['subject_id'];
		$semester = $_POST['semester'];
		
		
  $subjectSQL = "SELECT * FROM note_list WHERE uni_id = '$uni_id' AND depart_id = '$depart_id' AND semester = '$semester' AND subject_id = '$subject_id';";
  $subjectResult = $con->query($subjectSQL);

  if ($subjectResult->num_rows <= 0) {
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
    
  }
  else{
    $SQL = "SELECT * FROM note_list 
	JOIN `subject_names` ON note_list.subject_id=subject_names.subject_id 
										JOIN `notemaker_tables` ON note_list.notemaker_id=notemaker_tables.notemaker_id
										JOIN `depart_tables` ON note_list.depart_id=depart_tables.depart_id
										JOIN `semester` ON note_list.semester=semester.semester
										JOIN `uni_tables` ON note_list.uni_id=uni_tables.uni_id
	WHERE note_list.uni_id = '$uni_id' AND note_list.depart_id = '$depart_id' AND note_list.semester = '$semester' AND note_list.subject_id = '$subject_id';";
    $result = $con->query($SQL);
				foreach ($result as $r) {
					?>
					 <h1 class="text-white">Notes For <?php echo $r['uni_name']; ?> University <?php echo $r['depart_name']; ?> Department <?php echo $r['subject_name']; ?> <?php echo $r['sem_name']; ?> Semester</h1><br>
				
					 <div class="row align-items-center no-gutters mb-4 mb-lg-5">
                    <div class="col-xl-8 col-lg-7"> <iframe id="pdf-js-viewer" src="dashboard/note-pdf/<?php echo $r['note']; ?>" title="webviewer" frameborder="0" width="90%" height="600"></iframe></div>
					 <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
						 <p class="text-white"> <?php echo $r['uni_name']; ?> University <br><?php echo $r['depart_name']; ?> Department<br><?php echo $r['subject_name']; ?> Subject<br> <?php echo $r['sem_name']; ?> Semester<br>By:<?php echo $r['notemaker_name']; ?><br>Approved Status:<?php 
													$status = $r['approved_status'];
                                                
													if ($status == 1) {
												?>
												<a href="#" class="text-success" data-toggle="tooltip" data-placement="top" title="This note is approved by admins.">Approved</a>
												<?php }else{ ?>
												<a href="#" class="text-danger" data-toggle="tooltip" data-placement="top" title="This note's not yet approved by admins.">Not Approved</a>	
												<?php } ?>
											</p>
<div class="form-group">
<div class="text-white">Share This Note:</div>
    <input type="text" class="form-control text-white" id="exampleInputEmail1" value="notehub.com/notes.php?note_id=<?php echo $r['note_id'];?>"readonly>
  </div>
				<a href="dashboard/note-pdf/<?php echo $r['note']; ?>" target="_blank" class="btn btn-success">FullScreen</a><br><br><br><br><br><br><br></div></div>
            </div>
			<hr style="border-width:2;color:white;background-color:white"><br>
				<?php
 }
    } 
    
  }
 ?>
  <?php 
      include_once 'dbCon.php';
      $con = connect();
      if (isset($_POST['clzsearch'])) {
        $uni_id = $_POST['uni_id'];
		$college_id = $_POST['college_id'];
		$depart_id = $_POST['depart_id'];
	
		$semester = $_POST['semester'];
		
		
  $collegeSQL = "SELECT * FROM note_list WHERE uni_id = '$uni_id' AND depart_id = '$depart_id' AND semester = '$semester' AND college_id = '$college_id';";
  $collegeResult = $con->query($collegeSQL);

  if ($collegeResult->num_rows <= 0) {
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

  }else{
    $SQL = "SELECT * FROM note_list JOIN `subject_names` ON note_list.subject_id=subject_names.subject_id 
										JOIN `notemaker_tables` ON note_list.notemaker_id=notemaker_tables.notemaker_id
										JOIN `depart_tables` ON note_list.depart_id=depart_tables.depart_id
										JOIN `semester` ON note_list.semester=semester.semester
										JOIN `uni_tables` ON note_list.uni_id=uni_tables.uni_id
										JOIN `college_names` ON note_list.college_id=college_names.college_id 
										WHERE note_list.uni_id = '$uni_id' AND note_list.depart_id = '$depart_id' AND note_list.semester = '$semester' AND note_list.college_id = '$college_id';";
    $result = $con->query($SQL);	
				foreach ($result as $r) {
					?>
					<h1 class="text-white">Note Results For <?php echo $r['uni_name']; ?> University <?php echo $r['depart_name']; ?> Department <?php echo $r['college_name']; ?> College <?php echo $r['sem_name']; ?> Semester</h1><br>
				
					<div class="row align-items-center no-gutters mb-4 mb-lg-5">
                    <div class="col-xl-8 col-lg-7"> <iframe id="pdf-js-viewer" src="dashboard/note-pdf/<?php echo $r['note']; ?>" title="webviewer" frameborder="0" width="90%" height="600"></iframe></div>
					 <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
						 <p class="text-white"> <?php echo $r['uni_name']; ?> University <br><?php echo $r['depart_name']; ?> Department<br><?php echo $r['subject_name']; ?> Subject<br> <?php echo $r['sem_name']; ?> Semester<br>By:<?php echo $r['notemaker_name']; ?><br>Approved Status:<?php 
													$status = $r['approved_status'];
                                                
													if ($status == 1) {
												?>
												<a href="#" class="text-success" data-toggle="tooltip" data-placement="top" title="This note is approved by admins.">Approved</a>
												<?php }else{ ?>
												<a href="#" class="text-danger" data-toggle="tooltip" data-placement="top" title="This note's not yet approved by admins.">Not Approved</a>	
												<?php } ?>
											</p>
<div class="form-group">
<div class="text-white">Share This Note:</div>
    <input type="text" class="form-control text-white" id="exampleInputEmail1" value="notehub.com/notes.php?note_id=<?php echo $r['note_id'];?>"readonly>
  </div>
				<a href="dashboard/note-pdf/<?php echo $r['note']; ?>" target="_blank" class="btn btn-success">FullScreen</a><br><br><br><br><br><br><br></div></div>
            </div>
			<hr style="border-width:2;color:white;background-color:white"><br>
				<?php
 }
    } 
    
  }
 ?>
 
 <?php 
      include_once 'dbCon.php';
      $con = connect();
      if (isset($_POST['ntmkrsearch'])) {
      
		$notemaker_id = $_POST['notemaker_id'];
		
  $ntmkrSQL = "SELECT * FROM note_list WHERE notemaker_id = '$notemaker_id';";
  $ntmkrResult = $con->query($ntmkrSQL);

  if ($ntmkrResult->num_rows <= 0) {
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
  }else{
    $SQL = "SELECT * FROM note_list 
	JOIN `depart_tables` ON note_list.depart_id=depart_tables.depart_id 
	JOIN `uni_tables` ON note_list.uni_id=uni_tables.uni_id 
	JOIN `semester` ON note_list.semester=semester.semester
	JOIN `subject_names` ON note_list.subject_id=subject_names.subject_id 
	JOIN `notemaker_tables` ON note_list.notemaker_id=notemaker_tables.notemaker_id 
	WHERE note_list.notemaker_id = '$notemaker_id';";
    $result = $con->query($SQL);
    foreach ($result as $r) {
					?>
					 <h1 class="text-white">Notes By <?php echo $r['notemaker_name']; ?></h1><br>
					 <div class="row align-items-center no-gutters mb-4 mb-lg-5">
                    <div class="col-xl-8 col-lg-7"> <iframe id="pdf-js-viewer" src="dashboard/note-pdf/<?php echo $r['note']; ?>" title="webviewer" frameborder="0" width="90%" height="600"></iframe></div>
					 <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
						 <p class="text-white"> <?php echo $r['uni_name']; ?> University <br><?php echo $r['depart_name']; ?> Department<br><?php echo $r['subject_name']; ?> Subject<br> <?php echo $r['sem_name']; ?> Semester<br>By:<?php echo $r['notemaker_name']; ?><br>Approved Status:<?php 
													$status = $r['approved_status'];
                                                
													if ($status == 1) {
												?>
												<a href="#" class="text-success" data-toggle="tooltip" data-placement="top" title="This note is approved by admins.">Approved</a>
												<?php }else{ ?>
												<a href="#" class="text-danger" data-toggle="tooltip" data-placement="top" title="This note's not yet approved by admins.">Not Approved</a>	
												<?php } ?>
											</p>
<div class="form-group">
<div class="text-white">Share This Note:</div>
    <input type="text" class="form-control text-white" id="exampleInputEmail1" value="notehub.com/notes.php?note_id=<?php echo $r['note_id'];?>"readonly>
  </div>
				<a href="dashboard/note-pdf/<?php echo $r['note']; ?>" target="_blank" class="btn btn-success">FullScreen</a><br><br><br><br><br><br><br></div></div>
            </div>
			<hr style="border-width:2;color:white;background-color:white"><br>
				<?php
 }


    } 

	
    
  }
 ?>

<?php 
      include_once 'dbCon.php';
      $con = connect();
      if (isset($_GET['note_id'])) {
      
		$notemaker_id = $_GET['note_id'];
		
  $ntmkrSQL = "SELECT * FROM note_list WHERE note_id = '$notemaker_id';";
  $ntmkrResult = $con->query($ntmkrSQL);

  if ($ntmkrResult->num_rows <= 0) {
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
  }else{
    $SQL = "SELECT * FROM note_list 
	JOIN `depart_tables` ON note_list.depart_id=depart_tables.depart_id 
	JOIN `uni_tables` ON note_list.uni_id=uni_tables.uni_id 
	JOIN `semester` ON note_list.semester=semester.semester
	JOIN `subject_names` ON note_list.subject_id=subject_names.subject_id 
	JOIN `notemaker_tables` ON note_list.notemaker_id=notemaker_tables.notemaker_id 
	WHERE note_list.note_id = '$notemaker_id';";
    $result = $con->query($SQL);
    foreach ($result as $r) {
					?>
					 <h1 class="text-white">Note of <?php echo $r['subject_name']; ?> By <?php echo $r['notemaker_name']; ?></h1><br>
					 <div class="row align-items-center no-gutters mb-4 mb-lg-5">
                    <div class="col-xl-8 col-lg-7"> <iframe id="pdf-js-viewer" src="dashboard/note-pdf/<?php echo $r['note']; ?>" title="webviewer" frameborder="0" width="95%" height="700"></iframe></div>
					 <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
						 <p class="text-white"> <?php echo $r['uni_name']; ?> University <br><?php echo $r['depart_name']; ?> Department<br><?php echo $r['subject_name']; ?> Subject<br> <?php echo $r['sem_name']; ?> Semester<br>By:<?php echo $r['notemaker_name']; ?><br>Approved Status:<?php 
													$status = $r['approved_status'];
                                                
													if ($status == 1) {
												?>
												<a href="#" class="text-success" data-toggle="tooltip" data-placement="top" title="This note is approved by admins.">Approved</a>
												<?php }else{ ?>
												<a href="#" class="text-danger" data-toggle="tooltip" data-placement="top" title="This note's not yet approved by admins.">Not Approved</a>	
												<?php } ?>
											</p>
<div class="form-group">
<div class="text-white">Share This Note:</div>
    <input type="text" class="form-control text-white" id="exampleInputEmail1" value="notehub.com/notes.php?note_id=<?php echo $r['note_id'];?>"readonly>
  </div>
				<a href="dashboard/note-pdf/<?php echo $r['note']; ?>" target="_blank" class="btn btn-success">FullScreen</a><br><br><br><br><br><br><br></div></div>
            </div>
			<hr style="border-width:2;color:white;background-color:white"><br>
				<?php
 }


    } 

	
    
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
                                    <p class="mb-0 text-white-50">If you want to publish your notes here,please <a class="nav-link js-scroll-trigger" href="#contact">contact</a> us<br>or upload your notes<br><a href="dashboard/reg.php">here.</a></p>
                                    <hr class="d-none d-lg-block mb-0 mc-0" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
	    
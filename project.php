       <!-- Projects-->
        <section class="projects-section bg-gray" id="projects">
            <div class="container">
	 <!-- delete from here Row-->
                <!-- Featured Project Row-->
<?php
// Single connection for the whole page; each lookup table queried exactly once.
include 'dbCon.php';
$con = connect();

$unis      = $con->query("SELECT uni_id, uni_name FROM `uni_tables`")->fetch_all(MYSQLI_ASSOC);
$departs   = $con->query("SELECT depart_id, depart_name FROM `depart_tables` ORDER BY id ASC")->fetch_all(MYSQLI_ASSOC);
$semesters = $con->query("SELECT semester, sem_name FROM `semester`")->fetch_all(MYSQLI_ASSOC);
$colleges  = $con->query("SELECT college_id, college_name FROM `college_names`")->fetch_all(MYSQLI_ASSOC);
$notemakers= $con->query("SELECT notemaker_id, notemaker_name FROM `notemaker_tables` ORDER BY notemaker_name ASC")->fetch_all(MYSQLI_ASSOC);
?>
             <center>   <h1 class="text-white">Find Notes by Subject:</h1><br>

                  <form class="form-inline" action="notes.php" method="POST" enctype="multipart/form-data">
		               <div class="input-group" style="border: 2px solid black; padding:50px;">

                          <select class="sum-control btn-black" name="uni_id"  required>
                          <option value="">----University----</option>
                          <?php foreach ($unis as $r): ?>
                              <option value="<?php echo $r['uni_id']; ?>"><?php echo $r['uni_name']; ?></option>
                          <?php endforeach; ?>
                         </select>
		              <select class="sum-control btn-black" name="depart_id" id="depart_id"  required>
                          <option value="">---Department---</option>
                          <?php foreach ($departs as $r): ?>
                              <option value="<?php echo $r['depart_id']; ?>"><?php echo $r['depart_name']; ?></option>
                          <?php endforeach; ?>
                         </select>
		              <select  class="sum-control btn-black"  name="semester"  required>
                          <option value="">---Semester---</option>
                          <?php foreach ($semesters as $r): ?>
                              <option value="<?php echo $r['semester']; ?>"><?php echo $r['sem_name']; ?></option>
                          <?php endforeach; ?>
                         </select>
                            <script>
$(document).ready(function(){
    	    $('#depart_id').on('change', function(){
        var departID = $(this).val();

            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data: {depart_id: departID},

                success:function(html){
                    $('#subject_id').html(html);
                  // $('#subject_id').html('<option value="">Select semester</option>');
                }
            });

    });
    });
</script>

		               	  <select style="width: 200px" class="sum-control btn-black" name="subject_id" id="subject_id" required>
                          <option value="">----Subject----</option>

                          </select>



                        <div class="featured-text text-center text-lg-left">
                          <button class="btn btn-black mx-auto" type="submit" name="subjsearch" >search</button></div></center>
                  </form>
                  </div>
		      <br><br>
			  <h5 class="text-warning"><center>OR<br></h5><hr style="width:8%;border-width:1px;color:white;background-color:cyan;"><br></center>

		  <center>  <h1 class="text-white">Find Notes by College:</h1><br>

		      <form class="form-inline" action="notes.php" method="POST" enctype="multipart/form-data">
		               <div class="input-group" style="border: 2px solid black; padding:50px;">
                           <select class="sum-control btn-black"  name="uni_id"  required>
					   <option value="">----University----</option>
					   <?php foreach ($unis as $r): ?>
                              <option value="<?php echo $r['uni_id']; ?>"><?php echo $r['uni_name']; ?></option>
                          <?php endforeach; ?>
                           </select>
		                   <select class="sum-control btn-black"  name="college_id"  required>
                           <option value="">----College----</option>
					   <?php foreach ($colleges as $r): ?>
                              <option value="<?php echo $r['college_id']; ?>"><?php echo $r['college_name']; ?></option>
                          <?php endforeach; ?>
                           </select>
		               <select class="sum-control btn-black" name="depart_id"  required>
                           <option value="">----Department----</option>
					   <?php foreach ($departs as $r): ?>
                              <option value="<?php echo $r['depart_id']; ?>"><?php echo $r['depart_name']; ?></option>
                          <?php endforeach; ?>
					   </select>
                           <select class="sum-control btn-black" name="semester" required>
                           <option value="">----Semester----</option>
					   <?php foreach ($semesters as $r): ?>
                              <option value="<?php echo $r['semester']; ?>"><?php echo $r['sem_name']; ?></option>
                          <?php endforeach; ?>
                           </select>
						   <div class="featured-text text-center text-lg-left">
                          <button class="btn btn-black mx-auto" type="submit" name="clzsearch">search <i class="fa fa-search"></i></button></div>
                       </div></center>
			  </form>
			  <br><br>
			  <h5 class="text-warning"><center>OR<br></h5><hr style="width:8%;border-width:1px;color:white;background-color:cyan;"></center><br>

                <center><h1 class="text-white">Find Notes by NoteMaker:</h1><br>

			<div class="btn-group" style="border: 2px solid black; padding:50px;">
                   <form class="form-inline" action="notes.php" method="POST" enctype="multipart/form-data">

                            <select style="width: 250px" class="sum-control btn-black"  name="notemaker_id" id="notemaker_id"  required>
					   <option value="">----Notemaker----</option>
					   <?php foreach ($notemakers as $r): ?>
                              <option value="<?php echo $r['notemaker_id']; ?>"><?php echo $r['notemaker_name']; ?></option>
                          <?php endforeach; ?>
                         </select>
                           <div class="featured-text text-center text-lg-left">
  					  <button class="btn btn-black mx-auto" type="submit" name="ntmkrsearch">search <i class="fa fa-search"></i></button></div>
			        </div>
					</center>
                  </form>




            </div>
			                <!-- Project One Row-->

                <!-- Project Two Row-->
                <div class="row justify-content-center no-gutters">
                    <div class="col-lg-6 order-lg-first">
                        <div class="bg-gray text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-center">
                                    <h4 class="text-white">PUBLISH YOUR NOTES</h4>
                                    <p class="mb-0 text-white-50">If you want to publish your notes here,please <a class="nav-link js-scroll-trigger" href="#contact">contact</a> us<br>or upload your notes<br><a href="<?php echo empty($_SESSION['isLoggedIn']) ? 'login.php' : 'upload.php'; ?>" <?php if (!empty($_SESSION['isLoggedIn'])): ?>target="_blank"<?php endif; ?>>here</a></p>
                                    <hr class="d-none d-lg-block mb-0 mc-0" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

<?php 

                              include_once 'dbCon.php';
                              $con = connect();
							  if(!empty($_POST['depart_id']) ) 
							  {
								
                                $depart_id=	$_POST['depart_id'];
                                			
                              $sql = "SELECT * FROM `subject_names` WHERE  depart_id='$depart_id' ORDER BY semester ASC;";							  
                              $result = $con->query($sql);
                              foreach ($result as $r) {
                            ?>
                              <option value="<?php echo $r['subject_id']; ?>"><?php echo $r['subject_name']; ?></option>
							  <?php }}
							  ?>
							  
<?php
include_once("dbCon.php");
if ( !empty($_POST["semester"]) ) { //!empty($_POST["uni_id"]) &&!empty($_POST["depart_id"]) &&
   // $uni_id = $_POST['uni_id'];
	//$depart_id=$_POST["depart_id"];
	$semester=$_POST["semester"];
    $sql = "select * from subject_names where  $semester=$semester"; //uni_id=$uni_id AND $depart_id=$depart_id AND
   $result = $con->query($sql);
                              foreach ($result as $r) {
                            ?>
							<option value="">----Subject----</option>
                              <option value="<?php echo $r['subject_id']; ?>"><?php echo $r['subject_name']; ?></option>
<?php }} ?>

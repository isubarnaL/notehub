<?php include 'template/header.php';
 if((isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 1)){ ?>



  <body>

      <!-- start: header -->
      <?php include 'template/top-bar.php'; ?>
      <!-- end: header -->

      <div class="inner-wrapper">
        <!-- start: sidebar -->
        <?php include 'template/left-bar.php'; ?>
        <!-- end: sidebar -->
        <section role="main" class="content-body">
          <header class="page-header">
            <h2>Modify Accounts</h2>

            <div class="right-wrapper pull-right">
              <ol class="breadcrumbs">
                <li>
                  <a href="index.php">
                    <i class="fa fa-home"></i>
                  </a>
                </li>
                <li><span>Profile</span></li>
              </ol>

              <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
          </header>

          <!-- start: page -->

          <section>

                <?php
                include '../security.php';
                include 'dbCon.php';
                $con = connect();
                $res_id = (int) $_SESSION['id'];

                $stmt = $con->prepare("SELECT * FROM `user_info` WHERE id = ?");
                $stmt->bind_param('i', $res_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $stmt->close();

                if (isset($_POST['save'])) {
                  csrf_check();
                  $fullname    = trim($_POST['fullname']);
                  $email       = trim($_POST['email']);
                  $password    = $_POST['password'];
                  $re_password = $_POST['re_password'];
                  $current_pw  = $_POST['current_password'];

                  // Verify current password before allowing any change
                  if (!password_verify($current_pw, $row['password'])) {
                    echo '<script>alert("Current password is incorrect.")</script>';
                    echo '<script>window.location="profile.php"</script>';
                  } elseif (strlen($password) < 8) {
                    echo '<script>alert("New password must be at least 8 characters.")</script>';
                    echo '<script>window.location="profile.php"</script>';
                  } elseif ($password !== $re_password) {
                    echo '<script>alert("Passwords do not match.")</script>';
                    echo '<script>window.location="profile.php"</script>';
                  } else {
                    $hashed = password_hash($password, PASSWORD_DEFAULT);
                    $upd = $con->prepare("UPDATE `user_info` SET `user_name`=?, `email`=?, `password`=? WHERE `id`=?");
                    $upd->bind_param('sssi', $fullname, $email, $hashed, $res_id);
                    if ($upd->execute()) {
                      echo '<script>alert("Account has been updated.")</script>';
                      echo '<script>window.location="profile.php"</script>';
                    }
                    $upd->close();
                  }
                }

                if (isset($_POST['savephoto'])) {
                  csrf_check();
                  if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                    echo '<script>alert("No file uploaded or upload error.")</script>';
                    echo '<script>window.location="profile.php"</script>';
                  } else {
                    $targetDirectory = "user-image/";
                    $file_name = $_FILES['image']['name'];
                    $file_tmp  = $_FILES['image']['tmp_name'];
                    $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

                    // Verify actual MIME type — extension alone is not trustworthy
                    $finfo       = new finfo(FILEINFO_MIME_TYPE);
                    $mimeType    = $finfo->file($file_tmp);
                    $allowedMime = ['image/jpeg', 'image/png'];

                    if (in_array($mimeType, $allowedMime) && in_array($extension, ['jpg', 'jpeg', 'png'])) {
                      $safe_name = $res_id . '_' . basename($file_name);
                      if (!move_uploaded_file($file_tmp, $targetDirectory . $safe_name)) {
                        echo '<script>alert("Failed to save image. Check server permissions.")</script>';
                        echo '<script>window.location="profile.php"</script>';
                      } else {
                        $upd = $con->prepare("UPDATE `user_info` SET `p_image`=? WHERE `id`=?");
                        $upd->bind_param('si', $safe_name, $res_id);
                        if ($upd->execute()) {
                          echo '<script>alert("Photo has been updated.")</script>';
                          echo '<script>window.location="profile.php"</script>';
                        } else {
                          error_log('Profile photo DB error: ' . $con->error);
                          echo '<script>alert("Database error. Please try again.")</script>';
                          echo '<script>window.location="profile.php"</script>';
                        }
                        $upd->close();
                      }
                    } else {
                      echo '<script>alert("Required JPG or PNG image file.")</script>';
                      echo '<script>window.location="profile.php"</script>';
                    }
                  }
                }
                 ?>
<style type="text/css">
.stretch {
    margin-top: 5px;
}
.stretch img{
 width: 100%;
 cursor: pointer;
}
</style>

  <div class="contanier">
    <div class="row">

        <div class="col-lg-3"><!--left col-->
           <div class="panel panel-default">
            <div class="panel-body">
              <div  id="image-container " class="stretch">
                <img title="profile image"  data-target="#logomodal"  data-toggle="modal"  src="<?php echo 'user-image/' . htmlspecialchars($row['p_image']); ?>"  >
              </div>
             </div>
          <ul class="list-group">

            <li class="list-group-item text-muted">Profile</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Admin</strong></span>
             <?php echo htmlspecialchars($row['user_name']); ?>
             </li>

          </ul>

          <!-- /.box -->
          </div>

        </div>
        <div class="col-lg-9">
    <form class="form-horizontal" method="POST" action="profile.php">
      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
      <div class="row">

              <div class="form-group">
                <div class="col-md-7">
                <label class="col-md-4 control-label" for=
                  "Fname">Admin Name:</label>

                  <div class="col-md-8">
                   <input type="text" name="fullname" class="form-control" required="" placeholder="Admin Name" value="<?php echo htmlspecialchars($row['user_name']); ?>">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-7">
                <label class="col-md-4 control-label" for=
                  "Lname">Email Address:</label>

                  <div class="col-md-8">
                     <input type="email" name="email" class="form-control" required="" placeholder="Email" value="<?php echo htmlspecialchars($row['email']); ?>">
                  </div>
                </div>
              </div>

               <div class="form-group">
                <div class="col-md-7">
                  <label class="col-md-4 control-label" for="CustomerContact">Current Password:</label>

                  <div class="col-md-8">
                     <input type="password" name="current_password" class="form-control" required="" placeholder="Current Password">
                  </div>
                </div>
              </div>

               <div class="form-group">
                <div class="col-md-7">
                  <label class="col-md-4 control-label" for="CustomerContact">New Password:</label>

                  <div class="col-md-8">
                     <input type="password" name="password" class="form-control" required="" placeholder="New Password (min 8 chars)">
                  </div>
                </div>
              </div>

		  <div class="form-group">
                <div class="col-md-7">
                  <label class="col-md-4 control-label" for="CustomerContact">Retype Password:</label>
                  <div class="col-md-8">
                     <input type="password" name="re_password" class="form-control" placeholder="Retype Password" required>
                  </div>
                </div>
              </div>

             <div class="form-group">
                <div class="col-md-7">
                  <label class="col-md-4 control-label" for=
                  "CustomerContact"></label>

                  <div class="col-md-8">
                         <input type="submit" value="Save" name="save" class="btn btn-primary py-3 px-5">
                  </div>
                </div>
              </div>


          </div>
           </form>

        </div><!--/col-sm-9-->
    </div><!--/row-->
  </div><!--/contanier-->
          </section>




          <!-- end: page -->
        </section>
		<?php }
else{	echo '<script>window.location="login.php"</script>';} ?>
      </div>

      <?php include 'template/right-bar.php'; ?>

    <?php include 'template/script-res.php'; ?>
  </body>
</html>



<div class="modal fade" id="logomodal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal" type=
                                    "button">x</button>

                                    <h4 class="modal-title" id="myModalLabel">Image.</h4>
                                </div>

                                <form action="profile.php" enctype="multipart/form-data" method="post">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="rows">
                                                <div class="col-md-12">
                                                    <div class="rows">
                                                        <div class="col-md-8">
                                                            <input name="MAX_FILE_SIZE" type="hidden"
                                                              value="1000000">
                                                              <input id="image" name="image" type="file">
                                                        </div>

                                                        <div class="col-md-4"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-default" data-dismiss="modal" type=
                                        "button">Close</button> <button class="btn btn-primary"
                                        name="savephoto" type="submit">Upload Photo</button>
                                    </div>
                                </form>
                            </div><!-- /.modal-content-->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

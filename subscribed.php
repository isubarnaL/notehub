<!-- index.php -->
<?php include 'template/header.php'; ?>
    <body id="page-top">
          <?php include 'template/nav-bar.php'; ?>
    <!-- END nav -->
	
         <?php //include 'masthead.php'; ?>
        <!-- About-->
		 <section class="projects-section bg-black">
            <div class="container">
			<center>   <h1 class="text-white">Thank You for Subscribing to Us.</h1><br><p class="text-white">You'll receive an update when new notes are uploaded.</p>
			<a href="javascript:history.back()" class="btn btn-outline-danger"><i class="fa fa-backward" aria-hidden="true"></i> Go Back</a></center>
			
			 <div class="row justify-content-center no-gutters">
                    <div class="col-lg-6 order-lg-first">
                        <div class="bg-black text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-center">
                                    <h4 class="text-white">PUBLISH YOUR NOTES</h4>
                                    <p class="mb-0 text-white-50">If you want to publish your notes here, please <a class="nav-link js-scroll-trigger" href="#contact">contact</a> us.</p>
                                    <hr class="d-none d-lg-block mb-0 mc-0" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
       </div>
</section>
    <?php //include 'note-project.php'; ?>
        <!-- Signup-->
    <?php include 'template/about.php'; ?>
	<?php //include 'template/subscribe.php';?>
        <!-- Contact-->
  <?php include 'template/footer.php'; ?>

  <?php include 'template/script.php'; ?>
  
    </body>
</html>
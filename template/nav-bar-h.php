<!-- nav-bar.php -->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">Notehub</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" onclick="_toggleMenuIcon()">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#projects">Search Notes</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contact</a></li>
					<?php if(!isset($_SESSION['isLoggedIn'])){ ?>
						<li class="nav-item"><a class="nav-link" href="login.php" target="_blank">Login</a></li>
						<?php }
						elseif (isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 2) { ?>
	        <li class="nav-item" style="text-transform:capitalize;"><a href="logout.php" class="nav-link">Hey <?php echo $_SESSION['name']; ?>, Logout?</a></li><!--<center><i class="fa fa-user" aria-hidden="true"></i></center>-->
	        <?php }
						elseif (isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 1) { ?>
	        <li class="nav-item" style="text-transform:capitalize;"><a href="logout.php" class="nav-link">Hey <?php echo $_SESSION['name']; ?>, Logout?</a></li>
			<li class="nav-item" style="text-transform:capitalize;"><a href="dashboard/profile.php" class="nav-link">Profile <i class="fa fa-user" aria-hidden="true"></i></a></li><!--<center><i class="fa fa-user" aria-hidden="true"></i></center>-->
	        <?php } ?>
						
                    </ul>
                </div>
            </div>
        </nav>

<aside id="sidebar-left" class="sidebar-left">
				
	<div class="sidebar-header">
		<div class="sidebar-title">
			Navigation
		</div>
		<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
			<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
		</div>
	</div>

	<div class="nano">
		<div class="nano-content">
			<nav id="menu" class="nav-main" role="navigation">
				<ul class="nav nav-main">
				<?php if((isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 1)){ ?>
					<li class="nav-active">
						<a href="index.php" >
							<i class="fa fa-home" aria-hidden="true"></i>
							<span>Dashboard</span>
						</a>
					</li>
					<?php } ?>
					<?php if((isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 2)){ ?>
					<li class="nav-active">
						<a href="#" >
							<i class="fa fa-home" aria-hidden="true"></i>
							<span>Dashboard</span>
						</a>
					</li>
					<?php } ?>
					<?php if((isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 1)){ ?>
					<li class="nav-parent">
						<a>
							<i class="fa fa-university" aria-hidden="true"></i>
							<span>University</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a href="university-add.php">
									<span class="pull-right label label-primary">add</span>
									<i class="fa fa-plus-square" aria-hidden="true"></i>
									<span>University</span>
								</a>
							</li>
							<li>
								<a href="university-list.php">
									<span class="pull-right label label-info">list</span>
									<i class="fas fa-list-ul" aria-hidden="true"></i>
									<span>University</span>
								</a>
							</li>
						</ul>
					</li>
					<?php } ?>
					
				<!--	<?php //if((isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 1)){ ?>
					<li class="nav-parent">
						<a>
							<i class="fas fa-tablets" aria-hidden="true"></i>
							<span>College</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a href="college-add.php">
									<span class="pull-right label label-primary">add</span>
									<i class="fa fa-plus-square" aria-hidden="true"></i>
									<span>College</span>
								</a>
							</li>
							<li>
								<a href="view-college-list.php">
									<span class="pull-right label label-info">list</span>
									<i class="fas fa-list-ul" aria-hidden="true"></i>
									<span>College</span>
								</a>
							</li>
						</ul>
					</li>
					<?php //} ?>
					-->
										
					<?php if((isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 1)){ ?>
					<li class="nav-parent">
						<a>
							<i class="fa fa-book" aria-hidden="true"></i>
							<span>Subject</span>
						</a>
						<ul class="nav nav-children">
							<!--<li>
								<a href="subject-add.php">
									<span class="pull-right label label-primary">add</span>
									<i class="fa fa-plus-square" aria-hidden="true"></i>
									<span>Subject</span>
								</a>
							</li>-->
							<li>
								<a href="subject-list.php">
									<span class="pull-right label label-info">list</span>
									<i class="fas fa-list-ul" aria-hidden="true"></i>
									<span>Subject</span>
								</a>
							</li>
						</ul>
					</li>
					<?php } ?>
										
					<?php if((isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 1)){ ?>
					<li class="nav-parent">
						<a>
							<i class="fa fa-users" aria-hidden="true"></i>
							<span>Notemaker</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a href="notemaker-add.php">
									<span class="pull-right label label-primary">add</span>
									<i class="fa fa-plus-square" aria-hidden="true"></i>
									<span>Notemaker</span>
								</a>
							</li>
							<li>
								<a href="notemaker-list.php">
									<span class="pull-right label label-info">list</span>
									<i class="fas fa-list-ul" aria-hidden="true"></i>
									<span>Notemaker</span>
								</a>
							</li>
						</ul>
					</li>
					<?php } ?>
					
					
				<!--	
					<?php //if((isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 1)){ ?>
					<li class="nav-parent">
						<a>
							<i class="fas fa-utensils-alt" aria-hidden="true"></i>
							<span>Menu Item</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a href="menu-add.php">
									<span class="pull-right label label-primary">add</span>
									<i class="fa fa-plus-square" aria-hidden="true"></i>
									<span>Menu</span>
								</a>
							</li>
							<li>
								<a href="menu-list.php">
									<span class="pull-right label label-info">list</span>
									<i class="fas fa-list-ul" aria-hidden="true"></i>
									<span>Menu</span>
								</a>
							</li>
						</ul>
					</li>
					<?php// } ?>
					<?php //if((isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 1)){ ?>
					<li class="nav-parent">
						<a>
							<i class="fas fa-money-check-alt" aria-hidden="true"></i>
							<span>Booking</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a href="booking-list.php">
									<span class="pull-right label label-info">list</span>
									<i class="fas fa-list-ul" aria-hidden="true"></i>
									<span>Booking</span>
								</a>
							</li>
						</ul>
					</li>
					<?php// } ?> 
					<?php// if((isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 1)){ ?>
					<li class="nav-parent">
						<a>
							<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
							<span>Add notes</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a href="reg.php">
									<span class="pull-right label label-info">list</span>
									<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
									<span>Add Notes</span>
								</a>
							</li>
						</ul>
					</li>
					<?php // } ?> -->
															
					<?php if((isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 1)){ ?>
					<li class="nav-parent">
						<a>
							<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
							<span>Notes</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a href="reg.php">
									<span class="pull-right label label-primary">add</span>
									<i class="fa fa-plus-square" aria-hidden="true"></i>
									<span>Add notes</span>
								</a>
							</li>
							<li>
								<a href="note-list.php">
									<span class="pull-right label label-info">list</span>
									<i class="fas fa-list-ul" aria-hidden="true"></i>
									<span>View Note</span>
								</a>
							</li>
						</ul>
					</li>
					<?php } ?>
					
					<?php if((isset($_SESSION['isLoggedIn']) && $_SESSION['role'] == 1)){ ?>
					<li class="nav-parent">
						<a>
							<i class="fa fa-envelope-o" aria-hidden="true"></i>
							<span>Email Subscribers</span>
						</a>
						<ul class="nav nav-children">
							<!--<li>
								<a href="subject-add.php">
									<span class="pull-right label label-primary">add</span>
									<i class="fa fa-plus-square" aria-hidden="true"></i>
									<span>Subject</span>
								</a>
							</li>-->
							<li>
								<a href="subs-list.php">
									<span class="pull-right label label-info">list</span>
									<i class="fas fa-list-ul" aria-hidden="true"></i>
									<span>Subscribers</span>
								</a>
							</li>
						</ul>
					</li>
					<?php } ?>
					
					
				
				</ul>
			</nav>

			<hr class="separator" />
		</div>

	</div>

</aside>
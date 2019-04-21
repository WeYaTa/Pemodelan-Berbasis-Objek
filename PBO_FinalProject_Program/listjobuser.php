	
			<!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								User's Current Posted Job List				
							</h1>	
							<p class="text-white link-nav"><a href="index.php">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="listjobuser.php"> User's Current Posted Job List</a></p>
						</div>											
					</div>
				</div>
			</section>
			<!-- End banner Area -->	
				
			<!-- Start post Area -->

			<!-- First Job -->
			<section class="post-area section-gap">
				<div class="container">
				<?php
							foreach($_SESSION['user']->posted_jobs as $item){
								echo "
								<div class='row justify-content-center d-flex'>
								<div class='col-lg-8 post-list'>
									<div class='single-post d-flex flex-row'>
										<div class='thumb'>
											<img src='img/creative_art_designer.png' alt='' width='80' height='80'>
										</div>
										<div class='details'>
											<div class='title d-flex flex-row justify-content-between'>
												<div class='titles'>
													<a href='#'><h4>$item->category</h4></a>
												</div>
												<ul class='btns'>
													<li><a href='#'><span class='lnr lnr-heart'></span></a></li>
													<li><a href='controller.php?action=finishjob&id-$item->id'>Finish Job</a></li>
												</ul>
											</div> <br> <br>
											<p>
												$item->description
											</p>
											<h5>Job Nature: Full time</h5>
											<!-- <p class='address'><span class='lnr lnr-map'></span> 56/8, Panthapath Dhanmondi Dhaka</p> -->
											<p class='address'><span class='lnr lnr-database'></span>$item->budget</p>
								</div>
								";
							}
					?>
						

						
		
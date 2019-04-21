	
			<!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row fullscreen d-flex align-items-center justify-content-center">
						<div class="banner-content col-lg-12">
							<h1 class="text-white"> <br><br><br>
								<span>1500+</span> Jobs posted last week				
							</h1>	
							<form action="search.php" class="serach-form-area">
								<div class="row justify-content-center form-wrap">
									<div class="col-lg-4 form-cols">
										<input type="text" class="form-control" name="search" placeholder="what are you looging for?">
									</div>
									<div class="col-lg-3 form-cols">
										<div class="default-select" id="default-selects"">
											<select>
												<option value="1">Select area</option>
												<option value="2">Dhaka</option>
												<option value="3">Rajshahi</option>
												<option value="4">Barishal</option>
												<option value="5">Noakhali</option>
											</select>
										</div>
									</div>
									<div class="col-lg-3 form-cols">
										<div class="default-select" id="default-selects2">
											<select>
												<option value="1">All Category</option>
												<option value="2">Medical</option>
												<option value="3">Technology</option>
												<option value="4">Goverment</option>
												<option value="5">Development</option>
											</select>
										</div>										
									</div>
									<div class="col-lg-2 form-cols">
									    <button type="button" class="btn btn-info">
									      <span class="lnr lnr-magnifier"></span> Search
									    </button>
									</div>								
								</div>
							</form>	
							<p class="text-white"> <span>Search by tags:</span> Tecnology, Business, Consulting, IT Company, Design, Development</p>
						</div>											
					</div>
				</div>
			</section>
			<!-- End banner Area -->	
			
			<!-- Start feature-cat Area -->
			<section class="feature-cat-area pt-100" id="category">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-60 col-lg-10">
							<div class="title text-center">
								<h1 class="mb-10">Featured Job Categories</h1>
								<p>Who are in extremely love with eco friendly system.</p>
							</div>
						</div>
					</div>						
					<div class="row">
						<div class="col-lg-2 col-md-4 col-sm-6">
							<div class="single-fcat">
								<a href="controller.php?param=home&topic=graphic">
									<img src="img/o1.png" alt="">
								</a>
								<p>Graphic Designer</p>
							</div>
						</div>
						
						<div class="col-lg-2 col-md-4 col-sm-6">
							<div class="single-fcat">
								<a href="controller.php?param=home&topic=director">
									<img src="img/o3.png" alt="">
								</a>
								<p>Creative/Art Director</p>
							</div>
						</div>
						<div class="col-lg-2 col-md-4 col-sm-6">
							<div class="single-fcat">
								<a href="controller.php?param=home&topic=scriptwriter">
									<img src="img/o4.png" alt="">
								</a>
								<p>Scriptwriter</p>
							</div>
						</div>
						<div class="col-lg-2 col-md-4 col-sm-6">
							<div class="single-fcat">
								<a href="controller.php?param=home&topic=screenwriter">
									<img src="img/o5.png" alt="">
								</a>
								<p>Screenwriter</p>
							</div>
						</div>
						<div class="col-lg-2 col-md-4 col-sm-6">
							<div class="single-fcat">
								<a href="controller.php?param=home&topic=website">
									<img src="img/o6.png" alt="">
								</a>
								<p>Website Developer</p>
							</div>			
						</div>																											
						<div class="col-lg-2 col-md-4 col-sm-6">
							<div class="single-fcat">
								<a href="controller.php?param=home&topic=software">
									<img src="img/o6.png" alt="">
								</a>
								<p>Software Developer</p>
							</div>			
						</div>																											
					</div>
				</div>	
				<br><br><br><br>
			</section>
			<!-- End feature-cat Area -->
			<section class="post-area section-gap">
				<div class="container">
					<div class="row justify-content-left d-flex">
	<?php
		if(isset($_GET['topic'])){
			if(isset($_SESSION['user']))
			$jobs = $_SESSION['user']->getAllJobs();
			if(isset($_SESSION['fl']))
			$jobs = $_SESSION['fl']->getAllJobs();
			$filter = array();
			switch($_GET['topic']){
				case "graphic" :
					foreach($jobs as $item){
						if($item->category == "Graphic Designer") array_push($filter,$item);
					}
				break;
				case "director" :
					foreach($jobs as $item){
						if($item->category == "Creative/Art Director") array_push($filter,$item);
					}
				break;
				case "scriptwriter" :
					foreach($jobs as $item){
						if($item->category == "Scriptwriter") array_push($filter,$item);
					}
				break;
				case "screenwriter" :
					foreach($jobs as $item){
						if($item->category == "Screenwriter") array_push($filter,$item);
					}
				break;
				case "website" :
					foreach($jobs as $item){
						if($item->category == "Website Developer") array_push($filter,$item);
					}
				break;
				case "software" :
					foreach($jobs as $item){
						if($item->category == "Software Developer") array_push($filter,$item);
					}
				break;
			}

			foreach($filter as $item){
				echo "
					<div class='col-lg-12 post-list'>
					<div class='single-post d-flex flex-row'>
						<div class='thumb'>
							<img src='img/creative_art_designer.png' alt='' width='80' height='80'>
						</div>
						<div class='details'>
							<div class='title d-flex flex-row justify-content-between'>
								<div class='titles'>
									<a href='#'><h4>$item->category</h4></a>
								</div>
								<ul class='btns' style='text-align:left;'>
									<li><a href='#'><span class='lnr lnr-heart'></span></a></li>
									<li><a href='controller.php?param=home&action=takejob&job_id=$item->id'>Take Job</a></li>
								</ul>
							</div> <br> <br>
							<p>
								$item->description 
							</p>
							<h5>Job By: $item->user_id</h5>
							<h5>Taken/Accepted By: $item->fl_id</h5>
							<!-- <p class='address'><span class='lnr lnr-map'></span> 56/8, Panthapath Dhanmondi Dhaka</p> -->
							<p class='address'><span class='lnr lnr-database'></span>$item->budget</p>
						</div>
					</div>
				";
			}
		}
	?>
			</div>
			</div>
			</section>




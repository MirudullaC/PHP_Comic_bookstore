<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Login</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="../assets/css/all.min.css">
	<!-- bootstrap -->
	<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
	<!-- owl carousel -->
	<link rel="stylesheet" href="../assets/css/owl.carousel.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="../assets/css/magnific-popup.css">
	<!-- animate css -->
	<link rel="stylesheet" href="../assets/css/animate.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="../assets/css/meanmenu.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="../assets/css/main.css">
	<!-- responsive -->
	<link rel="stylesheet" href="../assets/css/responsive.css">
</head>
<body>
	<!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->
	
	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="index.html">
								<img src="../assets/img/logo_comic.png" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li class="current-list-item"><a href="index.php">Home</a></li>	
								<li><a href="shop.php">Shop</a></li>
								<li><a href="cart.html">Cart</a></li>
								<li><a href="checkout.php">Check Out</a></li>
								<li><a href="contact.php">Contact</a></li>
								<li><a href="signup.php">Sign up</a></li>
								<li><a href="login.php">Login</a></li>
								<li>
									<div class="header-icons">
										<a class="shopping-cart" href="cart.html"><i class="fas fa-shopping-cart"></i></a>
										<a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
									</div>
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->

	<!-- search area -->
	<div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<h3>Search For:</h3>
							<input type="text" placeholder="Keywords">
							<button type="submit">Search <i class="fas fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end search arewa -->
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Comics that ignite your imagination</p>
						<h1>Login Here!!!</h1>
					</div>
				</div> 
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

    <div class="contact-from-section mt-150 mb-150">
		<div class="container">
			<div class="row">
                <div class="col-lg-8">
				   <?php
                        require_once("loginInfo.php");
                        $errors=[];
                        if($_SERVER["REQUEST_METHOD"]=="POST")
                        {
                            if(empty($_POST["email"]))
                                $errors["email"]="<p style='color:red'>Email field can not be empty</p>";
                            if(empty($_POST["password"]))
                                $errors["password"]="<p style='color:red'>Password field can not be empty</p>"; 
                            if(count($errors)==0)
                            {
                                $email=trim(htmlspecialchars($_POST["email"]));
                                $password=trim(htmlspecialchars($_POST["password"]));
                                if(login($email,$password))
                                {
                                
                                    echo "<h3>Login successfull</h3>";
                                }
                                else
                                {
                                    
                                    echo "<h3>Login Fail</h3>";
                                }
                            }
                        }
                    ?> 

					<div id="collapseThree" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="billing-address-form">
								<form method="POST">
                                    <p>
            							<input type="text" id="email" name="email" placeholder="Email" value="<?php echo isset($email) ? $email : ''; ?>"  />
            							<?php echo $errors["email"] ?? "" ?> 
									</p>
                                    <p>
            							<input type="password" id="password"  name="password"  placeholder="Password"  />
          								<?php echo $errors["password"] ?? "" ?> 
									</p>
                                    <p>
										<input type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4" value="Login">
									</p>                                                                                       
                                </form>
                            </div>
                        </div>
                    </div>
			    </div>

				<div class="col-lg-4">
                    <div class="order-details-wrap">
                       <img src="images/Comic-books.jpg" alt="comic books" title="Comic books"/>
                    </div>
                </div>
    	    </div>
  	    </div>	
	</div>

    <div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">About us</h2>
						<p>Discover a universe of heroes and villains at Comic Store. Explore our vast collection of comics, graphic novels, and collectibles. Unleash your inner hero with us!</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">Get in Touch</h2>
						<ul>
							<li>458 Albert Street, Kitchener, Ontario.</li>
							<li>support@comicstore.com</li>
							<li>+00 111 222 3333</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box pages">
						<h2 class="widget-title">Pages</h2>
						<ul>
							<li><a href="index.php">Home</a></li>	
							<li><a href="shop.php">Shop</a></li>
							<li><a href="cart.html">Cart</a></li>
							<li><a href="checkout.php">Check Out</a></li>
							<li><a href="contact.php">Contact</a></li>	
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title">Subscribe</h2>
						<p>Subscribe to our mailing list to get the latest updates.</p>
						<form action="index.html">
							<input type="email" placeholder="Email">
							<button type="submit"><i class="fas fa-paper-plane"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end footer -->
	
	<!-- copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<p>Copyrights &copy; 2023 - <a href="#">CodeSquad</a>,  All Rights Reserved.</p>
				</div>
				<div class="col-lg-6 text-right col-md-12">
					<div class="social-icons">
						<ul>
							<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end copyright -->
	
	<!-- jquery -->
	<script src="../assets/js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- count down -->
	<script src="../assets/js/jquery.countdown.js"></script>
	<!-- isotope -->
	<script src="../assets/js/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<script src="../assets/js/waypoints.js"></script>
	<!-- owl carousel -->
	<script src="../assets/js/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<script src="../assets/js/jquery.magnific-popup.min.js"></script>
	<!-- mean menu -->
	<script src="../assets/js/jquery.meanmenu.min.js"></script>
	<!-- sticker js -->
	<script src="../assets/js/sticker.js"></script>
	<!-- main js -->
	<script src="../assets/js/main.js"></script>

</body>
</html>
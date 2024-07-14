<?php
require_once ("../Sandhya/db/DBHelper.php");
require_once("user.php");

$dbHelper= new DBHelper();
$provinces = $dbHelper-> getProvinces();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Registration</title>

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
						<h1>Registration</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!---Registration---------->
	<div class="contact-from-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 mb-5 mb-lg-0">
				 	<div class="wrapper">
						<?php
							if($_SERVER["REQUEST_METHOD"]=="POST")
							{
								if(empty($_POST["firstname"]))
								$errors[]="<p>Please enter your First name</p>";
								else 
								 $firstName= htmlspecialchars($_POST["firstname"]);
								 
							   if(empty($_POST["lastname"]))
								$errors[]="<p>Please enter your Last name</p>";
								else
								$lastName=htmlspecialchars($_POST["lastname"]);
							
								if(empty($_POST["phone"]))
								$errors[]="<p>Please enter your phone number</p>";
								elseif(!preg_match("/^[0-9]{10}$/",$_POST["phone"]))
								$errors[]="<p>Invalid phone number</p>";
								else
								$phone=htmlspecialchars($_POST["phone"]);
							
								if(empty($_POST["dob"]))
								$errors[]="<p>Please enter the Date of birth</p>";
								else
								{
									$dob=$_POST["dob"];
									$dob_check=explode('-',$dob);
									if(count($dob_check)==3)
									{
										$year=(int)$dob_check[0];
										$month=(int)$dob_check[1];
										$day=(int)$dob_check[2];
																			
									if(checkdate($month,$day,$year)){
									   $DOB= htmlspecialchars($_POST["dob"]);
									}
									else{
										 $errors[]="<p>Invalid date of birth</p>";
										 }
									}
									else
									$errors[]="<p>Invalid date of birth</p>";
								}
								
								if(empty($_POST["email"]))
								$errors[]="<p>Please enter the email</p>";
								else if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL))
								$errors[]="<p>Email is invalid</p>";
								else
								$email=htmlspecialchars($_POST["email"]);							
								
								if(empty($_POST["postalcode"]))
								$errors[]="<p>Please enter your postalcode</p>";
								else
								$postalCode=htmlspecialchars($_POST["postalcode"]);
							
								if(empty($_POST["address"]))
								$errors[]="<p>Please enter your address</p>";
								else
								$addr1=htmlspecialchars($_POST["address"]);
							
								if (empty($_POST["province"]) || $_POST["province"] == "Select Province") 
								$errors[] = "<p>Please select a province</p>";
								else
								$provinceId=htmlspecialchars($_POST["province"]);
							
								if(empty($_POST["city"]))
								$errors[]="<p>Please enter your city</p>";
								else
								$city=htmlspecialchars($_POST["city"]);

								if(empty($_POST["password"]))
								$errors[]="<p>Please enter your password</p>";
								else
								$password=htmlspecialchars($_POST["password"]);
								
								if(isset($errors))
								{
									foreach($errors as $e)
									echo $e;
								}
								else
								{
									$result=user::insertUser($firstName, $lastName, $email, $DOB, $password, $phone, $addr1, $city, $provinceId, $postalCode);								
								}								
							}
						?>							
						<div class="contact-form">
							<form method="POST" id="fruitkha-contact" action="">
								<p>
									<input type="text" placeholder="First Name" name="firstname" id="firstname" value="<?php echo isset($firstName) ? $firstName : '';?>">&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="text" placeholder="Last Name" name="lastname" id="lastname" value="<?php echo isset($lastName) ? $lastName : ''; ?>">
								</p>
								 <p>
									<input type="text" placeholder="Date of birth (yyyy-mm-dd)" name="dob" id="dob" value="<?php echo isset($DOB) ? $DOB : ''; ?>">&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="text" placeholder="Email" name="email" id="email" value="<?php echo isset($email) ? $email : ''; ?>">
								</p>
								<p>
									<input type="text" placeholder="Phone" name="phone" id="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="password" placeholder="Password" name="password" id="password" value="<?php echo isset($password) ? $password : ''; ?>">
								</p>
						        <p>
									<select name="province" id="province">
										<option value="">Select Province</option>
										<?php foreach ($provinces as $province): ?>
											<option value="<?php echo $province['provinceId']; ?>">
											<?php echo $province['provinceName']; ?></option>
										<?php endforeach; ?>
									</select>&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="text" placeholder="City" name="city" id="city" value="<?php echo isset($city) ? $city : ''; ?>">
								</p>
								<p>
									<input type="text" placeholder="Address" name="address" id="address" value="<?php echo isset($addr1) ? $addr1 : ''; ?>">&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="text" placeholder="Postal code" name="postalcode" id="postalcode" value="<?php echo isset($postalCode) ? $postalCode : ''; ?>">			
								</p>
								<p><input type="submit" value="Submit"></p>
							</form>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-----------End registration----------------->
	
	<!-- footer -->
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

<?php
require_once ("cartInfo.php");
require_once ("db/DBHelper.php");

// $cartInfo1 = new CartInfo(0, 1, 1, 100, 'Spider-Man: The Amazing Spider-Man Vol. 1', 12.99, 'spiderman_vol1.jpeg');
// $cartInfo2 = new CartInfo(0, 1, 2, 75, 'Batman: The Dark Knight Returns', 14.99, 'dark_knight_returns.jpeg');

// CartInfo::addTempCartItem($cartInfo1);
// CartInfo::addTempCartItem($cartInfo2);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//handles update form 
	if (isset($_POST['update_quantity'])) {

		$cartId = htmlspecialchars($_POST['cartId']);
		$quantity = htmlspecialchars($_POST['quantity']);
		//if user logged in, use data from DB
		if (isset($_SESSION['userID'])) {
			$resultUpdate = CartInfo::updateCartQuantity($_SESSION['userID'], $cartId, $quantity);
			if ($resultUpdate !== "success") {
				$errors = $resultUpdate;
			}
		} 
		//else use temporary cart data
		else {
			CartInfo::updateTempCartQuantity($cartId, $quantity);
		}
	}
	//handles delete form
	if (isset($_POST['delete_item'])) {

		$cartID = htmlspecialchars($_POST['cartID']);
		//if user logged in, use data from DB
		if (isset($_SESSION['userID'])) {
			$resultDelete = CartInfo::deleteCartItem($_SESSION['userID'], $cartID);
			if ($resultDelete !== "success") {
				$errors = $resultDelete;
			}
		} 
		//else use temporary cart data
		else {
			CartInfo::removeTempCartItem($cartID);
		}
	}
}
//if user logged in, use data from DB
if (isset($_SESSION['userID'])) {
	$cartInfo = CartInfo::getCartDetails(1);
} 
//else use temporary cart data
else {
	$cartInfo = CartInfo::getTempCartItems();
}
$subTotal = 0;
$shipping = 0;
foreach ($cartInfo as $item) {
	$subTotal += $item->getQuantity() * $item->getPrice();
}
$shipping = $subTotal * .05;
$total = $subTotal + $shipping;

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description"
		content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Cart</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png" title="icon image">
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
								<img src="../assets/img/logo_comic.png" alt="logo image">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li class="current-list-item"><a href="index.php">Home</a></li>
								<li><a href="shop.php">Shop</a></li>
								<li><a href="../Sandhya/cart.php">Cart</a></li>
								<li><a href="checkout.php">Check Out</a></li>
								<li><a href="contact.php">Contact</a></li>
								<li><a href="login.php">Login</a></li>
								<li>
									<div class="header-icons">
										<a class="shopping-cart" href="cart.html"><i
												class="fas fa-shopping-cart"></i></a>
										<a class="mobile-hide search-bar-icon" href="#"><i
												class="fas fa-search"></i></a>
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
						<h1>Cart</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- cart -->
	<div class="cart-section mt-150 mb-150">
		<div class="container">
			<?php
			if (isset($errors)) { ?>
				<div class="alert alert-danger" role="alert">

					<?php echo $errors; ?>

				</div>
			<?php }
			?>
			<div class="row">
				<div class="col-lg-8 col-md-12">

					<div class="cart-table-wrap">
						<table class="cart-table">
							<thead class="cart-table-head">
								<tr class="table-head-row">
									<th class="product-remove"></th>
									<th class="product-image">Book Image</th>
									<th class="product-name">Book Name</th>
									<th class="product-price">Price</th>
									<th class="product-quantity">Quantity</th>
									<th class="product-total">Total</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($cartInfo as $index => $item) { ?>
									<tr class="table-body-row">
										<td class="product-remove">
											<form method="POST" action="">
												<!-- if user not logged in , then set index of the item as the value of hidden input field -->
												<input type="hidden" name="cartID"
													value="<?php if ($item->getCartId() != 0)
														echo $item->getCartId();
													else
														echo $index; ?>">
												<button type="submit" name="delete_item" title="Remove from cart"
													class="btn btn-transparent border-0"><i
														class="fa fa-window-close"></i></button>
											</form>
										</td>
										<td class="product-image"><img
												src="../assets/img/products/<?php echo $item->getImgUrl(); ?>" alt=""></td>
										<td class="product-name"><?php echo $item->getBookTitle(); ?></td>
										<td class="product-price">$<?php echo $item->getPrice(); ?></td>
										<td class="product-quantity">
											<form method="POST" action="">
												<!-- if user not logged in , then set index of the item as the value of hidden input field -->
												<input type="hidden" name="cartId"
													value="<?php if ($item->getCartId() != 0)
														echo $item->getCartId();
													else
														echo $index; ?>">

												<input type="number" name="quantity" min="1"
													value="<?php echo $item->getQuantity(); ?>">
												<button type="submit" name="update_quantity" title="Update item quantity"
													class="btn btn-transparent border-0"><i
														class="fa fa-check"></i></button>

											</form>
										</td>
										<td class="product-total">$<?php echo $item->getQuantity() * $item->getPrice(); ?>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="total-section">
						<table class="total-table">
							<thead class="total-table-head">
								<tr class="table-total-row">
									<th>Total</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody>
								<tr class="total-data">
									<td><strong>Subtotal: </strong></td>
									<td>$<?php echo $subTotal; ?></td>
								</tr>
								<tr class="total-data">
									<td><strong>Shipping: </strong></td>
									<td>$<?php echo $shipping; ?></td>
								</tr>
								<tr class="total-data">
									<td><strong>Total: </strong></td>
									<td>$<?php echo $total; ?></td>
								</tr>
							</tbody>
						</table>
						<div class="cart-buttons">
							<?php
							// Check if the userID session variable exists
							if (isset($_SESSION['userID'])) {
								// Include userID in the URL as a query parameter
								$checkoutURL = "../Aleena/checkout.php" . $_SESSION['userID'];
								?>
								<!-- Redirect to the checkout page -->
								<a href="<?php echo $checkoutURL; ?>" class="boxed-btn black">Check Out</a>
							<?php } else {
								// else display button Login to Checkout
								?>
								<a href="../Aleena/login.php" class="boxed-btn black">Log in to Check Out</a>
							<?php } ?>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- end cart -->



	<!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">About us</h2>
						<p>Discover a universe of heroes and villains at Comic Store. Explore our vast collection of
							comics, graphic novels, and collectibles. Unleash your inner hero with us!</p>
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
					<p>Copyrights &copy; 2023 - <a href="#">CodeSquad</a>, All Rights Reserved.</p>
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

<?php

session_start();

// Require necessary files
require_once("checkoutInfo.php");
require_once("../Sandhya/db/DBHelper.php");
require_once("../Sandhya/cartInfo.php");
 DBHelper::initializeDatabase();
// // Check if the user is not logged in, then redirect to signup page
 if (!isset($_SESSION['userID'])) {
    $_SESSION['userID'] = 1;
//     header("Location: signup.php");
//     exit;
 }

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Validate form fields
     $errors = [];

     // Validate Cardholder's Name
     if (empty($_POST['cardholder_name'])) {
         $errors[] = "Cardholder's Name is required.";
     }
 
     // Validate Card Number
     if (empty($_POST['card_number'])) {
         $errors[] = "Card Number is required.";
     }
 
     // Validate Expiration Date
     if (empty($_POST['expiration_date'])) {
         $errors[] = "Expiration Date is required.";
     }
 
     // Validate CVV
     if (empty($_POST['cvv'])) {
         $errors[] = "CVV is required.";
     }
 
     // Validate Address
     if (empty($_POST['address'])) {
         $errors[] = "Address is required.";
     }
 
     // Validate Postal/ZIP Code
     if (empty($_POST['postal_code'])) {
         $errors[] = "Postal/ZIP Code is required.";
     }
 
     // Validate Payment Type
     if (empty($_POST['payment_type'])) {
         $errors[] = "Payment type is required.";
     }
 
     // If there are validation errors, display them
     if (!empty($errors)) {
         $errorMessage = implode("<br>", $errors);
     } else {

    // Insert data into order and payment tables
    $orderId = generateOrderId(); 
    $userId = $_SESSION['userID'] = 1;
    $amount = calculateTotalAmount($cartInfo); 
    $paymentType = $_POST['payment_type']; 
    $status = 'Pending'; // Initial status for the payment
    $orderUpdate = CartInfo::insertOrder($userId, $orderId, $bookId, $quantity);
    if ($orderUpdate === "success") {
        $paymentUpdate = CartInfo::insertPayment($orderId, $amount, $paymentType, $status);
        if ($paymentUpdate === "success") {
            // Display success message
            $successMessage = "Order placed successfully!";
        } else {
            $errorMessage = "Failed to insert payment data!";
        }
    } else {
        $errorMessage = "Failed to insert order data!";
    }
}
}

// Retrieve cart items
// Retrieve cart items
if (isset($_SESSION['userID'])) {
    echo "hello"; // Check if this gets printed
    $cartInfo = CheckoutInfo::getCartDetails($_SESSION['userID']);
    echo "<pre>";
    print_r($cartInfo); // Echo out the cart items for debugging
    echo "</pre>";
} else {
    // $cartInfo = CheckoutInfo::getTempCartItems();
}


// Calculate subtotal, shipping, and total
$subTotal = 0;
foreach ($cartInfo as $item) {
    $subTotal += $item->getQuantity() * $item->getPrice();
}
$shipping = $subTotal * 0.05;
$total = $subTotal + $shipping;

// Function to generate a unique order ID

function generateOrderId() {
    // Generate a unique order ID 
    return uniqid('ORDER');
}

// Function to calculate total amount
function calculateTotalAmount($cartInfo) {
    // Initialize total amount
    $totalAmount = 0;

    // Calculate total amount by summing up the price * quantity of each item
    foreach ($cartInfo as $item) {
        $totalAmount += $item->getPrice() * $item->getQuantity();
    }

    // Assuming there's a shipping charge of 5% of the total amount
    $shippingCharge = $totalAmount * 0.05;

    // Add shipping charge to the total amount
    $totalAmount += $shippingCharge;

    return $totalAmount;
}


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
    <title>Checkout</title>

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
                                <img src="assets/img/logo_comic.png" alt="">
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
                        <h1>Checkout</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- check out section -->
    <div class="checkout-section mt-150 mb-150">
        <div class="container">
                        <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-accordion-wrap">
                        <div class="accordion" id="accordionExample">
                            <div class="card single-accordion">

                            </div>

                            <div class="card single-accordion">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            Billing Details
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse show" aria-labelledby="headingThree"
                                    data-parent="#accordionExample">
                                    <!-- card details form -->
                                    <div class="card-body">
                                        <div class="billing-address-form">
                                            <form method="POST" action="">
                                                <p><input type="text" placeholder="Cardholder's Name"></p>
                                                <p><input type="text" placeholder="Card Number"></p>
                                                <p><input type="text" placeholder="Expiration Date"></p>
                                                <p><input type="text" placeholder="CVV"></p>
                                                <p><input type="text" placeholder="Address"></p>
                                                <p><input type="text" placeholder="Postal/ZIP Code"></p>
                                                <p><input type="text" name="payment_type" placeholder="Credit/Debit"></p>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>


                </div>
           <div class="col-lg-4">
    <div class="order-details-wrap">
        <table class="order-details">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody class="order-details-body">
                <?php foreach ($cartInfo as $item): ?>
                    <tr>
                        <td>$<?php echo $item->getBookTitle(); ?></td>
                        <td>$<?php echo $item->getPrice(); ?></td>
                        <td> $<?php echo $item->getQuantity(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tbody class="checkout-details">
                <tr>
                    
                    <td>Subtotal</td>
                    <td>$<?php echo $subTotal; ?></td>
                </tr>
            </tbody>
        </table>
        <a href="#" class="boxed-btn">Place Order</a>
    </div>
</div>


            </div>
        </div>
    </div>

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

<?php
// Include the Product class
require_once ("productinfo.php");
require_once ("category.php");
// require_once ("cartInfo.php");
// Fetch all products
$products = Product::getAllProducts();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    // Retrieve product information from the form
    $bookId = htmlspecialchars($_POST['bookId']);
    $imgUrl = htmlspecialchars($_POST['imgUrl']);
    $bookTitle = htmlspecialchars($_POST['bookTitle']);
    $price = htmlspecialchars($_POST['price']);

}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $categoryId = $_GET['categoryName'];
    // Fetch products based on the selected category
    if (!empty($_GET['categoryName'])) {
        // If a category is selected, fetch products for that category

        if ($categoryId == 0) {
            $products = Product::getAllProducts();
        } else {
            $products = Product::getProductsByCategory($categoryId);
        }
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    // Retrieve product information from the form
    $bookId = htmlspecialchars($_POST['bookId']);
    $imgUrl = htmlspecialchars($_POST['imgUrl']);
    $bookTitle = htmlspecialchars($_POST['bookTitle']);
    $price = htmlspecialchars($_POST['price']);
    $quantity = htmlspecialchars($_POST['quantity']);

    // Check if the user is logged in
    if (isset($_SESSION['userID'])) {
        // If logged in, save product to cart in the database using the user ID
        $userID = $_SESSION['userID'];
        CartInfo::insertCartItem($userID, $bookId, $quantity);
    } else {
        // If not logged in, save product to temporary cart data
        $item = new CartInfo(0, 1, $bookId, $quantity, $bookTitle, $price, $imgUrl);
        CartInfo::addTempCartItem($item);
    }
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
    <title>Product</title>
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
                                <li><a href="index.php">Home</a></li>
                                <li class="current-list-item"><a href="shop.php">Shop</a></li>
                                <li><a href="../Sandhya/cart.php">Cart</a></li>
                                <li><a href="checkout.php">Check Out</a></li>
                                <li><a href="contact.php">Contact</a></li>
                                <li><a href="login.php">Login</a></li>
                                <li>
                                    <div class="header-icons">
                                        <a class="shopping-cart" href="../Sandhya/cart.php"><i
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
                        <h1>Products</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- Product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="category-filter">
                <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="category-filter">
                        <select name="categoryName" id="category-filter-select" onchange="this.form.submit()">
                            <option value="0" selected>All Categories</option>
                            <?php

                            // Fetch categories from the database
                            $categories = Category::getAllCategories(); // Assuming you have a method to fetch categories
                            foreach ($categories as $category) {
                                // echo '<option value="' . $category->getCategoryId() . '" . $categoryId . >' . $category->getCategoryName() . '</option>';
                                $selected = ($categoryId == $category->getCategoryId()) ? 'selected' : '';
                                echo '<option value="' . $category->getCategoryId() . '" ' . $selected . '>' . $category->getCategoryName() . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
            <br />
            <div class="row product-lists">
                <?php

                // $products = Product::getAllProducts();
                
                // Loop through each product and display it
                foreach ($products as $product) {
                    echo '<div class="col-lg-4 col-md-6 text-center">';
                    echo '<div class="single-product-item">';
                    echo '<div class="product-image">';
                    // Link to product details page for the image
                    echo '<a href="product-details.php?id=' . $product->getId() . '">';
                    echo '<img src="../assets/img/products/' . $product->getImgUrl() . '" alt="Book Image' . $product->getBookTitle() . '">';
                    echo '</a>';
                    echo '</div>';
                    // Link to product details page for the title
                    echo '<h3><a href="product-details.php?id=' . $product->getId() . '">' . $product->getBookTitle() . '</a></h3>';
                    echo '<p class="product-price"><span>Price</span> $' . $product->getPrice() . '</p>';
                    echo '<form method="POST" action="../Sandhya/cart.php">';
                    echo '<input type="hidden" name="bookId" value="' . $product->getId() . '">';
                    echo '<input type="hidden" name="imgUrl" value="' . $product->getImgUrl() . '">';
                    echo '<input type="hidden" name="bookTitle" value="' . $product->getBookTitle() . '">';
                    echo '<input type="hidden" name="price" value="' . $product->getPrice() . '">';
                    echo '<input type="number" name="quantity" value="1" min="1">';
                    echo '<button type="submit" name="add_to_cart">Add to Cart</button>';
                    echo '</form>';

                    echo '</div>';
                    echo '</div>';

                }

                ?>
            </div>
        </div>
    </div>
    <!-- End product section -->

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <!-- title -->
    <title>Home</title>

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
                                <li><a href="../Mirudulla/product.php">Shop</a></li>
                                <li><a href="../cart.html">Cart</a></li>
                                <li><a href="../Rajveer/checkout.php">Check Out</a></li>
                                <li><a href="../Aleena/login.php">Login</a></li>
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
                        <h1>Home</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->
    <!-- features list section -->
    <div class="list-section pt-80 pb-80">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="list-box d-flex align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <div class="content">
                            <h3>Free Shipping</h3>
                            <p>When order over $75</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="list-box d-flex align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-phone-volume"></i>
                        </div>
                        <div class="content">
                            <h3>24/7 Support</h3>
                            <p>Get support all day</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="list-box d-flex justify-content-start align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-sync"></i>
                        </div>
                        <div class="content">
                            <h3>Refund</h3>
                            <p>Get refund within 3 days!</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end features list section -->
    <!-- product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Our</span> Products</h3>
                        <p>Discover a universe of heroes and villains at Comic Store. Explore our vast collection of
                            comics, graphic novels, and collectibles. Unleash your inner hero with us!</p>
                    </div>
                </div>
            </div>
            <div class="product-section mt-150 mb-150">
                <div class="container">
                    <div class="row product-lists">
                        <?php
                        // Retrieve product data from the database or any other source
                        $products = [
                            ['id' => 1, 'title' => 'Doctor Strange', 'price' => 29.99, 'image' => 'drstrange.jpeg'],
                            ['id' => 2, 'title' => 'Spiderman', 'price' => 49.99, 'image' => 'spiderman.jpeg'],
                            ['id' => 3, 'title' => 'Starwars', 'price' => 49.99, 'image' => 'starwars.jpeg'],
                        ];

                        // Function to display product HTML
                        function displayProduct($product)
                        {
                            echo '<div class="col-lg-4 col-md-6 text-center">';
                            echo '<div class="single-product-item">';
                            echo '<div class="product-image">';
                            // Link to product details page for the image
                            echo '<a href="product-details.php?id=' . $product['id'] . '">';
                            echo '<img src="../assets/img/products/' . $product['image'] . '" alt="' . $product['title'] . '">';
                            echo '</a>';
                            echo '</div>';
                            // Link to product details page for the title
                            echo '<h3><a href="product-details.php?id=' . $product['id'] . '">' . $product['title'] . '</a></h3>';
                            echo '<p class="product-price"><span>Price</span> $' . $product['price'] . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }

                        // Loop through each product and display it using the function
                        foreach ($products as $product) {
                            displayProduct($product);
                        }
                        ?>

                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- end product section -->
    <!-- cart banner section -->
    <section class="cart-banner pt-100 pb-100">
        <div class="container">
            <div class="row clearfix">
                <!--Image Column-->
                <div class="image-column col-lg-6">
                    <div class="image">
                        <div class="price-box">
                            <div class="inner-price">
                                <span class="price">
                                    <strong>30%</strong> <br> off on Cindrella
                                </span>
                            </div>
                        </div>
                        <img src="assets/img/products/cindrella.jpeg" alt="cindrella" style="width: 70%; height: 50%">
                    </div>
                </div>
                <!--Content Column-->
                <div class="content-column col-lg-6">
                    <h3><span class="orange-text">Deal</span> of the day</h3>
                    <h4>Cindrella</h4>
                    <div class="text">Cinderella's mother dies and then her father marries her evil stepmother, adding
                        her and Cinderella's evil stepsisters to the family. Lucky for Cinderella, her father doesn't
                        die.</div>
                    <!--Countdown Timer-->
                    <div class="time-counter">
                        <div class="time-countdown clearfix" data-countdown="2024/05/01">
                            <div class="counter-column">
                                <div class="inner"><span class="count">00</span>Days</div>
                            </div>
                            <div class="counter-column">
                                <div class="inner"><span class="count">00</span>Hours</div>
                            </div>
                            <div class="counter-column">
                                <div class="inner"><span class="count">00</span>Mins</div>
                            </div>
                            <div class="counter-column">
                                <div class="inner"><span class="count">00</span>Secs</div>
                            </div>
                        </div>
                    </div>
                    <!--<a href="cart.html" class="cart-btn mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a>-->
                    <a href="../Mirudulla/product.php" class="cart-btn btn-lg">Shop Now</a>
                </div>
            </div>
        </div>
    </section>
    <!-- end cart banner section -->
    <!-- advertisement section -->
    <div class="abt-section mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">

                    <img src="assets/img/comic_banner.jpg" alt="banner">

                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="abt-text">
                        <p class="top-sub">Since Year 1999</p>
                        <h2>Our <span class="orange-text">Comic Store</span></h2>
                        <p>In comic store, the walls echo with the tales of superheroes and villains alike, where each
                            shelf holds a
                            gateway to boundless adventure. Vibrant covers beckon from every corner, promising epic
                            battles and
                            heart-pounding escapades. It's a store where strangers become comrades, bonding over shared
                            excitement
                            for the latest releases or classic sagas. Here, imagination knows no bounds, and every comic
                            book
                            is a portal to new worlds waiting to be explored. Welcome to comic store, where dreams take
                            flight
                            and heroes are born anew with each turn of the page.</p>

                        <!--<a href="contact.php" class="boxed-btn mt-4">Contact Us</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end advertisement section -->
    <!-- shop banner -->
    <section class="shop-banner">
        <div class="container">
            <h3>April sale is on! <br> with big <span class="orange-text">Discount...</span></h3>
            <div class="sale-percent"><span>Sale! <br> Upto</span>50% <span>off</span></div>
            <a href="../Mirudulla/product.php" class="cart-btn btn-lg">Shop Now</a>
        </div>
    </section>
    <!-- end shop banner -->


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

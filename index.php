<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<style>
    .nav-item a.nav-link {
        color: black;
        font-weight: 500;
    }
    .navbar-brand img {
        height: 50px;
    }
</style>
</body>
<?php
include_once("header.php");

?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<br>
<div class="row">
    <div class="col-12">
        <div id="demo" class="carousel slide" data-bs-ride="carousel">

            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            </div>

            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="image/discount1.webp" alt="Los Angeles" class="img-fluid" style="width: 100%; height: 500px;">
                </div>
                <div class="carousel-item">
                    <img src="image/discount2.webp" alt="Chicago" class="img-fluid" style="width: 100%; height: 500px;">
                </div>
                <div class="carousel-item">
                    <img src="image/discount3.webp" alt="New York" class="img-fluid" style="width: 100%; height: 500px;">
                </div>
            </div> <!-- Closing carousel-inner properly -->

            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>

        </div> <!-- Closing carousel -->
    </div>
</div>

        <br>
            <!-- Categories Section -->
    <div class="container-fluid mt-5" style="background-color: rgb(244, 216, 168)";>
        <div class="container mt-5">
            <h2 class="text-center">Categories</h2>
            <br>
            <div class="row text-center">
               <div class="col-md-2 text-center"><img src="image/Money.jpg" class="img-fluid"><h5 class="card-title">FICTION</h5>
            <div class="rating">
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star-half-alt text-warning"></i>
            </div>
            <p><del>₹599</del> <span class="text-danger">₹399</span></p>
                <a href="add_cart.php"><i class="fa-solid fa-cart-shopping fa-lg" style="color: #028745;"></i></a> &nbsp;&nbsp;
                <a href="add_wishlist.php"><i class="fa-solid fa-heart fa-lg" style="color: #ed0c0c;"></i></i></a>&nbsp;&nbsp;
                <a href="view_product.php"><i class="fa-solid fa-eye fa-lg" style="color: #0f7dd2;"></i></a>&nbsp;&nbsp;
                </div>
            <div class="col-md-2"><img src="image/Panda.jpg" class="img-fluid"><h5 class="card-title">NON-FICTION</h5>
            <div class="rating">
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star-half-alt text-warning"></i>
            </div>
            <p><del>₹499</del> <span class="text-danger">₹299</span></p>
                <a href="add_cart.php"><i class="fa-solid fa-cart-shopping fa-lg" style="color: #028745;"></i></a> &nbsp;&nbsp;
                <a href="add_wishlist.php"><i class="fa-solid fa-heart fa-lg" style="color: #ed0c0c;"></i></i></a>&nbsp;&nbsp;
                <a href="view_product.php"><i class="fa-solid fa-eye fa-lg" style="color: #0f7dd2;"></i></a>&nbsp;&nbsp;
            </div>
            <div class="col-md-2"><img src="image/Physics.jpg" class="img-fluid"><h5 class="card-title">SELF-HELP</h5>
            <div class="rating">
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star-half-alt text-warning"></i>
            </div>
            <p><del>₹999</del> <span class="text-danger">₹899</span></p>
                <a href="add_cart.php"><i class="fa-solid fa-cart-shopping fa-lg" style="color: #028745;"></i></a> &nbsp;&nbsp;
                <a href="add_wishlist.php"><i class="fa-solid fa-heart fa-lg" style="color: #ed0c0c;"></i></i></a>&nbsp;&nbsp;
                <a href="view_product.php"><i class="fa-solid fa-eye fa-lg" style="color: #0f7dd2;"></i></a>&nbsp;&nbsp;
            </div>
            <div class="col-md-2"><img src="image/Emotional.jpg" class="img-fluid"><h5 class="card-title">SCIENCE FICTION</h5>
            <div class="rating">
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star-half-alt text-warning"></i>
            </div>
            <p><del>₹799</del> <span class="text-danger">₹499</span></p>
                <a href="add_cart.php"><i class="fa-solid fa-cart-shopping fa-lg" style="color: #028745;"></i></a> &nbsp;&nbsp;
                <a href="add_wishlist.php"><i class="fa-solid fa-heart fa-lg" style="color: #ed0c0c;"></i></i></a>&nbsp;&nbsp;
                <a href="view_product.php"><i class="fa-solid fa-eye fa-lg" style="color: #0f7dd2;"></i></a>&nbsp;&nbsp;
           </div>
            <div class="col-md-2"><img src="image/Fire & Blood.jpg" class="img-fluid"><h5 class="card-title">HISTORICAL FICTION</h5>
            <div class="rating">
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star-half-alt text-warning"></i>
            </div>
            <p><del>₹99</del> <span class="text-danger">₹79</span></p>
                <a href="add_cart.php"><i class="fa-solid fa-cart-shopping fa-lg" style="color: #028745;"></i></a> &nbsp;&nbsp;
                <a href="add_wishlist.php"><i class="fa-solid fa-heart fa-lg" style="color: #ed0c0c;"></i></i></a>&nbsp;&nbsp;
                <a href="view_product.php"><i class="fa-solid fa-eye fa-lg" style="color: #0f7dd2;"></i></a>&nbsp;&nbsp;
            </div>
            <div class="col-md-2"><img src="image/Babel.jpg" class="img-fluid"><h5 class="card-title">HISTORICAL FICTION</h5>
            <div class="rating">
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star-half-alt text-warning"></i>
            </div>
            <p><del>₹599</del> <span class="text-danger">₹399</span></p>
                <a href="add_cart.php"><i class="fa-solid fa-cart-shopping fa-lg" style="color: #028745;"></i></a> &nbsp;&nbsp;
                <a href="add_wishlist.php"><i class="fa-solid fa-heart fa-lg" style="color: #ed0c0c;"></i></i></a>&nbsp;&nbsp;
                <a href="view_product.php"><i class="fa-solid fa-eye fa-lg" style="color: #0f7dd2;"></i></a>&nbsp;&nbsp;
           </div>
        </div>
    </div>
 <br>
    <!-- Bestsellers -->
    <div class="container-fluid mt-5" style="background-color: rgb(244, 216, 168)";>
    <div class="container mt-5">
        <h2 class="text-center">Bestsellers</h2>
        <br>
        <div class="row text-center">
            <div class="col-md-2"><img src="image/Bear.jpg" class="img-fluid">
            <h4 class="card-title">Brown Bear</h4>
            <p class="card-text">Bill Martin Jr </p>
            <div class="rating">
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star-half-alt text-warning"></i>
            </div>
            <p><del>₹399</del> <span class="text-danger">₹199</span></p>
                <a href="add_cart.php"><i class="fa-solid fa-cart-shopping fa-lg" style="color: #028745;"></i></a> &nbsp;&nbsp;
                <a href="add_wishlist.php"><i class="fa-solid fa-heart fa-lg" style="color: #ed0c0c;"></i></i></a>&nbsp;&nbsp;
                <a href="view_product.php"><i class="fa-solid fa-eye fa-lg" style="color: #0f7dd2;"></i></a>&nbsp;&nbsp;
            </div>
            <div class="col-md-2"><img src="image/Babel.jpg" class="img-fluid">
            <h4 class="card-title">BABEL</h4>
            <p class="card-text">R.F. KUANG </p>            <div class="rating">
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star-half-alt text-warning"></i>
            </div>
            <p><del>₹599</del> <span class="text-danger">₹399</span></p>
                <a href="add_cart.php"><i class="fa-solid fa-cart-shopping fa-lg" style="color: #028745;"></i></a> &nbsp;&nbsp;
                <a href="add_wishlist.php"><i class="fa-solid fa-heart fa-lg" style="color: #ed0c0c;"></i></i></a>&nbsp;&nbsp;
                <a href="view_product.php"><i class="fa-solid fa-eye fa-lg" style="color: #0f7dd2;"></i></a>&nbsp;&nbsp;
            </div>
            <div class="col-md-2"><img src="image/Panda.jpg" class="img-fluid">
            <h4 class="card-title">THE PANDAS WHO PROMISED</h4>
            <p class="card-text">Rachel Jim</p>            <div class="rating">
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star-half-alt text-warning"></i>
            </div>
            <p><del>₹499</del> <span class="text-danger">₹399</span></p>
                <a href="add_cart.php"><i class="fa-solid fa-cart-shopping fa-lg" style="color: #028745;"></i></a> &nbsp;&nbsp;
                <a href="add_wishlist.php"><i class="fa-solid fa-heart fa-lg" style="color: #ed0c0c;"></i></i></a>&nbsp;&nbsp;
                <a href="view_product.php"><i class="fa-solid fa-eye fa-lg" style="color: #0f7dd2;"></i></a>&nbsp;&nbsp;
            </div>
            <div class="col-md-2"><img src="image/Fire & Blood.jpg" class="img-fluid">
            <h4 class="card-title">FIRE & BLOOD</h4>
            <p class="card-text">GEORGE R.R. MARTIN </p>            <div class="rating">
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star-half-alt text-warning"></i>
            </div>
            <p><del>₹599</del> <span class="text-danger">₹359</span></p>
                <a href="add_cart.php"><i class="fa-solid fa-cart-shopping fa-lg" style="color: #028745;"></i></a> &nbsp;&nbsp;
                <a href="add_wishlist.php"><i class="fa-solid fa-heart fa-lg" style="color: #ed0c0c;"></i></i></a>&nbsp;&nbsp;
                <a href="view_product.php"><i class="fa-solid fa-eye fa-lg" style="color: #0f7dd2;"></i></a>&nbsp;&nbsp;
            </div>
            <div class="col-md-2"><img src="image/Emotional.jpg" class="img-fluid">
            <h4 class="card-title">EMOTIONAL INTELLIGENCE 2.0</h4>
            <p class="card-text">TRAVIS BRADBERRY & JEAN GREAVES </p>
            <div class="rating">
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star-half-alt text-warning"></i>
            </div>
            <p><del>₹699</del> <span class="text-danger">₹399</span></p>
                <a href="add_cart.php"><i class="fa-solid fa-cart-shopping fa-lg" style="color: #028745;"></i></a> &nbsp;&nbsp;
                <a href="add_wishlist.php"><i class="fa-solid fa-heart fa-lg" style="color: #ed0c0c;"></i></i></a>&nbsp;&nbsp;
                <a href="view_product.php"><i class="fa-solid fa-eye fa-lg" style="color: #0f7dd2;"></i></a>&nbsp;&nbsp;
            </div>
            <div class="col-md-2"><img src="image/Artisan.jpg" class="img-fluid">
            <h4 class="card-title">FLOUR WATER SALT YEAST</h4>
            <p class="card-text">KEN PORKISH </p>            <div class="rating">
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star-half-alt text-warning"></i>
            </div>
            <p><del>₹599</del> <span class="text-danger">₹399</span></p>
                <a href="add_cart.php"><i class="fa-solid fa-cart-shopping fa-lg" style="color: #028745;"></i></a> &nbsp;&nbsp;
                <a href="add_wishlist.php"><i class="fa-solid fa-heart fa-lg" style="color: #ed0c0c;"></i></i></a>&nbsp;&nbsp;
                <a href="view_product.php"><i class="fa-solid fa-eye fa-lg" style="color: #0f7dd2;"></i></a>&nbsp;&nbsp;
           </div>
        </div>
        </div>
    </div>
    </div>
</div>
<?php
include_once("footer.php");
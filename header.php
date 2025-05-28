<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css"> <!-- External CSS -->
    <link rel="stylesheet" href="carousel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"> <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/additional-methods.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" > -->
</head>
<style>
   .nav-item a.nav-link {
        color: black;
        font-weight:500;
    }
    .navbar-brand img{
        height: 50px;
    }
    .navbar {
    position: relative;
    z-index: 1050; /* Higher than carousel */
}
</style> 
<body>
    <div class="container-fluid" style="background-color: rgb(244, 216, 168);">
        <br>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="container-fluid"> 
                            <!-- Brand Logo -->
                             <a class="navbar-brand" href="#"><img src="image/BOOK2.png"
                                    ></a> 

                            <!-- Navbar Toggler -->
                             <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button> 

                            <!-- Collapsible Navbar Menu -->
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav ms-auto">
                                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                                    <li class="nav-item"><a class="nav-link" href="gallery.php">Products</a></li>
                                    <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                                    <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
 

                                    <!-- Search Bar -->
                                     <form class="d-flex" action="search.php" method="GET">
                                        <input class="form-control me-2" type="search" name="query"
                                            placeholder="Search books" aria-label="Search">
                                        <button class="btn"><i class="fa-solid fa-magnifying-glass"
                                                style="color: #e7700d;"></i></button>
                                    </form>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div> 


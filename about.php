<?php
include_once("header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Online Bookstore</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        header {
    background-color: #ffffff; /* Example: Light Gray */
    padding: 10px 0; /* Optional: Add padding if needed */
}

        body {
            background-color: white;
        }
        .container {
            /* max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
            background-color: transparent;
            box-shadow: none;
            border: none;
        }
        h1 {
            color: #2c3e50;
        }
        p {
            font-size: 18px;
            color: #555;
            line-height: 1.6;
        }
        img {
            width: 100%;
            border-radius: 10px;
            margin-top: 15px;
        }
        footer {
    background-color: #343a40; /* Example: Dark Gray */
    color: #ffffff; /* Example: White text */
    padding: 20px 0; /* Add spacing */
    text-align: center; /* Center-align footer text */
}

    </style>
</head>
<body>
<br>
<div class="container text-center">
    <div class="container-fluid";>
    <h1>About Us</h1>    
    <p>Welcome to <strong><?php echo "BOOKLY"; ?></strong>, your one-stop destination for a vast collection of books across all genres.</p>
    <p>We believe in the power of stories, knowledge, and imagination, offering a carefully curated selection for book lovers of all ages.</p>
    <p>Whether you're searching for timeless classics, bestsellers, academic books, or hidden literary gems, our bookstore provides an engaging reading experience.</p>
    <p>Happy Reading! 📚</p>
    
    <img src="image/about.webp" alt="Cozy Bookstore" width=100% Height=500px>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
include_once("footer.php");

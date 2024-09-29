<?php
include('db.php');

// Fetch artworks that are for sale
$sql = "SELECT * FROM artworks WHERE for_sale = 1";
$artworks_result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artworks for Sale</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <style>/* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: "Quicksand", sans-serif;
    background: url('images/loginbg.jpg') no-repeat center center/cover;
    padding: px;
}

/* Page Title */
h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #fff;
}

/* Artwork Gallery Layout */
.artwork-gallery {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

/* Individual Artwork Item */
.artwork-item {
    background-color: #e0e0e0a7;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 5px;
    text-align: center;
    width: 220px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}


/* Hover Effect on Artwork */
.artwork-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
}

/* Artwork Image */
.artwork-item img {
    max-width: 100%;
    height: auto;
    border-radius: 5px;
    margin-bottom: 10px;
}

/* Artwork Title */
.artwork-item h3 {
    color: #333;
    font-size: 1.2rem;
    margin: 10px 0;
}

/* Artwork Description */
.artwork-item p {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 10px;
}

/* Price */
.artwork-item p:last-of-type {
    font-size: 1rem;
    color: #444;
    font-weight: bold;
    margin-bottom: 15px;
}

/* Buy Button */
.buy-button {
    display: inline-block;
    padding: 10px 15px;
    background-color: #000000;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.buy-button:hover {
    background-color: #0056b3;
}

/* Responsive Design */
@media (max-width: 768px) {
    .artwork-item {
        width: 45%;
    }
}

@media (max-width: 500px) {
    .artwork-item {
        width: 100%;
    }
}
header {
            background-color: #000000;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }
        
        header .logo  {
            margin-left: 10px;
            max-width: 100px;
        }
        
        nav ul {
            display: flex;
            gap: 20px;
            margin-right: 20px;
        }
        
        nav ul li {
            display: inline;
            transition: font-size 0.3s ease;
        }
        nav ul li:hover{
            background-color: #000000;
            font-size: larger;
        }
        
        nav ul li a {
            color: white;
            text-decoration: none;
        }
        
        nav ul li a:hover {
            text-decoration: none;
            
        }
.footer {
    background-color: #000000;
    color: white;
    padding: 40px 0;
    text-align: left;
}

.footer-widgets {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 20px;
}

.footer-widget {
    width: 200px;
}

.footer-widget h4 {
    font-size: 18px;
    margin-bottom: 15px;
    color: #f9f9f9;
}

.footer-pages {
    list-style: none;
    padding: 0;
}

.footer-pages li {
    margin-bottom: 10px;
}

.footer-pages li a {
    color: #ddd;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-pages li a:hover {
    color: #fff;
}

.social-icons {
    display: flex;
    gap: 20px; /* Space between icons */
}

.social-icons a {
    color: #ddd;
    font-size: 24px;
    transition: color 0.3s ease, transform 0.3s ease;
}

.social-icons a:hover {
    color: #fff;
    transform: scale(1.1); /* Slight zoom on hover */
}

/* Map Styles */
iframe {
    border-radius: 10px;
}
</style>
</head>
<body>
<header>
    <div class="logo">
        <img src="images/logo.jpg" style="max-width: 100px;">
    </div>
    <nav>
        <ul>
                <li><a href="artist_dashboard.php">Dashboard</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="buy_artwork.php">Buy Artwork</a></li>
        </ul>
    </nav>
</header>

<h1>Artworks for Sale</h1>

<div class="artwork-gallery">
    <?php if (mysqli_num_rows($artworks_result) > 0) { ?>
        <?php while ($artwork = mysqli_fetch_assoc($artworks_result)) { ?>
            <div class="artwork-item">
                <img src="uploads/artworks/<?php echo $artwork['image_path']; ?>" alt="<?php echo $artwork['title']; ?>" width="200">
                <h3><?php echo $artwork['title']; ?></h3>
                <p><?php echo $artwork['description']; ?></p>
                <p>Price: $<?php echo $artwork['price']; ?></p>
                <a href="purchase.php?artwork_id=<?php echo $artwork['id']; ?>" class="buy-button">Buy Now</a>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p>No artworks available for sale at the moment.</p>
    <?php } ?>
</div>
<footer class="footer">
    <div class="footer-widgets">
        <!-- Pages List -->
        <div class="footer-widget">
            <h4>Pages</h4>
            <ul class="footer-pages">
                <li><a href="artist_dashboard.php">Dashboard</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="buy_artwork.php">Buy Artwork</a></li>
            </ul>
        </div>

        <!-- Office Address -->
        <div class="footer-widget">
            <h4>Office Address</h4>
            <p>
                123 Art Street, <br>
                Art City, ZIP 45678<br>
                Phone: (123) 456-7890<br>
                Email: info@artgallery.com
            </p>
        </div>

        <!-- Social Media -->
        <div class="footer-widget">
            <h4>Follow Us</h4>
            <div class="social-icons">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <!-- Map -->
        <div class="footer-widget">
            <h4>Our Location</h4>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3682.867265165779!2d88.45687821100248!3d22.62143133109286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f89f9e91bacc61%3A0x968409cde916e450!2sShrachi%20EK%20tower!5e0!3m2!1sen!2sin!4v1726138834005!5m2!1sen!2sin" width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</footer>

</body>
</html>

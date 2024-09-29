<?php
include('db.php');

// Fetch artworks from database
$sql = "SELECT a.title, a.image_path, a.price, a.for_sale, ar.name AS artist_name 
        FROM artworks a
        JOIN artists ar ON a.artist_id = ar.id";
$result = mysqli_query($conn, $sql);
?>
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
<style>/* Basic reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: "Quicksand", sans-serif;
    background: url('images/loginbg.jpg') no-repeat center center/cover;
    color: #333;
    padding: px;
}

/* Gallery layout */
.gallery {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    margin-top: 20px;
}

/* Individual artwork item */
.artwork {
    background-color: #fafafab5;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 5px;
    text-align: center;
    width: 250px;
    position: relative;
    transition: transform 0.2s ease-in-out;
}

/* .artwork:hover {
    transform: translateY(-10px);
} */

/* Artwork image */
.artwork img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    transition: transform 0.3s ease-in-out; 
    cursor: zoom-in;
}

/* Artwork details */
.artwork h3 {
    font-size: 1.2rem;
    margin: 15px 0 5px;
    color: #444;
}

.artwork p {
    font-size: 0.9rem;
    margin-bottom: 10px;
}

/* Buy Now button */
.artwork button {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.artwork button:hover {
    background-color: #218838;
}

/* Zoomable image functionality */
/* .zoomable {
    transition: transform 0.3s ease-in-out;
    border-radius: 10px;
    cursor: zoom-in;
}

.zoomable:hover {
    transform: scale(0.6);
} */

/* Responsive Design */
@media (max-width: 768px) {
    .artwork {
        width: 45%;
    }
}

@media (max-width: 500px) {
    .artwork {
        width: 90%;
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
<div class="gallery">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="artwork">
            <img class="zoomable" src="uploads/artworks/<?php echo $row['image_path']; ?>" alt="<?php echo $row['title']; ?>">
            <h3><?php echo $row['title']; ?></h3>
            <p>Artist: <?php echo $row['artist_name']; ?></p>
            <!-- <p>Price: $<?php echo $row['price']; ?></p> -->
            <?php if ($row['for_sale']) { ?>
                <!-- <button>Buy Now</button> -->
            <?php } ?>
        </div>
    <?php } ?>
</div>
<!-- Footer -->
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

<!-- <script>
const zoomableImages = document.querySelectorAll(".zoomable");

zoomableImages.forEach(img => {
    img.addEventListener('mousemove', function(e) {
        const rect = img.getBoundingClientRect();
        const x = (e.clientX - rect.left) / img.offsetWidth * 100;
        const y = (e.clientY - rect.top) / img.offsetHeight * 100;
        img.style.transformOrigin = `${x}% ${y}%`;
        img.style.transform = "scale(2)";
    });

    img.addEventListener('mouseleave', function() {
        img.style.transform = "scale(1)";
    });
});
</script> -->

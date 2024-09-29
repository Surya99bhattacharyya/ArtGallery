<?php
session_start();
include('db.php');

// Check if artist is logged in
if (!isset($_SESSION['artist_id'])) {
    header("Location: login.php");
    exit;
}

$artist_id = $_SESSION['artist_id'];

// Fetch artist's profile details
$sql = "SELECT * FROM artists WHERE id='$artist_id'";
$result = mysqli_query($conn, $sql);
$artist = mysqli_fetch_assoc($result);

// Fetch artworks uploaded by the artist
$sql = "SELECT * FROM artworks WHERE artist_id='$artist_id'";
$artworks_result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <style>
        /* Reset some default styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Quicksand", sans-serif;
            background-color: #f4f4f9;
            display: flex;
            height: 100vh;
            margin: 0;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #000000;
            padding: 20px;
            border-right: 1px solid #ddd;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar img {
            border-radius: 50%;
            border: 4px solid #ddd;
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .sidebar h1 {
            font-size: 1.5rem;
            color: #ffffff;
            text-align: center;
            margin-bottom: 10px;
        }

        .sidebar p {
    font-size: 1rem;
    color: #a0a0a0;
    text-align: center;
    margin-bottom: 20px;
}

.sidebar button,
        .sidebar a {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
            color: #fff;
            border: 1px solid #fff;
            border-radius: 20px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .sidebar a {
            background-color: #000000;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #4b4b4b;
        }

        .sidebar button {
            background-color: #000000;
        }

        .sidebar button:hover {
            background-color: #555555;
        }

        /* Main Content */
        .main-content {
    flex: 1;
    padding: 20px;
    background-color: #333;
}

.main-content h2 {
    color: #ffffff;
    margin-bottom: 20px;
}

.main-content p {
    color: #c2c2c2;
    text-align: center;
}
        .artwork-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .artwork-item {
    background-color: #787878;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 250px;
    border: 1px solid #fff
}

.artwork-item img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 10px;
}

.artwork-item h3 {
    color: #ffffff;
    margin-bottom: 10px;
}

.artwork-item p {
    color: #fff;
    font-size: 0.9rem;
    margin-bottom: 8px;
}


        .artwork-item p:last-child {
            font-weight: bold;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #ddd;
                box-shadow: none;
                padding-bottom: 10px;
            }

            .main-content {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <img src="uploads/artists/<?php echo $artist['profile_image']; ?>" alt="Profile Image">
        <h1><?php echo $artist['name']; ?></h1>
        <p><?php echo $artist['bio']; ?></p>
        <a href="upload_artwork.php" class="dashboard-button">Upload New Artwork</a>
        <button type="button" onclick="window.location.href='gallery.php';" class="dashboard-button">Gallery</button>
        <button type="button" onclick="window.location.href='buy_artwork.php';" class="dashboard-button">Buy Artwork</button>
        <a href="logout.php" class="logout-button">Logout</a>
    </div>

    <div class="main-content">
        <h2>Your Artworks</h2>

        <div class="artwork-list">
            <?php while ($artwork = mysqli_fetch_assoc($artworks_result)) { ?>
                <div class="artwork-item">
                    <img src="uploads/artworks/<?php echo $artwork['image_path']; ?>" alt="<?php echo $artwork['title']; ?>" width="150">
                    <h3><?php echo $artwork['title']; ?></h3>
                    <p><?php echo $artwork['description']; ?></p>
                    <p>Category: <?php echo $artwork['category']; ?></p>
                    <p>Price: $<?php echo $artwork['price']; ?></p>
                    <p><?php echo $artwork['for_sale'] ? 'For Sale' : 'Not for Sale'; ?></p>
                </div>
            <?php } ?>
        </div>
    </div>

</body>
</html>

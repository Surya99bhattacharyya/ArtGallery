<?php
session_start();
include('db.php');

if (!isset($_SESSION['artist_id'])) {
    header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $artist_id = $_SESSION['artist_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $for_sale = isset($_POST['for_sale']) ? 1 : 0;
    $image = $_FILES['image']['name'];

    // Upload artwork image
    $target_dir = "uploads/artworks/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

    // Insert into database
    $sql = "INSERT INTO artworks (artist_id, title, description, image_path, category, price, for_sale) VALUES ('$artist_id', '$title', '$description', '$image', '$category', '$price', '$for_sale')";
    if (mysqli_query($conn, $sql)) {
        echo "Artwork uploaded successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<style>/* Reset default margins and padding */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: "Quicksand", sans-serif;
    background: url('images/loginbg.jpg') no-repeat center center/cover;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Form Container */
form {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 400px;
    max-width: 100%;
}

form h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #555;
}

/* Form Inputs */
input[type="text"],
input[type="number"],
textarea,
input[type="file"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 1rem;
    color: #333;
}

textarea {
    resize: none;
    height: 100px;
}

input[type="checkbox"] {
    margin-right: 5px;
}

input[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #000000;
    border: none;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #717171;;
}

/* Centered Title */
form h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

/* Responsive Design */
@media (max-width: 600px) {
    form {
        width: 90%;
    }
}
</style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
<form method="POST" enctype="multipart/form-data">
    <h2>Upload Artwork</h2>
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required><br>

    <label for="description">Description:</label>
    <textarea name="description" id="description"></textarea><br>

    <label for="category">Category:</label>
    <input type="text" name="category" id="category" required><br>

    <label for="price">Price:</label>
    <input type="number" name="price" id="price" step="0.01" required><br>

    <label for="for_sale">For Sale:</label>
    <input type="checkbox" name="for_sale" id="for_sale"><br>

    <label for="image">Image:</label>
    <input type="file" name="image" id="image" required><br>

    <input type="submit" value="Upload">

    <!-- Add a button to go to artist_dashboard.php -->
    <button type="button" onclick="window.location.href='artist_dashboard.php';" class="dashboard-button" style="background-color:#717171;">Go to Dashboard</button>
</form>

<style>
/* Existing CSS */

button.dashboard-button {
    margin-top: 15px;
    padding: 10px 15px;
    background-color: #007bff;
    border: none;
    color: white;
    font-size: 1rem;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s ease;
}

button.dashboard-button:hover {
    background-color: #0056b3;
}
</style>


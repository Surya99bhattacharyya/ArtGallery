<?php
include('db.php'); // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $bio = $_POST['bio'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $profile_image = $_FILES['profile_image']['name'];
    
    // Upload Profile Image
    $target_dir = "uploads/artists/";
    $target_file = $target_dir . basename($profile_image);
    move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file);

    // Insert into database
    $sql = "INSERT INTO artists (name, bio, email, password, profile_image) VALUES ('$name', '$bio', '$email', '$password', '$profile_image')";
    if (mysqli_query($conn, $sql)) {
        // Registration successful, redirect to login page
        header("Location: login.php");
        exit(); // Make sure to exit after redirection
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
<style>body {
    font-family: "Quicksand", sans-serif;
    background: url('images/loginbg.jpg') no-repeat center center/cover;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

form {
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    width: 350px;
}

form h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

input[type="text"],
input[type="email"],
input[type="password"],
textarea,
input[type="file"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

textarea {
    resize: none;
    height: 80px;
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
}

input[type="submit"]:hover {
    background-color: #717171;;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
    color: #333;
}

.success-message,
.error-message {
    text-align: center;
    margin-top: 10px;
}

.success-message {
    color: green;
}

.error-message {
    color: red;
}
</style>
<form method="POST" enctype="multipart/form-data">
    <h2>Artist Registration</h2>
    
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required><br>

    <label for="bio">Bio:</label>
    <textarea name="bio" id="bio"></textarea><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br>

    <label for="profile_image">Profile Image:</label>
    <input type="file" name="profile_image" id="profile_image"><br>

    <input type="submit" value="Register">
</form>


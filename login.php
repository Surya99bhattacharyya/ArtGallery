<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check user credentials
    $sql = "SELECT * FROM artists WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $artist = mysqli_fetch_assoc($result);

    if ($artist && password_verify($password, $artist['password'])) {
        $_SESSION['artist_id'] = $artist['id'];
        header("Location: artist_dashboard.php");
        exit;
    } else {
        $login_error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Quicksand", sans-serif;
            background: url('images/loginbg.jpg') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        form h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #000000;
            border: none;
            border-radius: 4px;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #717171;;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }

        .success-message {
            color: green;
            text-align: center;
            margin-top: 10px;
        }

        .register-link {
            display: block;
            text-align: center;
            margin-top: 10px;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 300px;
        }

        .modal-content button {
            background-color: #28a745;
            border: none;
            padding: 10px 20px;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        .modal-content button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Artist Login</h2>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Login">
        <a href="register_artist.php" class="register-link">New user? Register here</a>
    </form>

    <!-- Modal -->
    <?php if (isset($login_error) && $login_error) { ?>
        <div class="modal" id="loginErrorModal">
            <div class="modal-content">
                <p>User not found. Please register.</p>
                <a href="register_artist.php">
                    <button>Register</button>
                </a>
            </div>
        </div>
        <script>
            // Display the modal if there's a login error
            document.getElementById('loginErrorModal').style.display = 'flex';
        </script>
    <?php } ?>
</body>
</html>

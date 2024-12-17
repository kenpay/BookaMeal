<?php
session_start();
ob_start();
include("connect.php");
include("functions.php");

$verification_message = '';

if (isset($_GET['user']) && isset($_POST['verification_code'])) {
    $user_email = mysqli_real_escape_string($con, $_GET['user']);
    $verification_code = mysqli_real_escape_string($con, $_POST['verification_code']);
    
    // Check if session variables are set before accessing them
    if (isset($_SESSION['verification_code_' . $user_email]) && isset($_SESSION['user_name_' . $user_email]) && isset($_SESSION['user_email_' . $user_email]) && isset($_SESSION['hashed_password_' . $user_email])) {
        $stored_verification_code = $_SESSION['verification_code_' . $user_email];
        $user_name = $_SESSION['user_name_' . $user_email];
        $hashed_password = $_SESSION['hashed_password_' . $user_email];

        if ($verification_code === $stored_verification_code) {
            // Verification successful, clear the session verification code
            unset($_SESSION['verification_code_' . $user_email]);
            unset($_SESSION['user_name_' . $user_email]);
            unset($_SESSION['user_email_' . $user_email]);
            unset($_SESSION['hashed_password_' . $user_email]);

            // Insert the user into the database
            $query = "INSERT INTO users (user, user_name, password, email) VALUES (UUID(), '$user_name', '$hashed_password', '$user_email')";
            if (mysqli_query($con, $query)) {
                // User inserted successfully
                header("Location: login.php"); // Redirect la login
                exit;
            } else {
                // catchall pentru erori
                $verification_message = "Eroare la crearea contului. Va rog incercati din nou.";
            }
        } else {
            $verification_message = 'Codul de verificare nu este corect.';
        }
    } else {
        $verification_message = 'Eroare la verificarea codului. Va rugam sincercati din nou';
    }
}
?>

<!DOCTYPE html>
<head>
    <title>Verify</title>
    <style>
        body {
            background-image: url('background.jpg');
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #box {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        #text {
            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border: solid thin #aaa;
            width: 100%;
            margin-bottom: 10px;
            font-size: 16px;
        }

        #button {
            padding: 10px;
            width: 100%;
            color: white;
            background-color: lightblue;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        #button:hover {
            background-color: #0096c7;
        }

        #verification-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div id="box">
        <form method="post">
            <div style="font-size: 24px; margin-bottom: 20px;">Verification</div>
            <input id="text" type="text" name="verification_code" placeholder="Verification Code" required>
            <input id="button" type="submit" value="Verify">
            <div id="verification-message">
                <?php echo $verification_message; ?>
            </div>
        </form>
    </div>
</body>
</html>

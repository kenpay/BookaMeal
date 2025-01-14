<?php
session_start();
include("connect.php");
require 'PHPMailer.php'; // Adjust the path as needed
require 'SMTP.php';
require 'Exception.php'; // Include the Exception class

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    echo "Email received: $email<br>";

    // Check if the email exists in the database
    $query = "SELECT id FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "Email found in database.<br>";
        $reset_code = rand(100000, 999999); // Generate a 6-digit reset code

        // Store the reset code and set expiration time
        $query = "UPDATE users SET reset_token='$reset_code', reset_expiration=DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email='$email'";
        $update_result = mysqli_query($con, $query);

        if ($update_result) {
            echo "Reset code updated in database.<br>";

            // Set up PHPMailer
            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'platformapoodle@gmail.com'; // Your SMTP username
            $mail->Password = 'ryru arcb ztie chzb'; // Your App Password (if using 2FA) or SMTP password
            $mail->SMTPSecure = 'tls'; // Encryption - SSL or TLS
            $mail->Port = 587; // SMTP port - 587 for TLS, 465 for SSL

            // Debugging output
            $mail->SMTPDebug = 2; // Enable detailed debugging
            $mail->Debugoutput = 'html'; // Set the format of debug output

            // Email configuration
            $mail->setFrom('platformapoodle@gmail.com', 'Platforma Poodle');
            $mail->addAddress($email);
            $mail->Subject = "Resetare Parola";
            $mail->Body = "Codul tau de resetare a parolei este: $reset_code";

            if ($mail->send()) {
                echo "Email sent successfully.<br>";
                $_SESSION['email'] = $email; // Store email in session to use in verification
                header("Location: password_reset_verify.php"); // Redirect to verify page
                exit;
            } else {
                echo "Eroare la trimiterea email-ului: " . $mail->ErrorInfo;
            }
        } else {
            echo "Eroare la actualizarea codului de resetare.";
        }
    } else {
        echo "Această adresă de email nu este înregistrată.";
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resetare Parola - Platforma de E-Learning Poodle</title>
    <link rel="stylesheet" href="layout.css">
</head>
<body>
    <div class="container">
        <h1>Resetare Parola</h1>
        <form action="password_reset_request.php" method="post">
            <label for="email">Adresa de email:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Trimite Codul de Resetare</button>
        </form>
    </div>
</body>
</html>

<?php
session_start();
ob_start();
include("connect.php");
include("functions.php");
include('PHPMailer.php');
include('SMTP.php');
include('Exception.php');

$signup_message = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);
    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);

    // Validate form input
    if (!empty($user_name) && !empty($password) && !empty($confirm_password) && !empty($user_email) && !is_numeric($user_name)) {
        if ($password === $confirm_password) {
            // Check if the email or username is already used
           $query_check = "SELECT * FROM users WHERE email = '$user_email' OR user_name = '$user_name'";
            $result_check = mysqli_query($con, $query_check);

            if ($result_check) {
                if (mysqli_num_rows($result_check) > 0) {
                    // Determine if the duplicate is an email or username
                    $existing_user = mysqli_fetch_assoc($result_check);
                    if ($existing_user['email'] === $user_email) {
                        $signup_message = 'Adresa de email este deja folosita. Vã rugam sa folositi alta.';
                    } elseif ($existing_user['user_name'] === $user_name) {
                        $signup_message = 'Numele de utilizator este deja folosit. Va rugam sa alegeti altul.';
                    }
                } else {
                    $verification_code = random_num(6);

                    // Store details in the session
                    $_SESSION['verification_code_' . $user_email] = $verification_code;
                    $_SESSION['user_name_' . $user_email] = $user_name;
                    $_SESSION['user_email_' . $user_email] = $user_email;
                    $_SESSION['hashed_password_' . $user_email] = password_hash($password, PASSWORD_DEFAULT);

                    // Send the verification email
                    $mail = new PHPMailer\PHPMailer\PHPMailer();
                    $mail->isSMTP();
                    $mail->SMTPSecure = 'tls';
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'platformapoodle@gmail.com';
                    $mail->Password = 'wpqx nikt bmvt xkia';
                    $mail->Port = 587;

                    $mail->setFrom('platformapoodle@gmail.com', 'platformapoodle');
                    $mail->addAddress($user_email, $user_name);
                    $mail->Subject = 'Confirmation Code';
                    $mail->Body = 'Your confirmation code is: ' . $verification_code;

                    if ($mail->send()) {
                        header("Location: verify.php?user=" . urlencode($user_email));
                        exit;
                    } else {
                        $signup_message = 'E-mailul de verificare nu a putut fi trimis. Vã rugãm sã încerca?i din nou.';
                    }
                }
            } else {
                $signup_message = 'Eroare la interogarea bazei de date: ' . mysqli_error($con);
            }
        } else {
            $signup_message = 'Parolele nu se potrivesc.';
        }
    } else {
        $signup_message = 'Vã rugãm introduce?i informa?ii valide!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        body {
            background-image: url('record.jpeg');
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

        #signup {
            display: block;
            margin-top: 10px;
            font-size: 14px;
            color: #666;
            text-decoration: none;
        }

        #signup:hover {
            color: #444;
        }

        #signup-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div id="box">
        <form method="post">
            <div style="font-size: 24px; margin-bottom: 20px;">Signup</div>
            <input id="text" type="text" name="user_name" placeholder="Username" required>
            <input id="text" type="email" name="user_email" placeholder="Email" required>
            <input id="text" type="password" name="password" placeholder="Password" required>
            <input id="text" type="password" name="confirm_password" placeholder="Confirm Password" required>
            <input id="button" type="submit" value="Signup">
            <a href="login.php" id="signup">Login</a>
            <div id="signup-message">
                <?php echo $signup_message; ?>
            </div>
        </form>
    </div>
</body>
</html>

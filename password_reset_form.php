<?php
session_start();
include("connect.php");

if (!isset($_SESSION['reset_email'])) {
    header("Location: password_reset_verify.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_SESSION['reset_email'];

    $stmt = $con->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expiration = NULL WHERE email = ?");
    
    if (!$stmt) {
        die("Prepare failed: (" . $con->errno . ") " . $con->error);
    }

    $stmt->bind_param("ss", $new_password, $email);
    $stmt->execute();

    echo "Parola a fost resetată cu succes.";
    unset($_SESSION['reset_email']);
    header("Location: login.php"); // Redirect to login page after successful reset
    exit;
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
    <div class="reset-container">
        <h1>Resetare Parola</h1>
        <form action="password_reset_form.php" method="post">
            <label for="password">Parola nouă:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Resetează Parola</button>
        </form>
    </div>
</body>
</html>

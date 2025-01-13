<?php
session_start();
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reset_code = mysqli_real_escape_string($con, $_POST['reset_code']);
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verify the reset code and check expiration
    $stmt = $con->prepare("SELECT id FROM users WHERE reset_token = ? AND reset_expiration > NOW()");
    if ($stmt === false) {
        die("Prepare failed: (" . $con->errno . ") " . $con->error);
    }

    $stmt->bind_param("s", $reset_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $stmt = $con->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expiration = NULL WHERE reset_token = ?");
        if ($stmt === false) {
            die("Prepare failed: (" . $con->errno . ") " . $con->error);
        }

        $stmt->bind_param("ss", $new_password, $reset_code);
        $stmt->execute();

        echo "Parola a fost resetată cu succes.";
        header("Location: login.php"); // Redirect to login page after successful reset
        exit;
    } else {
        echo "Codul de resetare este invalid sau a expirat.";
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
    <div class="reset-container">
        <h1>Resetare Parola</h1>
        <form action="password_reset.php" method="post">
            <label for="reset_code">Cod de resetare:</label>
            <input type="text" id="reset_code" name="reset_code" required>
            <label for="password">Parola nouă:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Resetează Parola</button>
        </form>
    </div>
</body>
</html>

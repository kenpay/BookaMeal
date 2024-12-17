<?php
session_start();
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $reset_code = $_POST['reset_code'];

    // verificare cod si email
    $stmt = $con->prepare("SELECT id FROM users WHERE email = ? AND reset_token = ? AND reset_expiration > NOW()");
    
    if (!$stmt) {
        die("Prepare failed: (" . $con->errno . ") " . $con->error);
    }
    
    $stmt->bind_param("ss", $email, $reset_code);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION['reset_email'] = $email;
        header("Location: password_reset_form.php"); // Redirect la forum
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
    <title>Verificare Cod - Platforma de E-Learning Poodle</title>
    <link rel="stylesheet" href="layout.css">
</head>
<body>
    <div class="reset-container">
        <h1>Verificare Cod</h1>
        <form action="password_reset_verify.php" method="post">
            <label for="email">Adresa de email:</label>
            <input type="email" id="email" name="email" required>
            <label for="reset_code">Cod de resetare:</label>
            <input type="text" id="reset_code" name="reset_code" required>
            <button type="submit">Verifică Codul</button>
        </form>
    </div>
</body>
</html>

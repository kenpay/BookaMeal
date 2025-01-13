<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comentarii = $_POST['comentarii'];
    $evaluare = $_POST['evaluare'];

    // Conectare la baza de date
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Conexiunea a eșuat: " . $conn->connect_error);
    }

    // Salvare feedback în baza de date
    $sql = "INSERT INTO feedback (comentarii, evaluare) VALUES ('$comentarii', '$evaluare')";
    if ($conn->query($sql) === TRUE) {
        echo "Feedback-ul a fost trimis cu succes!";
    } else {
        echo "Eroare: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

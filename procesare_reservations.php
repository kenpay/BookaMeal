<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nume = $_POST['nume'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $data = $_POST['data'];
    $ora = $_POST['ora'];
    $numar_persoane = $_POST['numar_persoane'];

    // Conectare la baza de date
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Conexiunea a eșuat: " . $conn->connect_error);
    }

    // Salvare date în baza de date
    $sql = "INSERT INTO rezervari (nume, email, telefon, data, ora, numar_persoane) VALUES ('$nume', '$email', '$telefon', '$data', '$ora', '$numar_persoane')";
    if ($conn->query($sql) === TRUE) {
        header("Location: confirmation.php");
        exit();
    } else {
        echo "Eroare: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

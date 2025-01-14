<?php
// Include database connection
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $nume = mysqli_real_escape_string($con, $_POST['nume']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $telefon = mysqli_real_escape_string($con, $_POST['telefon']);
    $data = mysqli_real_escape_string($con, $_POST['data']);
    $ora = mysqli_real_escape_string($con, $_POST['ora']);
    $numar_persoane = mysqli_real_escape_string($con, $_POST['numar_persoane']);

    // SQL query to insert reservation data
    $sql = "INSERT INTO rezervari (nume, email, telefon, data, ora, numar_persoane) 
            VALUES ('$nume', '$email', '$telefon', '$data', '$ora', '$numar_persoane')";

    // Execute the query and check for success
    if (mysqli_query($con, $sql)) {
        // Redirect to confirmation page
        header("Location: confirmation.php");
        exit();
    } else {
        // Display error message if query fails
        echo "Eroare: " . $sql . "<br>" . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}
?>
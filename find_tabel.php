<?php
// Database configuration
$host = "localhost";
$dbname = "restaurant";
$username = "root";
$password = "";

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve number of guests from POST data
    $guests = isset($_POST['guests']) ? (int)$_POST['guests'] : 0;

    if ($guests <= 0) {
        echo "Invalid number of guests.";
        exit;
    }

    // Find the best table
    $stmt = $pdo->prepare("SELECT * FROM tables WHERE is_reserved = FALSE AND capacity >= ? ORDER BY capacity ASC LIMIT 1");
    $stmt->execute([$guests]);
    $table = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($table) {
        echo "Best table found: " . $table['table_name'] . " (Capacity: " . $table['capacity'] . ")";
    } else {
        echo "No suitable table available for $guests guests.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
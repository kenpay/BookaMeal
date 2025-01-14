<?php
// Define database credentials
define('DB_HOST', 'sql110.infinityfree.com');
define('DB_USER', 'if0_37159682');
define('DB_PASS', 'yW5LNCoDQ3Tz');
define('DB_NAME', 'if0_37159682_amss');

// Establish a database connection
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check the connection
if (!$con) {
    die("Failed to connect to the database: " . mysqli_connect_error());
}
?>

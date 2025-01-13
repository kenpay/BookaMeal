<?php
session_start();
include("connect.php");
include("functions.php");

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user'];
$user_data = check_login($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Restaurant Dashboard</title>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
	    <script>
        function navigateTo(page) {
            window.location.href = page;
        }
    </script>
	<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background-color: #f8efe4;
            color: #4e342e;
            overflow-x: hidden;
        }

        #container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
        }

        header {
            background: #c0392b;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
        }

        header h1 {
            font-size: 36px;
            letter-spacing: 1px;
        }

        nav ul {
            display: flex;
            justify-content: center;
            margin-top: 15px;
            list-style: none;
        }

        nav ul li {
            margin: 0 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #f8efe4;
        }

        #intro {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        #intro h2 {
            font-size: 28px;
            color: #c0392b;
        }

        #intro p {
            font-size: 18px;
            color: #666;
            margin-top: 10px;
        }

        #dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 20px;
        }

        .card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
            padding: 30px;
            text-align: center;
            position: relative;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
            transform: translateY(-5px);
        }

        .card h3 {
            font-size: 26px;
            color: #c0392b;
            margin-bottom: 15px;
        }

        .card p {
            font-size: 16px;
            color: #4e342e;
            margin-bottom: 20px;
        }

        .card button {
            display: inline-block;
            padding: 12px 20px;
            background-color: #27ae60;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .card button:hover {
            background-color: #1e8449;
            transform: translateY(-3px);
        }

        footer {
            text-align: center;
            margin-top: 50px;
            font-size: 14px;
            color: #666;
        }
    </style>
    <script>
        function navigateTo(page) {
            window.location.href = page;
        }
    </script>
</head>
<body>
<div id="container">
	<?php include 'includes/header.php'; ?>
    <header>
        <h1>BookAMeal</h1>
        
    </header>

    <main>
        <section id="intro">
            <h2>Welcome, <?php echo htmlspecialchars($user_data['user_name']); ?>!</h2>
            <p>De aici poti vedea meniul,rezerva o masa, si comanda mancare pentru masa rezervata la ora rezervata.</p>
        </section>

        <section id="dashboard">
            <div class="card">
                <h3>Menu</h3>
                <p>Update and manage your menu items here.</p>
                <button onclick="navigateTo('menu.php')">Go to Menu</button>
            </div>
            <div class="card">
                <h3>Reservations</h3>
                <p>View and manage customer reservations.</p>
                <button onclick="navigateTo('reservations.php')">View Reservations</button>
            </div>
            <div class="card">
                <h3>Orders</h3>
                <p>Manage customer orders and track their status.</p>
                <button onclick="navigateTo('orders.php')">View Orders</button>
            </div>
        </section>
    </main>
	<?php include 'includes/footer.php'; ?>
</div>
<body>

    
</html>

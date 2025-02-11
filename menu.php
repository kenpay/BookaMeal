<?php
session_start();
include("connect.php");
include("functions.php");
check_access();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meniul Super Sonic</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
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
            padding: 20px;
        }

        #container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        header {
            background: #1e90ff;
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

        header a {
            display: inline-block;
            margin-top: 10px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            background-color: #0056b3;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        header a:hover {
            background-color: #003d80;
        }

        main {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #1e90ff;
            margin-bottom: 20px;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }

        .menu-item {
            background-color: #f8f9fa;
            border: 2px solid #1e90ff;
            border-radius: 12px;
            overflow: hidden;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .menu-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .menu-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .menu-item h3 {
            margin: 10px 0;
            font-size: 20px;
            color: #1e90ff;
        }

        .menu-item p {
            font-size: 16px;
            margin: 10px 0;
        }

        footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
<div id="container">
    <header>
        <h1>Meniul Super Sonic</h1>
        <a href="index.php">Back to Dashboard</a>
    </header>

    <main>
        <h2>Our Specials</h2>
        <div class="menu-grid">
            <div class="menu-item">
                <img src="images/chili-dog.jpg" alt="Chili Dog">
                <h3>Sonic's Speedy Chili Dog</h3>
                <p>$9.99</p>
            </div>
            <div class="menu-item">
                <img src="images/ring-burger.jpg" alt="Golden Ring Burger">
                <h3>Golden Ring Burger</h3>
                <p>$12.99</p>
            </div>
            <div class="menu-item">
                <img src="images/tails-twist.jpg" alt="Tails' Twisty Fries">
                <h3>Tails' Twisty Fries</h3>
                <p>$4.99</p>
            </div>
            <div class="menu-item">
                <img src="images/knuckles-punch.jpg" alt="Knuckles' Power Punch">
                <h3>Knuckles' Power Punch</h3>
                <p>$3.99</p>
            </div>
            <div class="menu-item">
                <img src="images/chaos-salad.jpg" alt="Chaos Emerald Salad">
                <h3>Chaos Emerald Salad</h3>
                <p>$7.99</p>
            </div>
            <div class="menu-item">
                <img src="images/amy-rose.jpg" alt="Amy's Raspberry Swirl">
                <h3>Amy's Raspberry Swirl</h3>
                <p>$6.99</p>
            </div>
            <div class="menu-item">
                <img src="images/eggman-omelette.jpg" alt="Eggman's Mega Omelette">
                <h3>Eggman's Mega Omelette</h3>
                <p>$10.99</p>
            </div>
            <div class="menu-item">
                <img src="images/shadow-steak.jpg" alt="Shadow's Midnight Steak">
                <h3>Shadow's Midnight Steak</h3>
                <p>$14.99</p>
            </div>
            <div class="menu-item">
                <img src="images/super-sonic.jpg" alt="Super Sonic Sundae">
                <h3>Super Sonic Sundae</h3>
                <p>$8.99</p>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Sonic's Diner. Gotta Go Fast for Great Taste!</p>
    </footer>
</div>
</body>
</html>

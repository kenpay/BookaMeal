<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Rezervare masă</title>
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

        header a {
            display: inline-block;
            margin-top: 10px;
            color: #f8efe4;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        header a:hover {
            color: #c0392b;
            background-color: #f8efe4;
            padding: 5px 10px;
            border-radius: 4px;
        }

        main {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        }

        .form-section {
            margin-bottom: 30px;
            text-align: center;
        }

        .form-section h2 {
            color: #c0392b;
            margin-bottom: 15px;
        }

        .form-section form {
            display: inline-flex;
            gap: 10px;
        }

        .form-section input[type="number"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 6px;
            outline: none;
        }

        .form-section button {
            background-color: #27ae60;
            color: white;
            font-size: 16px;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-section button:hover {
            background-color: #1e8449;
        }

        .map-section {
            margin-top: 30px;
            text-align: center;
        }

        .map-section h2 {
            color: #c0392b;
            margin-bottom: 15px;
        }

        .map-container {
            position: relative;
            display: inline-block;
        }

        .map-container img {
            max-width: 100%;
            border: 2px solid #ddd;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        }

        .map-container .table-marker {
            position: absolute;
            background: #27ae60;
            color: white;
            font-size: 14px;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 8px;
            cursor: pointer;
            transform: translate(-50%, -50%);
            transition: background-color 0.3s ease;
        }

        .map-container .table-marker:hover {
            background: #1e8449;
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
    <?php include 'includes/header.php'; ?>
	<header>
        <h1>Manage Reservations</h1>
        <a href="index.php">Back to Dashboard</a>
    </header>

    <main>
		<h1>Rezervare Masă</h1>
		<form action="procesare_reservations.php" method="POST">
			<input type="text" name="nume" placeholder="Nume" required>
			<input type="email" name="email" placeholder="Email" required>
			<input type="tel" name="telefon" placeholder="Telefon" required>
			<input type="date" name="data" required>
			<input type="time" name="ora" required>
			<select name="numar_persoane" required>
				<option value="">Număr persoane</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6+">6+</option>
			</select>
			<button type="submit">Rezervă</button>
		</form>
		<section class="map-section">
				<h2>Restaurant Layout</h2>
				<div class="map-container">
					<img src="resta.png" alt="Restaurant Layout">
					<div class="table-marker" style="top: 20%; left: 30%;">Table 1</div>
					<div class="table-marker" style="top: 50%; left: 50%;">Table 2</div>
					<div class="table-marker" style="top: 80%; left: 70%;">Table 3</div>
				</div>
		</section>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Feedback</title>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <h1>Feedback</h1>
    <form action="procesare_feedback.php" method="POST">
        <textarea name="comentarii" placeholder="Feedback-ul tău" required></textarea>
        <input type="number" name="evaluare" min="1" max="5" placeholder="Evaluare" required>
        <button type="submit">Trimite</button>
    </form>
    <?php include 'includes/footer.php'; ?>
</body>
</html>

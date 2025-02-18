<?php
    include 'connection.php';
    include 'usrData.php';
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="visibility.js" defer></script>
    <title>Contacte</title>
</head>
<body>
    <header>
        <h1>Formulari de Contacte</h1>
        <div>
            <a href="index.php">Pàgina principal</a>
        </div>
    </header>

    <div class="container">
        <div class="form-container">
            <form id="purchase-form" action="process_order.php" method="POST">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($username); ?>" style="display: none;">

                <label for="email">Correu electrònic:</label>
                <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email); ?>" style="display: none;">

                <label for="phone">Telèfon:</label>
                <input type="tel" id="phone" name="phone" required value="<?php echo htmlspecialchars($phone); ?>" style="display: none;">

                <label for="notes">Missatge:</label>
                <textarea id="notes" name="notes" value="null" required></textarea>

                <button type="submit">Confirmar compra</button>
            </form>

        </div>
    </div>

</body>
</html>
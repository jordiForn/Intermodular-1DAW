<?php
    include 'config.php';
    session_start();

    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    $phone = isset($_SESSION['tlf']) ? $_SESSION['tlf'] : '';
?>

<!DOCTYPE html>
<html lang="ca" class="form-page">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulari de Compra</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body class="form-page">

    <header>
        <h1>Formulari de Compra</h1>
        <div>
            <a href="cart.html">Carret</a>
            <a href="index.php">Pàgina principal</a>
        </div>
    </header>
    <div class="container">
        <div class="form-container">
            <form id="purchase-form" action="process_order.php" method="POST">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($username); ?>">

                <label for="email">Correu electrònic:</label>
                <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email); ?>">

                <label for="address">Direcció d’enviament:</label>
                <input type="text" id="address" name="address" required>

                <label for="phone">Telèfon:</label>
                <input type="tel" id="phone" name="phone" required value="<?php echo htmlspecialchars($phone); ?>">

                <label for="notes">Notes adicionals (opcional):</label>
                <textarea id="notes" name="notes"></textarea>

                <input type="hidden" id="cart-data" name="cart_data">
                <input type="hidden" id="cart-total" name="cart_total">

                <button type="submit">Confirmar compra</button>
            </form>

        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>
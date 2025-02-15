<?php
    include 'connection.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $name = $_POST['name'];

        $sql = $conn->prepare(
            "DELETE FROM productes WHERE nom = ?");
    
        $sql->bind_param("s", $name);
    
        if ($sql->execute()) {
            echo "<script>alert('Producte esborrat amb èxit');</script>";
        } else {
            echo "<script>alert('Error: ' . $sql->error);</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Esborrar un producte</title>
</head>
<body>

<header>
        <h1>Canviar producte</h1>
        <div>
            <a href="index.php">Pàgina principal</a>
        </div>
    </header>

<div class="container">
    <h1>Producte a esborrar</h1>
    <form class="form-container" action="delete_product.php" method="POST">
        <div class="form-group">
            <label for="name">Nom del producte</label>
            <input type="text" id="name" name="name" required>
        </div>
            
        <button type="submit">Esborrar producte</button>
    </form>
</body>
</html>
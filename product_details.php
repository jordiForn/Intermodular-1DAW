<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = $conn->prepare("SELECT * FROM productes WHERE id = ?");
    $sql->bind_param("i", $id);

    if ($sql->execute()) {
        $result = $sql->get_result();
        if ($result->num_rows > 0) {
            $producte = $result->fetch_assoc();
        } else {
            echo "No s'ha trobat cap producte amb aquest id.";
            exit;
        }
    } else {
        echo "Error en la consulta de les dades: " . $sql->error;
        exit;
    }

    $sql->close();
    $conn->close();
} else {
    echo "ID no proporcionat.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalls del Producte</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Detalls del Producte</h1>
        <div><a href="index.php">Pàgina principal</a></div>
    </header>

    <div class="product-details">
        <div class="container">
            <h2><?= htmlspecialchars($producte['nom']) ?></h2>
            <img src="images/<?= htmlspecialchars($producte['imatge']) ?>" alt="<?= htmlspecialchars($producte['nom']) ?>">
            <p><?= htmlspecialchars($producte['detalls']) ?></p>
            <p class="price"><?= number_format($producte['preu'], 2, ",", ".") ?>€</p>
            <p class="stock">Estoc disponible: <?= number_format($producte['estoc'], 0, ",", ".") ?></p>
        </div>
    </div>
</body>
</html>
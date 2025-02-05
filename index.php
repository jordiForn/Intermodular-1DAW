<?php
$servername = "localhost";
$username = "root";
$password= "";
$dbname = "jardineria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM productes 
ORDER BY 
    CASE 
        WHEN categoria = 'Plantes i llavors' THEN 1
        WHEN categoria = 'Terra i adobs' THEN 2
        WHEN categoria = 'Ferramentes' THEN 3
        ELSE 4
    END,
    nom;";

$result = $conn->query($sql);

$categories = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categoria = $row["categoria"];
        $categories[$categoria][] = $row;
    }
}
?>


<!DOCTYPE html>
<html lang="ca" class="index-page">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenda de Jardineria</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body class="index-page">

    <header>
        <h1>Tenda de Jardineria</h1>
        <div>
            <a href="#"><i class="fas fa-search"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
            <a href="login.html"><i class="fas fa-user"></i></a>
            <a href="cart.html"><i class="fas fa-shopping-cart"></i></a>
            <a href="#"><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </header>

    <div class="container">
        <h2>Llista de Productes</h2>
        <a href="#service-category">
            <h3>Busques serveis?</h3>
        </a>
        <?php foreach ($categories as $categoria => $productes): ?>
        <div class="product-category">
            <button class="toggle-button"><?= htmlspecialchars($categoria) ?></button>
            <div class="product-list">
                <?php foreach ($productes as $producte): ?>
                    <div class="product-card">
                        <img src="images/<?= htmlspecialchars($producte['imatge']) ?>" alt="<?= htmlspecialchars($producte['nom']) ?>">
                        <h3><?= htmlspecialchars($producte['nom']) ?></h3>
                        <p><?= htmlspecialchars($producte['descripcio']) ?></p>
                        <p class="price"><?= number_format($producte['preu'], 2, ",", ".") ?>€</p>
                        <button onclick="addToCart('<?= addslashes($producte['nom']) ?>', <?= $producte['preu'] ?>)">Afegir al Carret</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
        </div>
    </div>
    
    <div class="container">
    <!-- Sección de Serveis per a Jardins -->
    <div class="service-category" id="service-category-garden">
        <button class="toggle-button">🏡 Serveis per a jardins</button>
        <div class="service-garden">
            <?php
            $sql = "SELECT nom, preu_base FROM servei WHERE cat = 'jardins'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $nom = htmlspecialchars($row["nom"]);
                    $preu_base = number_format($row["preu_base"], 2, ",", "."); 
                    
                    echo "<div class='service-card'>";
                    echo "<h3>$nom</h3>";
                    echo "<p class='price'>$preu_base €/h</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No hi ha serveis disponibles per a jardins.</p>";
            }
            ?>
        </div>
    </div>

    <!-- Sección de Serveis per a Piscines -->
    <div class="service-category" id="service-category-pool">
        <button class="toggle-button">🏊 Serveis per a piscines</button>
        <div class="service-pool">
            <?php
            $sql = "SELECT nom, preu_base FROM servei WHERE cat = 'piscines'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $nom = htmlspecialchars($row["nom"]);
                    $preu_base = number_format($row["preu_base"], 2, ",", "."); 
                    
                    echo "<div class='service-card'>";
                    echo "<h3>$nom</h3>";
                    echo "<p class='price'>$preu_base €/h</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No hi ha serveis disponibles per a piscines.</p>";
            }
            ?>
        </div>
    </div>
</div>

    <script src="script.js"></script>
</body>

</html>
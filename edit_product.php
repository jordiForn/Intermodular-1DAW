<?php
    include 'config.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $image = $_POST['image'];
        $stock = $_POST['stock'];

        $sql = $conn->prepare("UPDATE productes SET preu = ?, descripcio = ?, categoria = ?, imatge = ?, estoc = ? WHERE nom = ?");
        $sql->bind_param("dsssis", $price, $description, $category, $image, $stock, $name);

        if($sql->execute()){
            echo "<script>alert('Producte actualitzat amb èxit');</script>";
        }else{
            echo "<script>alert('Error: ' . $sql->error);</script>";
        }
    }

    $sql = "SELECT DISTINCT categoria FROM productes";

    $result = $conn->query($sql);

    $categories = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categoria = $row["categoria"];
            $categories[] = $categoria;
        }
    } else {
        echo "<script>alert('No hi ha categories disponibles.');</script>";
    }
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Editar un producte</title>
</head>
<body>
    <header>
        <h1>Producte a editar</h1>
        <div>
            <a href="index.php">Pàgina principal</a>
        </div>
    </header>

    <div class="container">
        <h1>Canviar producte</h1>
        <form class="form-container" action="edit_product.php" method="POST">
            <div class="form-group">
                <label for="name">Nom del producte</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="text">Descripció</label>
                <input type="text" id="description" name="description" default="null">
            </div>
            <div class="form-group">
                <label for="price">Preu</label>
                <input type="Number" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="stock">Estoc disponible</label>
                <input type="Number" id="stock" name="stock" required>
            </div>
            <div class="form-group">
                <label for="image">Imatge</label>
                <input type="text" id="image" name="image" default="null">
            </div>
            <div class="form-group">
                <label for="category">Categoria</label>
                <select id="category" name="category">
                    <?php foreach ($categories as $categoria): ?>
                        <option value="<?= htmlspecialchars($categoria) ?>"><?= htmlspecialchars($categoria) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit">Guardar canvis</button>
        </form>
    </div>
</body>
</html>
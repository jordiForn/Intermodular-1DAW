<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $text = $_POST['text'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];

    if (isset($_POST['new-category-name']) && !empty($_POST['new-category-name'])) {
        $newCategoryName = $_POST['new-category-name'];

        $result = $conn->query("SHOW COLUMNS FROM productes LIKE 'categoria'");
        $row = $result->fetch_assoc();
        preg_match("/^enum\((.*)\)$/", $row['Type'], $matches);
        $currentCategories = str_getcsv($matches[1], ",", "'");

        if (!in_array($newCategoryName, $currentCategories)) {
            $currentCategories[] = $newCategoryName;
            $categoriesEnum = "'" . implode("', '", $currentCategories) . "'";

            $conn->query("ALTER TABLE productes MODIFY COLUMN categoria ENUM($categoriesEnum)");
        }

        $category = $newCategoryName;
    }

    $sql = $conn->prepare("INSERT INTO productes (nom, descripcio, preu, estoc, categoria) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param("ssdss", $name, $text, $price, $stock, $category);

    if ($sql->execute()) {
        echo "Nou producte creat amb èxit";
    } else {
        echo "Error: " . $sql->error;
    }
}

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script>
        function toggleNewCategory(){
            const newCategoryDiv = document.getElementById("new-category");
            const newCategoryButton = document.getElementById("NewCategoryButton");
            if (newCategoryDiv.style.display === "none" || newCategoryDiv.style.display === "") {
                newCategoryDiv.style.display = "block";
                newCategoryButton.style.display = "none";
            } else {
                newCategoryDiv.style.display = "none";
                newCategoryButton.style.display = "block";
            }
        }
    </script>
    <title>Nou producte</title>
</head>
<body>
<header>
        <h1>Afegir producte</h1>
        <div>
            <a href="index.php">Pàgina principal</a>
        </div>
    </header>

    <div class="container">
        <h1>Nou producte</h1>
        <form class="form-container" action="new_product.php" method="POST">
            <div class="form-group">
                <label for="name">Nom del producte</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="text">Descripció</label>
                <input type="text" id="text" name="text" required>
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
                <label for="category">Categoria</label>
                <select id="category" name="category">
                    <option value="Plantes i llavors">Plantes i llavors</option>
                    <option value="Terra i adobs">Terra i adobs</option>
                    <option value="Ferramentes">Ferramentes</option>
                </select>
            </div>
            <div class="form-group">
            <button type="button" id="NewCategoryButton" style="display: block;" onclick="toggleNewCategory()">Nova categoria</button>
                <div id="new-category" style="display: none;">
                    <br>
                    <label for="new-category-name">Nom de la nova categoria</label>
                    <input type="text" id="new-category-name" name="new-category-name" placeholder="Nom de la nova categoria">
                    <button type="button" onclick="toggleNewCategory()">Cancel·lar</button>
                </div>
            </div>
            <button type="submit">Crear producte</button>
        </form>
    </div>
</body>
</html>
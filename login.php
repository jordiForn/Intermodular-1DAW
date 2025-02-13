<?php 
    include 'config.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tenda de Jardineria</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body class="login-page">

    <header class="login-page">
        <h1>Tenda de Jardineria</h1>
        <div>
            <a href="index.php">Pàgina principal</a>
        </div>
    </header>

    <div class="container">
        <h1>Iniciar Sessió</h1>
        <form class="form-container" action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Nom d'usuari</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contrasenya</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Iniciar Sessió</button>
        </form>
        <p>Encara no tens un compte? <a href="signup.php">Registra't aquí</a></p>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM client WHERE nombre_login = '$username' AND contrasena = '$password'";
        $result = $conn->query($sql);
        
        if($result->num_rows > 0){
            $_SESSION['username'] = $username;
            header("Location: index.php");
        }else{
            echo "Nom d'usuari o contrasenya incorrectes.";
        }

        $conn->close();
    }
    ?>
    <script src="login.js"></script>
</body>

</html>
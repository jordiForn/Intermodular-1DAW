<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'];
    $cognom = $_POST['cognom'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $rol = $_POST['rol'];

    $sql = $conn->prepare("UPDATE client_dades SET cognom = ?, email = ?, tlf = ?, rol = ? WHERE nom = ?");
    $sql->bind_param("sssss", $cognom, $email, $telefon, $rol, $nom);

    if ($sql->execute()) {
        echo "Usuari actualitzat correctament.";
    } else {
        echo "Error en l'actualització: " . $conn->error;
    }

    $sql->close();
    $conn->close();
}
?>

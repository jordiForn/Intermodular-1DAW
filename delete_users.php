<?php
include 'connection.php';

if (isset($_POST['id'])) {
    $nom = $_POST['id'];

    $sql = $conn->prepare("DELETE FROM client WHERE id = ?");
    $sql->bind_param("i", $id);

    if ($sql->execute()) {
        echo "Usuari eliminat correctament.";
    } else {
        echo "Error en eliminar l'usuari: " . $sql->error;
    }

    $sql->close();
    $conn->close();
}
?>
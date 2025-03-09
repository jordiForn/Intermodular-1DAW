<?php
include 'connection.php';

if (isset($_POST['edit_user'])) {
$id = $_POST['id'];
$nom = $_POST['nom'];
$cognom = $_POST['cognom'];
$email = $_POST['email'];
$telefon = $_POST['telefon'];
$username = $_POST['nom_login'];
$rol = $_POST['rol'];

$sql = $conn->prepare("UPDATE client SET nom = ?, cognom = ?, email = ?, tlf = ?, nom_login = ?, rol = ? WHERE id = ?");
$sql->bind_param("ssssssi", $nom, $cognom, $email, $telefon, $username, $rol, $id);

if ($sql->execute()) {
    echo "Dades actualitzades correctament!";
} else {
    echo "Error al actualitzar les dades: " . $sql->error;
}

$sql->close();
$conn->close();
}
?>

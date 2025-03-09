<?php
include 'connection.php';

if (isset($_POST['edit_user'])) {
$id = $_POST['id'];
$nom = $_POST['nom'];
$cognom = $_POST['cognom'];
$email = $_POST['email'];
$telefon = $_POST['telefon'];
$rol = $_POST['rol'];

$sql = $conn->prepare("UPDATE client SET nom = ?, cognom = ?, email = ?, tlf = ?, rol = ? WHERE id = ?");
$sql->bind_param("sssssi", $nom, $cognom, $email, $telefon, $rol, $id);

if ($sql->execute()) {
    echo "Dades actualitzades correctament!";
} else {
    echo "Error al actualitzar les dades: " . $sql->error;
}

$sql->close();
$conn->close();

}
?>

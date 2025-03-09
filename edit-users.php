<?php
include 'connection.php';
session_start();

$sql = $conn->prepare("SELECT d.nom, d.cognom, d.email, d.tlf, d.rol, c.id FROM client_dades d JOIN client_id c ON d.nom = c.nom");

if (!$sql->execute()) {
    die("Error en la consulta de les dades: " . $sql->error);
}

$result = $sql->get_result();
$users = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}


?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Editar un producte</title>
    <script>
        function editUser(nom, cognom, email, telefon, rol) {
            document.getElementById('edit-nom').value = nom;
            document.getElementById('edit-cognom').value = cognom;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-telefon').value = telefon;
            document.getElementById('edit-rol').value = rol;
            document.getElementById('edit-form').style.display = 'block';

            
        }

        function deleteUser(id) {
            if (confirm("Estàs segur que vols eliminar aquest usuari?")) {
                fetch('delete_users.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'id=' + id
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    location.reload();
                });
            }
        }

        function save(id) {
            document.getElementById('edit-id').value;
            let nom = document.getElementById('edit-nom').value;
            let cognom = document.getElementById('edit-cognom').value;
            let email = document.getElementById('edit-email').value;
            let telefon = document.getElementById('edit-telefon').value;
            let rol = document.getElementById('edit-rol').value;

            console.log(id);
            console.log(nom);
            console.log(cognom);
            console.log(email);
            console.log(telefon);
            console.log(rol);

            fetch('update_users.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `nom=${encodeURIComponent(nom)}&cognom=${encodeURIComponent(cognom)}&email=${encodeURIComponent(email)}&telefon=${encodeURIComponent(telefon)}&rol=${encodeURIComponent(rol)}`
            })
            .then(response => response.text())
            .then(data => {
                alert("Usuari actualitzat correctament");
                location.reload();
            });
        }
    </script>
</head>
<body>
    <header>
        <h1>Canviar producte</h1>
        <div><a href="index.php">Pàgina principal</a></div>
    </header>

    <div class="container">
        <h2>Llista d'usuaris</h2>

        <?php if (!empty($users)): ?>
            <table border="1">
                <tr>
                    <th>Nom</th>
                    <th>Cognom</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>Rol</th>
                    <th>Acció</th>
                </tr>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['nom']) ?></td>
                        <td><?= htmlspecialchars($user['cognom']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['tlf']) ?></td>
                        <td><?= htmlspecialchars($user['rol']) ?></td>
                        <td>
                            <a href="javascript:void(0);" onclick="editUser(

                                '<?= (htmlspecialchars($user['nom'])) ?>', 
                                '<?= (htmlspecialchars($user['cognom'])) ?>', 
                                '<?= (htmlspecialchars($user['email'])) ?>', 
                                '<?= (htmlspecialchars($user['tlf'])) ?>', 
                                '<?= (htmlspecialchars($user['rol'])) ?>'
                            )" class="edit-icon">
                                <i class="fas fa-pencil-alt"></i>
                            </a>

                            <a href="javascript:void(0);" onclick="deleteUser(

                            '<?= (htmlspecialchars($user['id'])) ?>'
                            
                            )" class="delete-icon">
                                <i class="fas fa-trash-alt"></i>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No hi ha usuaris disponibles.</p>
        <?php endif; ?>
    </div>

    <div id="edit-form" style="display: none;">
        <h2>Editar usuaris</h2>
        <form action="update_users.php" method="POST">
            <input type="hidden" id="edit-id" name="id" value="<?= (htmlspecialchars($user['id'])) ?>">
            <label for="edit-nom">Nom:</label>
            <input type="text" id="edit-nom" name="nom" required>
            <label for="edit-cognom">Cognom:</label>
            <input type="text" id="edit-cognom" name="cognom">
            <label for="edit-email">Email:</label>
            <input type="email" id="edit-email" name="email" required>
            <label for="edit-telefon">Telèfon:</label>
            <input type="text" id="edit-telefon" name="telefon" required>
            <label for="edit-rol">Rol:</label>
            <input type="text" id="edit-rol" name="rol" required>
            <button type="submit" name="edit_user" onclick="save(<?= (htmlspecialchars($user['id'])) ?>)">Guardar canvis</button>
        </form>
    </div>
</body>
</html>

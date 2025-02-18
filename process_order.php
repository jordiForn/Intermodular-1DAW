<?php
    include 'connection.php';
    include 'usrData.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $address = $_POST['address'];
        $total = $_POST['cart_total'];
        $date = date('Y-m-d H:i:s');
        $notes = $_POST['notes'];

        $sql = $conn->prepare('INSERT INTO comandes (client_id , data_comanda, direccio_enviament, total) VALUES (?, ?, ?, ?)');
        $sql->bind_param('issd', $id, $date, $address, $total);

        if ($sql->execute() || $sql1->execute()) {
            echo "<script>
                    alert('Comanda processada amb èxit');
                    window.location.href = 'index.php';
                </script>";

        } else {
            echo "Error: " . $sql->error;
        }
    }
    ?>
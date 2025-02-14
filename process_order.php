<?php
    include 'config.php';
    session_start();

    $sql = "SELECT id FROM client WHERE nombre_login = '$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        $id = $user['id'];
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $address = $_POST['address'];
        $total = $_POST['cart_total'];
        $date = date('Y-m-d H:i:s');
    
        $sql = $conn->prepare('INSERT INTO comandes (id_client, data_comanda, direccio_enviament, total) VALUES (?, ?, ?, ?)');
        $sql->bind_param('issd', $id, $date, $address, $total);
    
        if ($sql->execute()) {
            echo "Comanda realitzada amb èxit.";
        } else {
            echo "Error: " . $sql->error;
        }
    }
    ?>
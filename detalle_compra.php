<?php
session_start(); 
include('conf/conn.php');

    $monto_total = $_POST['cantidad'] * $_POST['precio'];
    $insert = $conn -> query("INSERT INTO ventas(id_product, id_user, cantidad, monto, monto_total, stat)
                              VALUES
                              ('".$_POST['id_producto']."', '".$_SESSION['user_id']."', '".$_POST['cantidad']."', '".$_POST['precio']."', '".$monto_total."', 1)");

    if ($insert) {
        echo 'Insertado con exito';
    }else{
        echo 'nel';
    }
 
?>

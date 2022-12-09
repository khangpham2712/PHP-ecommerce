<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $type = $_POST['type'];
        $id = $_POST['id'];
        if($type == 'change') {
            $quantity = $_POST['quantity'];
            $_SESSION['cart'][$id] = $quantity;
        }
        elseif($type == 'remove') {
            unset($_SESSION['cart'][$id]);
        }
    }

?>
<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $quantity = 1;
        if(isset($_POST['quantity'])) $quantity = intval($_POST['quantity']);
        if(array_key_exists($id, $_SESSION['cart'])){
            $_SESSION['cart'][$id] += $quantity;
        }
        else {
            $_SESSION['cart'][$id] = $quantity;
        }
        header('Location: ../cart.php');
    }
    else{
        header('Location: index.php');
    }

?>
<?php
include './core/process.php';
class Cart_Controller
{
    public function getCart()
    {
        if (checkLogin()) {
            if (checkAdmin()) {
                header('Location: admin/home');
            } else {
                include "include/header.php";
            }
        } else {
            header("Location: login");
        }

        $result = array();
        foreach ($_SESSION['cart'] as $id) {
            $product = getProduct($id);
            array_push($result, $product);
        }

        include_once("../cart.php");
        include_once("../cart_content.php");
        include_once("../include/footer.php");
    }

    public function addToCart()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $quantity = 1;
            if (isset($_POST['quantity'])) $quantity = intval($_POST['quantity']);
            if (array_key_exists($id, $_SESSION['cart'])) {
                $_SESSION['cart'][$id] += $quantity;
            } else {
                $_SESSION['cart'][$id] = $quantity;
            }
            header('Location: ../cart.php');
        } else {
            header('Location: ../index.php');
        }
    }
}

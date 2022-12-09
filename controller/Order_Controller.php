<?php
class Order_Controller
{
    public function getOrder()
    {
        if (checkLogin()) {
            if (checkAdmin()) {
                header('Location: admin/home');
            } else {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                } else {
                    header('Location: cart-history');
                }
                include "include/header.php";
            }
        } else {
            header('Location: login');
        }


        $item_list = getCartItem($id);

        include_once("../cart-detail.php");
        include_once("../include/footer.php");
    }
}

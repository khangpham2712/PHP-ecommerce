<?php
include './core/process.php';
class Product_Controller
{
    public function getProduct()
    {
        $USER = 0;
        if (checkLogin()) {
            if (checkAdmin()) {
                header('Location: admin/product-list');
            } else {
                include "include/header.php";
                $USER = 1;
            }
        } else {
            include "include/header_notlogin.php";
        }


        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $conn = newConnection();
            $query = "SELECT * FROM Products WHERE productId=" . $id;
            $result = $conn->query($query);
            $product = $result->fetch_array(MYSQLI_BOTH);
            $name = $product['name'];
            $price = $product['price'];
            $des = $product['des'];
            $url1 = $product['url1'];
            $url2 = $product['url2'];
            $url3 = $product['url3'];
            $url4 = $product['url4'];
            $id = $product['productId'];
            $comment = loadComment($id);

            $conn->close();
        } else {
            header('Location: product-list');
        }

        include_once("../product.php");
        include_once("../comment.php");
        include_once("../include/footer.php");
    }
    public function addProduct()
    {
        if (!checkAdmin()) {
            header('Location: ../login');
        }

        $name = '';
        $price = '';
        $des = '';
        $url1 = '';
        $url2 = '';
        $url3 = '';
        $url4 = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $des = $_POST['des'];
            $url1 = $_POST['url1'];
            $url2 = $_POST['url2'];
            $url3 = $_POST['url3'];
            $url4 = $_POST['url4'];
            $type = $_POST['type'];

            if ($url2 == '') $url2 = $url1;
            if ($url3 == '') $url3 = $url1;
            if ($url4 == '') $url4 = $url1;

            $price = round($price, 2);

            $conn = newConnection();
            $query = "INSERT INTO `Products` (`name`, `price`, `des`, `url1`, `url2`, `url3`, `url4`, `type`) VALUES ('$name', $price, '$des', '$url1', '$url2', '$url3', '$url4', $type)";
            $result = $conn->query($query);
            if ($result) {
                header("Location: product-list");
            } else {
                $success = false;
            }
            $conn->close();
        }
    }

    public function editProduct()
    {
        if (!checkAdmin()) {
            header('Location: ../login');
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $conn = newConnection();
            $query = "SELECT * FROM Products WHERE productId=$id";
            $result = $conn->query($query);
            $product = $result->fetch_array(MYSQLI_BOTH);
            $name = $product['name'];
            $price = $product['price'];
            $des = $product['des'];
            $url1 = $product['url1'];
            $url2 = $product['url2'];
            $url3 = $product['url3'];
            $url4 = $product['url4'];
            $id = $product['productId'];
            $type = $product['type'];
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $des = $_POST['des'];
            $url1 = $_POST['url1'];
            $url2 = $_POST['url2'];
            $url3 = $_POST['url3'];
            $url4 = $_POST['url4'];
            $type = $_POST['type'];


            if ($url2 == '') $url2 = $url1;
            if ($url3 == '') $url3 = $url1;
            if ($url4 == '') $url4 = $url1;

            $price = round($price, 2);

            $conn = newConnection();
            $query = "UPDATE `Products` SET `name`='$name', `price`=$price, `des`='$des', `url1`='$url1', `url2`='$url2', `url3`='$url3', `url4`='$url4', `type`=$type WHERE `productId`=$id";
            $result = $conn->query($query);
            if ($result) {
                header("Location: product.php?id=$id");
            } else {
                $success = false;
            }
            $conn->close();
        }
    }

    public function deleteProduct()
    {
        if (!checkAdmin()) {
            header('Location: ../login');
        }
        $id = $_GET["id"];
        $conn = newConnection();
        $query = "DELETE FROM `Products` WHERE productId=$id";
        $result = $conn->query($query);

        header("Location: product-list");
    }
}

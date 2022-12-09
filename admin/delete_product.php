<?php
    include '../core/process.php';
    if (!checkAdmin()) {
        header('Location: ../login');
    }
    $id = $_GET["id"];
    $conn = newConnection();
    $query = "DELETE FROM `Products` WHERE productId=$id";
    $result = $conn->query($query);

    header("Location: product-list");
?>
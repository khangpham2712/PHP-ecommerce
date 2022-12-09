<?php
    include '../core/process.php';
    if (!checkAdmin()) {
        header('Location: ../login');
    }
    $id = $_GET["id"];
    $conn = newConnection();
    $query = "DELETE FROM `Users` WHERE userId=$id";
    $result = $conn->query($query);

    header("Location: user-list");
?> 
<?php

    include '../core/public.php';

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $conn = newConnection();
        $query = "UPDATE `Users` SET `state`=1 WHERE `userId`=$id";
        $result = $conn->query($query);
        $conn->close();
        if($result){
            echo "<script type='text/javascript'>alert('Mở khóa thành công!');</script>";
            header('Location: user-list');
        }
        else {
            echo "<script type='text/javascript'>alert('Mở khóa không thành công!');</script>";
            header('Location: user-list');
        }
    }
    else {
        header('Location: user-list');
    }

?>
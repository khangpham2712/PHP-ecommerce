<?php

    include '../core/public.php';

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $conn = newConnection();
        $query = "UPDATE `Users` SET `state`=0 WHERE `userId`=$id";
        $result = $conn->query($query);
        $conn->close();
        if($result){
            header('Location: user-list');
        }
        else {
            header('Location: user-list');
        }
    }
    else {
        header('Location: user-list');
    }

?>
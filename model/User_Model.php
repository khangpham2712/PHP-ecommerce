<?php
function addUser($name, $email, $password, $type)
{
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $conn = newConnection();
    $query = "INSERT INTO `Users` (`userName`, `email`, `password`, `type`) VALUES ('$name', '$email','$hash', $type)";
    $result = $conn->query($query);
    $conn->close();
    return $result;
}

function updateUser($name, $password)
{
    $id = $_SESSION['user']['userId'];
    if (checkState($id)) {
        $conn = newConnection();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE `Users` SET `userName`='$name', `password`='$hash' WHERE `userId`=$id";
        $result = $conn->query($query);
        $conn->close();
        return $result;
    } else {
        header('Location:login');
    }
}

function getUserList()
{
    $conn = newConnection();
    $query = "SELECT `userId`, `userName`,`email`,`state` FROM `Users` WHERE `type` = 0";
    $result = $conn->query($query);
    $conn->close();
    return $result;
}

function getUserInfo($userId)
{
    $conn = newConnection();
    $query = "SELECT * FROM `Users` WHERE `userId`=$userId";
    $result = $conn->query($query);
    return $result;
}

<?php
function getInbox()
{
    $conn = newConnection();
    $query = "SELECT * FROM `MessageView`";
    $result = $conn->query($query);
    $conn->close();
    return $result;
}
function setInbox($userId, $msg)
{
    $conn = newConnection();
    $query = "INSERT INTO `Message` (`userId`,`content`) VALUES ($userId, '$msg')";
    $conn->query($query);
    $conn->close();
}

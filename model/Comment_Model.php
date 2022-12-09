<?php
function getComment($id)
{
    $conn = newConnection();
    $query = "SELECT * FROM `CommentView` WHERE `productId`=$id";
    $result = $conn->query($query);
    $conn->close();
    return $result;
}

function addComment($userId, $id, $cmt)
{
    $conn = newConnection();
    $query = "INSERT INTO `Comment` (`userId`,`productId`,`content`) VALUES ($userId, $id, '$cmt')";
    $conn->query($query);
    $conn->close();
}

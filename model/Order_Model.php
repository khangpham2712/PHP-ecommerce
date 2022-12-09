<?php
function getOrderDetail($cartId)
{
    $conn = newConnection();
    $query = "SELECT * FROM `ItemCart` WHERE `cartId`='$cartId'";
    $result = $conn->query($query);
    $conn->close();
    return $result;
}
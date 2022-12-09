<?php
function addRate($id, $rate)
{
    $conn = newConnection();
    $query = "SELECT `rate`, `rateQuantity` FROM Products WHERE `productId`=" . $id;
    $result = $conn->query($query);
    $rateResult = $result->fetch_array(MYSQLI_BOTH);
    $newRate = intval($rateResult['rateQuantity']) * floatval($rateResult['rate']) + intval($rate);
    $newQuantity = intval($rateResult['rateQuantity']) + 1;
    $newRate = round($newRate / $newQuantity, 1);
    $query = "UPDATE `Products` SET `rate`=$newRate, `rateQuantity`=$newQuantity WHERE `productId`=$id";
    $conn->query($query);
    $conn->close();
}

function getRate($id)
{
    $conn = newConnection();
    $query = "SELECT `rate`, `rateQuantity` FROM Products WHERE productId=" . $id;
    $result = $conn->query($query);
    return $result;
}

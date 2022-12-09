<?php
function getCart($userId)
{
    $conn = newConnection();
    if (checkState($userId)) {
        $query = "SELECT * FROM `Cart` WHERE `userId` = $userId";
        $result = $conn->query($query);
        $conn->close();
        return $result;
    } else {
        header('Location: login');
    }
}

function getCartItem($cartId)
{
    $conn = newConnection();
    $query = "SELECT * FROM `ItemCart` WHERE `cartId`='$cartId'";
    $result = $conn->query($query);
    $conn->close();
    return $result;
}

function getAllCart()
{
    $conn = newConnection();
    $query = "SELECT * FROM `CartView`";
    $result = $conn->query($query);
    $conn->close();
    return $result;
}

function addCart($cartId, $userId)
{
    $totalPrice = 0;
    $conn = newConnection();
    $cart = $_SESSION["cart"];
    foreach ($cart as $id => $quantity) {
        $query = "SELECT `price` FROM `Products` WHERE `productId`=$id";
        $result = $conn->query($query);
        $row = $result->fetch_array(MYSQLI_BOTH);
        $totalPrice += $row['price'] * intval($quantity);
    }
    $ship = round($totalPrice * 0.02, 2);
    $totalPrice = round($totalPrice + $ship, 2);
    $query = "INSERT INTO `Cart` (`cartId`, `userId`, `totalPrice`) VALUES ('$cartId', $userId, $totalPrice)";
    $result = $conn->query($query);
    foreach ($cart as $id => $quantity) {
        $query = "SELECT * FROM `Products` WHERE `productId`=$id";
        $result = $conn->query($query);
        $row = $result->fetch_array(MYSQLI_BOTH);
        $name = $row['name'];
        $price = $row['price'];
        $query = "INSERT INTO `ItemCart` (`name`,`price`,`cartId`,`quantity`) VALUES ('$name', $price, '$cartId', $quantity)";
        $result = $conn->query($query);
    }
    $conn->close();
    return $result;
}

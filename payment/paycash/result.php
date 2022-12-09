<?php
include '../../core/auth.php';
if ($_SESSION["cart"] == []) {
    header("Location: ../../product-list");
    return;
}

$userId = $_SESSION['user']['userId'];
$orderId = $_GET["orderId"];
if (checkState($userId)) {
    $success = true;
    $totalPrice = 0;
    $cartId = $orderId;
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
    if (!$result) $success = false;
    foreach ($cart as $id => $quantity) {
        $query = "SELECT * FROM `Products` WHERE `productId`=$id";
        $result = $conn->query($query);
        $row = $result->fetch_array(MYSQLI_BOTH);
        $name = $row['name'];
        $price = $row['price'];
        $query = "INSERT INTO `ItemCart` (`name`,`price`,`cartId`,`quantity`) VALUES ('$name', $price, '$cartId', $quantity)";
        $result = $conn->query($query);
        if (!$result) $success = false;
    }
    $conn->close();

    if ($success) {
        $_SESSION['cart'] = [];
    }
} else {
    header('Location: ../../login');
}
header("Location: ../../cart-detail?id=" . $cartId);

<?php
header('Content-type: text/html; charset=utf-8');
include '../../core/auth.php';

$secretKey = 'uGuV2sJDuN3Kp8WHUEJ5dyvSLWHyrAJC'; //Put your secret key in there

if (!empty($_GET)) {
    $partnerCode = $_GET["partnerCode"];
    $accessKey = $_GET["accessKey"];
    $orderId = $_GET["orderId"];
    $localMessage = $_GET["localMessage"];
    $message = $_GET["message"];
    $transId = $_GET["transId"];
    $orderInfo = $_GET["orderInfo"];
    $amount = $_GET["amount"];
    $errorCode = $_GET["errorCode"];
    $responseTime = $_GET["responseTime"];
    $requestId = $_GET["requestId"];
    $extraData = $_GET["extraData"];
    $payType = $_GET["payType"];
    $orderType = $_GET["orderType"];
    $extraData = $_GET["extraData"];
    $m2signature = $_GET["signature"]; //MoMo signature


    //Checksum
    $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo .
        "&orderType=" . $orderType . "&transId=" . $transId . "&message=" . $message . "&localMessage=" . $localMessage . "&responseTime=" . $responseTime . "&errorCode=" . $errorCode .
        "&payType=" . $payType . "&extraData=" . $extraData;

    $partnerSignature = hash_hmac("sha256", $rawHash, $secretKey);

    echo "<script>console.log('Debug huhu Objects: " . $rawHash . "' );</script>";
    echo "<script>console.log('Debug huhu Objects: " . $partnerSignature . "' );</script>";


    if ($m2signature == $partnerSignature) {
        if ($errorCode == '0') {
            // $result = '<div class="alert alert-success"><strong>Payment status: </strong>Success</div>';
            $userId = $_SESSION['user']['userId'];
            if(checkState($userId)){
                $success = true;
                $totalPrice = 0;
                $cartId = $orderId;
                $conn = newConnection();
                $cart = $_SESSION["cart"];
                foreach($cart as $id => $quantity) {
                    $query = "SELECT `price` FROM `Products` WHERE `productId`=$id";
                    $result = $conn->query($query);
                    $row = $result->fetch_array(MYSQLI_BOTH);
                    $totalPrice += $row['price']*intval($quantity);
                }
                $ship = round($totalPrice*0.02, 2);
                $totalPrice = round($totalPrice + $ship, 2);
                $query = "INSERT INTO `Cart` (`cartId`, `userId`, `totalPrice`) VALUES ('$cartId', $userId, $totalPrice)";
                $result = $conn->query($query);
                if(!$result) $success = false;
                foreach ($cart as $id => $quantity) {
                    $query = "SELECT * FROM `Products` WHERE `productId`=$id";
                    $result = $conn->query($query);
                    $row = $result->fetch_array(MYSQLI_BOTH);
                    $name = $row['name'];
                    $price = $row['price'];
                    $query = "INSERT INTO `ItemCart` (`name`,`price`,`cartId`,`quantity`) VALUES ('$name', $price, '$cartId', $quantity)";
                    $result = $conn->query($query);
                    if(!$result) $success = false;
                }
                $conn->close();

            
                if($success) {
                    $_SESSION['cart'] = [];
                }
            }
            else {
                header('Location: ../../login');
            }
            header("Location: ../../cart-detail?id=".$cartId);
        } else {
            $result = '<div class="alert alert-danger"><strong>Payment status: </strong>' . $message .'/'.$localMessage. '</div>';
            header("Location: ../../cart.php");
        }
    } else {
        $result = '<div class="alert alert-danger">This transaction could be hacked, please check your signature and returned signature</div>';
    }
}

?>
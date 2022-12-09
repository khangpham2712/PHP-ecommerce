<?php
include '../../core/auth.php';
include "../common/helper.php";
header('Content-type: text/html; charset=utf-8');

if (!checkLogin()) {
    header("Location: ../../login");
    return;
}
if ($_SESSION["cart"] == []) {
    sleep(3);
    header("Location: ../../product-list");
    return;
}

$array = parse_ini_file("../config.ini");


$endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";


$partnerCode = $array["partnerCode"];
$accessKey = $array["accessKey"];
$secretKey = $array["secretKey"];
$orderInfo = $array["orderInfo"];
$returnUrl = "http://" . $_SERVER['HTTP_HOST'] . $array["returnUrl"];
$notifyUrl = "http://" . $_SERVER['HTTP_HOST'] . $array["notifyUrl"];
$extraData = $array["extraData"];
$requestType = $array["requestType"];

if (!empty($_POST)) {
    if ($_POST["paymentType"] == "momo") {
        if ($_POST["amount"] < 10000 || $_POST["amount"] > 20000000) {
            sleep(3);
            header("Location: ../../cart.php");
            return;
        }
        $userId = $_SESSION['user']['userId'];
        $orderId = "$userId" . time();
        $amount = $_POST["amount"];
        $requestId = "$userId" . time();
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyUrl . "&extraData=" . $extraData;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'returnUrl' => $returnUrl,
            'notifyUrl' => $notifyUrl,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

        //Just a example, please check more in there

        header('Location: ' . $jsonResult['payUrl']);
    } else if ($_POST["paymentType"] == "cash") {
        $orderId = "$userId" . time();
        header("Location: ../paycash/result.php?orderId=" . $orderId . "&errorCode=" . 0);
    }
}

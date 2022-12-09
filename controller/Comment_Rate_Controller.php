<?php
class Comment_Rate_Controller
{
    public function sendCommentOrRate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userId = $_SESSION['user']['userId'];
            $conn = newConnection();
            if (checkState($userId)) {
                $type = $_POST['type'];
                if ($type == 'rate') {
                    $id = $_POST['id'];
                    $rate = $_POST['rate'];

                    $query = "SELECT `rate`, `rateQuantity` FROM Products WHERE `productId`=" . $id;
                    $result = $conn->query($query);
                    $rateResult = $result->fetch_array(MYSQLI_BOTH);
                    $newRate = intval($rateResult['rateQuantity']) * floatval($rateResult['rate']) + intval($rate);
                    $newQuantity = intval($rateResult['rateQuantity']) + 1;
                    $newRate = round($newRate / $newQuantity, 1);
                    $query = "UPDATE `Products` SET `rate`=$newRate, `rateQuantity`=$newQuantity WHERE `productId`=$id";
                    $conn->query($query);
                    $conn->close();
                } else if ($type == 'cmt') {
                    $id = $_POST['id'];
                    $userId = $_SESSION['user']['userId'];
                    $cmt = $_POST['cmt'];
                    $query = "INSERT INTO `Comment` (`userId`,`productId`,`content`) VALUES ($userId, $id, '$cmt')";
                    $conn->query($query);
                    $conn->close();
                } else if ($type == 'reply') {
                    $cmtId = $_POST['cmtId'];
                    $reply = $_POST['reply'];
                    $adminId = $_POST['userId'];
                    $query = "UPDATE `Comment` SET `adminId` = $adminId, `isReply` = 1, `reply` = $reply WHERE `cmtId`=$cmtId";
                    $conn->query($query);
                    $conn->close();
                } else if ($type == 'msg') {
                    $msg = $_POST['msg'];
                    $query = "INSERT INTO `Message` (`userId`,`content`) VALUES ($userId, '$msg')";
                    $conn->query($query);
                    $conn->close();
                }
            } else {
                header('Location: login');
            }
        }
    }

    public function getComment($id)
    {
        $conn = newConnection();
        $query = "SELECT * FROM `CommentView` WHERE `productId`=$id";
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }

    public function getRate($id)
    {
        $conn = newConnection();
        $query = "SELECT `rate`, `rateQuantity` FROM `Product` WHERE `productId`=$id";
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }
}

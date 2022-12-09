<?php

    include 'auth.php';

    // function process_product(){
    //     if(checkLogin()) {

    //     }
    //     else{
    //         header('Location: login.php');
    //     }
    // }

    function get_HightLight($typeId){
        $conn = newConnection();
        if($typeId == 0)
            $query = "SELECT * FROM Products ORDER BY `rate` DESC LIMIT 3";
        elseif($typeId==15) // Mac
            $query = "SELECT * FROM Products WHERE `type`=1 OR `type`=2 OR `type`=3 ORDER BY `rate` DESC LIMIT 3";
        elseif($typeId==16) // iPad
            $query = "SELECT * FROM Products WHERE `type`=4 OR `type`=5 OR `type`=6 ORDER BY `rate` DESC LIMIT 3";
        elseif($typeId==17) // iPhone
            $query = "SELECT * FROM Products WHERE `type`=7 OR `type`=8 OR `type`=9 ORDER BY `rate` DESC LIMIT 3";
        elseif($typeId==18) // Watch
            $query = "SELECT * FROM Products WHERE `type`=10 OR `type`=11 OR `type`=12 OR `type`=13 ORDER BY `rate` DESC LIMIT 3";
        else
            $query = "SELECT * FROM Products WHERE `type`=$typeId ORDER BY `rate` DESC LIMIT 3";
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }

    function getInbox(){
        $conn = newConnection();
        $query = "SELECT * FROM `MessageView`";
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }

    function searchProduct($id, $q, $price, $begin) {
        $conn = newConnection();
        $query = "SELECT * FROM `Products`";
        if($price) {
            switch(intval($price)){
                case 1:
                    $price1 = 0;
                    $price2 = 10000000;
                    break;
                case 2:
                    $price1 = 10000000;
                    $price2 = 20000000;
                    break;
                case 3:
                    $price1 = 20000000;
                    $price2 = 30000000;
                    break;
                case 4:
                    $price1 = 30000000;
                    $price2 = 40000000;
                    break;
                case 5:
                    $price1 = 40000000;
                    $price2 = 1000000000;
                    break;
                default:
                    $price1 = 0;
                    $price2 = 10000000;
                    break;
            }
        }
        if($id && intval($id)!=0) {
            $query = $query." WHERE `type`=$id";
            if($q){
                $query = $query." AND (`name` LIKE '%$q%' OR `des` LIKE '%$q%')";
                if($price){
                    $query=$query." AND (`price` BETWEEN $price1 AND $price2)";
                }
            }
            else {
                if($price){
                    $query=$query." AND (`price` BETWEEN $price1 AND $price2)";
                }
            }
        }
        else{
            if($q){
                $query = $query." WHERE (`name` LIKE '%$q%' OR `des` LIKE '%$q%')";
                if($price){
                    $query=$query." AND (`price` BETWEEN $price1 AND $price2)";
                }
            }
            else{
                if($price){
                    $query=$query." WHERE (`price` BETWEEN $price1 AND $price2)";
                }
            }
        }
        $query = $query." ORDER BY `rate` DESC LIMIT $begin,6";
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }

    function getUserInfo($userId) {
        $conn = newConnection();
        $query = "SELECT * FROM `Users` WHERE `userId`=$userId";
        $result = $conn->query($query);
        return $result;
    }

    function getAllProduct($id, $q, $price) {
        $conn = newConnection();
        $query = "SELECT * FROM `Products`";
        if($price) {
            switch(intval($price)){
                case 1:
                    $price1 = 0;
                    $price2 = 10000000;
                    break;
                case 2:
                    $price1 = 10000000;
                    $price2 = 20000000;
                    break;
                case 3:
                    $price1 = 20000000;
                    $price2 = 30000000;
                    break;
                case 4:
                    $price1 = 30000000;
                    $price2 = 40000000;
                    break;
                case 5:
                    $price1 = 40000000;
                    $price2 = 1000000000;
                    break;
                default:
                    $price1 = 0;
                    $price2 = 10000000;
                    break;
            }
        }
        if($id && intval($id)!=0) {
            $query = $query." WHERE `type`=$id";
            if($q){
                $query = $query." AND (`name` LIKE '%$q%' OR `des` LIKE '%$q%')";
                if($price){
                    $query=$query." AND (`price` BETWEEN $price1 AND $price2)";
                }
            }
            else {
                if($price){
                    $query=$query." AND (`price` BETWEEN $price1 AND $price2)";
                }
            }
        }
        else{
            if($q){
                $query = $query." WHERE (`name` LIKE '%$q%' OR `des` LIKE '%$q%')";
                if($price){
                    $query=$query." AND (`price` BETWEEN $price1 AND $price2)";
                }
            }
            else{
                if($price){
                    $query=$query." WHERE (`price` BETWEEN $price1 AND $price2)";
                }
            }
        }
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }

    function getProduct($id){
        $conn = newConnection();
        $query = "SELECT * FROM `Products` WHERE `productId`=$id";
        $result = $conn->query($query);
        $conn->close();
        return $result->fetch_array(MYSQLI_BOTH);
    }

    function getCart($userId) {
        $conn = newConnection();
        if(checkState($userId)) {
            $query = "SELECT * FROM `Cart` WHERE `userId` = $userId ORDER BY `time`";
            $result = $conn->query($query);
            $conn->close();
            return $result;
        }
        else {
            header('Location: login');
        }
        
    }

    function getCartItem($cartId){
        // checkCart
        $conn = newConnection();
        // $query = "SELECT `userId` FROM `Cart` WHERE `cartId`=$cartId";
        // $result = $conn->query($query);
        // $row = $result->fetch_array(MYSQLI_BOTH);
        // if($row['userId'] != $_SESSION['user']['userId']){
        //     header('Location: cart_history.php');
        // }
        $query = "SELECT * FROM `ItemCart` WHERE `cartId`='$cartId'";
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }

    function getAllCart() {
        $conn = newConnection();
        $query = "SELECT * FROM `CartView` ORDER BY `time`";
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }

    function checkText255($input) {
        $exp = "/^(\w{3,255})$/";
        return preg_match($exp,$input)==1;
    }

    function addUser($name, $email, $password, $type) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $conn = newConnection();
        $query = "INSERT INTO `Users` (`userName`, `email`, `password`, `type`) VALUES ('$name', '$email','$hash', $type)";
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }

    function updateUser($name, $password){
        $id = $_SESSION['user']['userId'];
        if(checkState($id)){
            $conn = newConnection();
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE `Users` SET `userName`='$name', `password`='$hash' WHERE `userId`=$id";
            $result = $conn->query($query);
            $conn->close();
            return $result;
        }
		else {
            header('Location:login');
        }
    }

    function getUserList() {
        $conn = newConnection();
        $query = "SELECT `userId`, `userName`,`email`,`state` FROM `Users` WHERE `type` = 0";
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }

    function countResult($type){
        $conn = newConnection();
        $query = "SELECT * FROM `Products` WHERE type=$type";
        $result = $conn->query($query);
        $row_count = $result->num_rows;
        $conn->close();
        return $row_count;
    }

    
    function getParams(){
        return !empty( $_GET ) ? $_GET : [];
    }
    
    function buildQuery( $params=array() ){
        $tmp=array();
        foreach( $params as $param => $value ){
            if( is_array( $value ) ){
                foreach( $value as $field => $fieldvalue )$tmp[]=sprintf('%s[]=%s',$param,$fieldvalue);
            } else $tmp[]=sprintf('%s=%s',$param,$value);
        }
        return urldecode( implode( '&', $tmp ) );
    }

?>
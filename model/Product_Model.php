<?php
function getAllProduct($id, $price, $q)
{
    $conn = newConnection();
    $query = "SELECT * FROM `Products`";
    if ($price) {
        switch (intval($price)) {
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
    if ($id && intval($id) != 0) {
        $query = $query . " WHERE `type`=$id";
        if ($q) {
            $query = $query . " AND (`name` LIKE '%$q%' OR `des` LIKE '%$q%')";
            if ($price) {
                $query = $query . " AND (`price` BETWEEN $price1 AND $price2)";
            }
        } else {
            if ($price) {
                $query = $query . " AND (`price` BETWEEN $price1 AND $price2)";
            }
        }
    } else {
        if ($q) {
            $query = $query . " WHERE (`name` LIKE '%$q%' OR `des` LIKE '%$q%')";
            if ($price) {
                $query = $query . " AND (`price` BETWEEN $price1 AND $price2)";
            }
        } else {
            if ($price) {
                $query = $query . " WHERE (`price` BETWEEN $price1 AND $price2)";
            }
        }
    }
    $result = $conn->query($query);
    $conn->close();
    return $result;
}
function getProduct($id)
{
    $conn = newConnection();
    $query = "SELECT * FROM `Products` WHERE `productId`=$id";
    $result = $conn->query($query);
    $conn->close();
    return $result->fetch_array(MYSQLI_BOTH);
}

function searchProduct($id, $q, $price, $begin)
{
    $conn = newConnection();
    $query = "SELECT * FROM `Products`";
    if ($price) {
        switch (intval($price)) {
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
    if ($id && intval($id) != 0) {
        $query = $query . " WHERE `type`=$id";
        if ($q) {
            $query = $query . " AND (`name` LIKE '%$q%' OR `des` LIKE '%$q%')";
            if ($price) {
                $query = $query . " AND (`price` BETWEEN $price1 AND $price2)";
            }
        } else {
            if ($price) {
                $query = $query . " AND (`price` BETWEEN $price1 AND $price2)";
            }
        }
    } else {
        if ($q) {
            $query = $query . " WHERE (`name` LIKE '%$q%' OR `des` LIKE '%$q%')";
            if ($price) {
                $query = $query . " AND (`price` BETWEEN $price1 AND $price2)";
            }
        } else {
            if ($price) {
                $query = $query . " WHERE (`price` BETWEEN $price1 AND $price2)";
            }
        }
    }
    $query = $query . " ORDER BY `rate` DESC LIMIT $begin,6";
    $result = $conn->query($query);
    $conn->close();
    return $result;
}

function get_HightLight($typeId)
{
    $conn = newConnection();
    if ($typeId == 0)
        $query = "SELECT * FROM Products ORDER BY `rate` DESC LIMIT 3";
    elseif ($typeId == 15) // Mac
        $query = "SELECT * FROM Products WHERE `type`=1 OR `type`=2 OR `type`=3 ORDER BY `rate` DESC LIMIT 3";
    elseif ($typeId == 16) // iPad
        $query = "SELECT * FROM Products WHERE `type`=4 OR `type`=5 OR `type`=6 ORDER BY `rate` DESC LIMIT 3";
    elseif ($typeId == 17) // iPhone
        $query = "SELECT * FROM Products WHERE `type`=7 OR `type`=8 OR `type`=9 ORDER BY `rate` DESC LIMIT 3";
    elseif ($typeId == 18) // Watch
        $query = "SELECT * FROM Products WHERE `type`=10 OR `type`=11 OR `type`=12 OR `type`=13 ORDER BY `rate` DESC LIMIT 3";
    else
        $query = "SELECT * FROM Products WHERE `type`=$typeId ORDER BY `rate` DESC LIMIT 3";
    $result = $conn->query($query);
    $conn->close();
    return $result;
}

function addProduct($name, $price, $des, $url1, $url2, $url3, $url4, $type)
{
    $conn = newConnection();
    $query = "INSERT INTO `Products` (`name`, `price`, `des`, `url1`, `url2`, `url3`, `url4`, `type`) VALUES ('$name', $price, '$des', '$url1', '$url2', '$url3', '$url4', $type)";
    $result = $conn->query($query);
    return $result;
}

function updateProduct($id, $name, $price, $des, $url1, $url2, $url3, $url4, $type)
{
    $conn = newConnection();
    $query = "UPDATE `Products` SET `name`='$name', `price`=$price, `des`='$des', `url1`='$url1', `url2`='$url2', `url3`='$url3', `url4`='$url4', `type`=$type WHERE `productId`=$id";
    $result = $conn->query($query);
}

<?php

    include 'public.php';
    session_start();

    

    function checkLogin(){
        return $_SESSION != NULL;
    }

    function checkAdmin() {
        return $_SESSION['user']['type'] == "1";
    }

    function checkPass($pass){
        $id = $_SESSION['user']['userId'];
        $conn = new mysqli('localhost','root','','bk_apple_db');
        $result = $conn->query("SELECT * FROM `Users` WHERE `userId`=$id");
        $row = $result->fetch_array(MYSQLI_BOTH);
        return password_verify($pass, $row['password']);
    }

    function isExistEmail($email) {
        $conn = newConnection();
        $query = "SELECT `email` FROM `Users` WHERE `email`='$email'";
        $result = $conn->query($query);
        return $result->num_rows > 0;
    }


    // function redirectToLogin(){
    //     if($USER_TOKEN == NULL) {
    //         header('Location: login');
    //         exit;
    //     }
    // }

    function Auth($email, $password){
        
        $conn = newConnection();

        $result = $conn->query("SELECT * FROM `Users` WHERE `email`='$email'");
        $row = $result->fetch_array(MYSQLI_BOTH);
        if($row != NULL){
            if(password_verify($password, $row['password'])){
                if($row['state'] == 0) {
                    return 'Tài khoản đang bị khóa.';
                } 
                $_SESSION['user'] = $row;
                $_SESSION['cart'] = [];
                $conn->close();
                header('Location: home');
            }
            else{
                return "Sai mật khẩu";
            }
            
        }
        else {
            return "Không tìm thấy email.";
        }
        $conn->close();
    }


    if(isset($_GET['logout'])){
        session_destroy();
        header('Location: ../login');
    }

    function checkState($id){
        $conn = newConnection();
        $query = "SELECT `state` FROM `Users` WHERE `userId`=$id";
        $result = $conn->query($query);
        $row = $result->fetch_array(MYSQLI_BOTH);
        $conn->close();
        return $row['state'];
    }

?>
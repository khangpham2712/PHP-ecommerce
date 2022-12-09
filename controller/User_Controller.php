<?php
class User_Controller
{
    public function getUserList()
    {
        if (!checkAdmin()) {
            header('Location: ../login');
        }
        include 'include/header.php';

        $user = getUserList();

        include_once("../admin/user_list.php");
        include_once("../admin/include/footer.php");
    }

    public function addUser()
    {
        if (!checkAdmin()) {
            header('Location: ../login');
        }

        $wrongEmail = false;

        $log = -1;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $type = $_POST['type'];
            if (isExistEmail($email)) {
                $log = 2;
            } else {
                $result = addUser($name, $email, $password, $type);
                if ($result) $log = 1;
                else $log = 0;
            }
        }
    }

    public function deleteUser()
    {
        if (!checkAdmin()) {
            header('Location: ../login');
        }
        $id = $_GET["id"];
        $conn = newConnection();
        $query = "DELETE FROM `Users` WHERE userId=$id";
        $result = $conn->query($query);

        header("Location: ../user-list");
    }

    public function lockUser()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $conn = newConnection();
            $query = "UPDATE `Users` SET `state`=0 WHERE `userId`=$id";
            $result = $conn->query($query);
            $conn->close();
            if ($result) {
                header('Location: user-list');
            } else {
                header('Location: user-list');
            }
        } else {
            header('Location: user-list');
        }
    }

    public function unlockUser()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $conn = newConnection();
            $query = "UPDATE `Users` SET `state`=1 WHERE `userId`=$id";
            $result = $conn->query($query);
            $conn->close();
            if ($result) {
                echo "<script type='text/javascript'>alert('Mở khóa thành công!');</script>";
                header('Location: user-list');
            } else {
                echo "<script type='text/javascript'>alert('Mở khóa không thành công!');</script>";
                header('Location: user-list');
            }
        } else {
            header('Location: user-list');
        }
    }
}

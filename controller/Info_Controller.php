<?php
include '../core/process.php';
class Info_Controller
{
    public function getInfo()
    {
        if (checkLogin()) {
            if (checkAdmin()) {
                header('Location: admin/user-info');
            }
        } else {
            header('Location: login');
        }

        $info = getUserInfo($_SESSION["user"]["userId"]);
        include_once("../user_info.php");
        include_once("include/header.php");
    }

    public function EditInfo()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Change info
            $name = $_POST['name'];
            $email = $_POST['email'];
            $oldPass = $_POST['oldPass'];
            $newPass = $_POST['newPass'];
            $confirmPass = $_POST['confirmPass'];
            if (!checkPass($oldPass)) {
                $wrong_pass = true;
            } else {
                if ($newPass != '') $oldPass = $newPass;
                $result = updateUser($name, $oldPass);
                if (!$result) {
                    $log = "Cập nhật thông tin không thành công!";
                } else {
                    $_SESSION['user']['userName'] = $name;
                    $_SESSION['user']['password'] = $oldPass;
                    $log = "Cập nhật thông tin thành công!";
                    $success = 1;
                }
            }
        }
    }
}

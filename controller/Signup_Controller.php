<?php
include '../core/process.php';
class Signup_Controller
{
    public function doSignup()
    {
        $email = "";
        $name = "";

        $isExistEmail = false;
        $noSuccess = false;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $name = $_POST['username'];
            $password = $_POST['password'];

            if (isExistEmail($email)) {
                $isExistEmail = true;
            } else {
                $result = addUser($name, $email, $password, 0);
                if (!$result) {
                    $noSuccess = true;
                } else
                    header('Location: login');
            }
        }
    }
}

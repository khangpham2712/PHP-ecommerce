<?php
include "../core/auth.php";
class Login_Controller
{
    public function doLogin()
    {
        $success = true;
        $log = "";

        $email = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $log = Auth($email, $password);
            $success = false;
        }
    }
    public function doLogout()
    {
        session_destroy();
        header('Location: ../login');
    }
}

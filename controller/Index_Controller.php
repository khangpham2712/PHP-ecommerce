<?php
include "./core/process.php";
class Index_Controller
{
    public function getIndexPage()
    {
        if (checkLogin()) {
            if (checkAdmin()) {
                header('Location: admin/');
            } else {
                include "include/header.php";
            }
        } else {
            include "include/header_notlogin.php";
        }

        for ($i = 15; $i <= 18; $i++) {
            $hightlight = get_HightLight($i);
        }

        include_once("../index.php");
        include_once("../include/footer.php");
    }
}

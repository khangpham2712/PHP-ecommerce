<?php
include '../core/process.php';
class Contact_Controller {
    public function getContact()
    {
        if(checkLogin()){
            if(checkAdmin()) {
              header('Location: admin/home');
            }
            else {
              include "include/header.php";   
            }
                 
          }
          else{
            include "include/header_notlogin.php";
          }
    }
}
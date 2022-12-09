<?php

    function newConnection() {
        $host = "localhost";
        $username = "root";
        $password = '';
        $database = 'bk_apple_db';
        return new mysqli($host, $username, $password, $database);
    }

    // $default_url = "BK_Apple_Store";
?>
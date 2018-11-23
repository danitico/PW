<?php
    if(isset($_COOKIE['login'])){
        unset($_COOKIE['login']);
        setcookie('login', '', time() - 3600);
    }

    if(isset($_COOKIE['admin'])){
        unset($_COOKIE['admin']);
        setcookie('admin', '', time() - 3600);
    }

    header("Location: index.php");

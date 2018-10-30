<?php
    $username = "+-+";
    $secret_word = "I am a computer scientist";
    if (isset($_COOKIE['login'])) {
        list($c_username,$cookie_hash) = explode(',',$_COOKIE['login']);
        if (md5($c_username.$secret_word) == $cookie_hash) {
            $username = $c_username;
        } else {
            echo "Cookie con fallos";
        }
    }

    if ($username != "+-+") {
        print $username;
    } else {
        header("HTTP/1.0 401 Unauthorized");
    }
<?php
    function auth()
    {
        $secret_word = "I am a computer scientist";
        if (isset($_COOKIE['login'])) {
            list($c_username, $cookie_hash) = explode(',', $_COOKIE['login']);
            if (md5($c_username . $secret_word) == $cookie_hash) {
                if (isset($c_username)) {
                    return true;
                } else {
/*                    header("HTTP/1.0 401 Unauthorized");
                    echo "<h1>401 Unauthorized</h1>";*/
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


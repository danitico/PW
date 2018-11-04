<?php
    $secret_word = "I am a computer scientist";
    if (isset($_COOKIE['login'])) {
        list($c_username,$cookie_hash) = explode(',',$_COOKIE['login']);
        if (md5($c_username.$secret_word) == $cookie_hash) {
            $username = $c_username;
            if (isset($username)) {
                print "hola";
            } else {
                header("HTTP/1.0 401 Unauthorized");
                echo "<h1>401 Unauthorized</h1>";
            }
        } else {
            echo "<h1>Cookie con fallos</h1>";
        }
    }
    else{
        header("HTTP/1.0 401 Unauthorized");
        echo "<h1>401 Unauthorized</h1>";
    }

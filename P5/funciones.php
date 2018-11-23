<?php
    $secret_word = "I am a computer scientist";
    function auth()
    {
        if (isset($_COOKIE['login'])) {
            list($c_username, $cookie_hash) = explode(',', $_COOKIE['login']);
            if (md5($c_username . $GLOBALS['secret_word']) == $cookie_hash) {
                if (isset($c_username)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function adminAuth()
    {
        if (isset($_COOKIE['admin'])) {
            list($c_username, $cookie_hash) = explode(',', $_COOKIE['admin']);
            if (md5($c_username . $GLOBALS['secret_word']) == $cookie_hash) {
                if (isset($c_username)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function login($username, $admin){
        if(! isset($_COOKIE['login'])){
            setcookie('login',$username.','.md5($username.$GLOBALS['secret_word']), 0);
        }

        if($admin and ! isset($_COOKIE['admin'])){
            setcookie('admin', "admin" . ',' . md5("admin" . $GLOBALS['secret_word']), 0);
        }

        header("Location: index.php");
    }

    function getUserFromCookie(){
        $usuario = explode(',', $_COOKIE['login']);
        return $usuario[0];
    }

    function isApplied($db, $dni){
        $query = "SELECT * FROM SOLICITUD WHERE DNI LIKE '" . $dni . "';";
        $db->query($query);

        if($db->affected_rows > 0){
            return true;
        }
        else{
            return false;
        }
    }

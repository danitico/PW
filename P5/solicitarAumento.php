<?php
    require '.env.php';
    require 'funciones.php';
    $db = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DATABASE);

    if(auth() and $_GET['usuario'] === getUserFromCookie()){
        if($db->connect_error){
            die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
        }

        $query = "SELECT DNI FROM PERSONAL WHERE USERNAME LIKE '" . $_GET['usuario'] . "';";
        $result = $db->query($query);
        $result = $result->fetch_all(MYSQLI_NUM);

        $query1 = "INSERT INTO SOLICITUD VALUES ('" . $result[0][0] . "','PENDIENTE');";
        $result1 = $db->query($query1);
        $db->close();
        header("Location: index.php");
    }
    else{
        echo '<h1>401 Unauthorized</h1>';
        header("HTTP/1.0 401 Unauthorized");
    }


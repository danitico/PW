<?php
    require '.env.php';
    require 'funciones.php';

    if(adminAuth()){
        $db = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DATABASE);

        $query = "UPDATE SOLICITUD SET ESTADO='ACEPTADA' WHERE DNI LIKE '" . $_GET['dni'] . "';";
        $db->query($query);

        $db->close();
        header("Location: gestionSolicitud.php");
    }
    else{
        echo '<h1>401 Unauthorized</h1>';
        header("HTTP/1.0 401 Unauthorized");
    }
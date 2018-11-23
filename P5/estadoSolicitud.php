<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Estado de la Solicitud</title>
    </head>
    <body>
        <?php
            require 'funciones.php';
            require '.env.php';
            if(auth() and $_GET['usuario'] === getUserFromCookie()) {
                $db = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DATABASE);
                if($db->connect_error){
                    die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
                }

                $query = "SELECT ESTADO FROM SOLICITUD WHERE DNI LIKE '" . $_GET['dni'] . "';";
                $result = $db->query($query);
                $result = $result->fetch_all(MYSQLI_NUM);

                echo '<h3 align="center">SU SOLICITUD DE AUMENTO DE SUELDO ESTÁ: ' . $result[0][0] . '</h3>';
                echo '<br><br>';
                echo '<a href="index.php">Volver al listado</a>';
                $db->close();
            }
            else{
                echo '<h1>401 Unauthorized</h1>';
                header("HTTP/1.0 401 Unauthorized");
            }
        ?>
    </body>
</html>

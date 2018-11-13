<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta title="Borrando ...">
    </head>
    <body>
    <?php
        require '.env.php';
        require 'funciones.php';
        if(auth() and isset($_COOKIE['admin'])){
            $db = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DATABASE);
            if($db->connect_error){
                die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
            }

            $query = "DELETE FROM EMPLEADOS WHERE NOMBRE LIKE " . "'" . $_GET['NOMBRE'] . "';";
            if(!$db->query($query)){
                die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
            }
            else{
                $db->close();
                header("Location: index.php");
                exit;
            }
        }
        else{
            echo '<h1>401 Unauthorized</h1>';
            header("HTTP/1.0 401 Unauthorized");
        }
    ?>
    </body>
</html>

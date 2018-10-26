<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta title="Borrando ...">
    </head>
    <body>
    <?php
        require '.env.php';

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
    ?>
    </body>
</html>

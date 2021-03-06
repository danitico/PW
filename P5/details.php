<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            <?php
                echo $_GET['NOMBRE'] . "\n";
            ?>
        </title>
    </head>
    <body>
        <ul>
        <?php
            require '.env.php';
            require 'funciones.php';
            if(! auth()){
                echo '<h1>401 Unauthorized</h1>';
                header("HTTP/1.0 401 Unauthorized");
            }
            else {
                $db = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DATABASE);

                if ($db->connect_error) {
                    die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
                }

                $query = "SELECT DNI,EDAD,DEPARTAMENTO FROM PERSONAL WHERE NOMBRE LIKE " . "'" . $_GET['NOMBRE'] . "'" . ";";
                $results = $db->query($query);
                $results = $results->fetch_all(MYSQLI_NUM);

                echo "\t<li><strong>Nombre:</strong>" . $_GET['NOMBRE'] . "</li>\n";
                echo "\t\t<li><strong>DNI:</strong>" . $results[0][0] . "</li>\n";
                echo "\t\t<li><strong>Edad:</strong>" . $results[0][1] . "</li>\n";
                echo "\t\t<li><strong>Departamento:</strong>" . $results[0][2] . "</li>\n";

                $db->close();
            }
        ?>
        </ul>
        <br><br>
        <a href="index.php">Volver al listado</a>
    </body>
</html>

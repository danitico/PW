<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Estado de la Solicitud</title>
    </head>
    <body>
        <?php
            require '.env.php';
            require 'funciones.php';
            if(adminAuth()) {
                $db = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DATABASE);

                $query = "SELECT DNI FROM SOLICITUD WHERE ESTADO LIKE 'PENDIENTE'";
                $results = $db->query($query);
                $results = $results->fetch_all(MYSQLI_NUM);

                if ($db->affected_rows != 0) {
                    echo '<h2 align="center">SOLICITUDES</h2>';
                    echo '<table border="2" align="center">';
                    echo '<tr>';
                    echo '<th>DNI</th>';
                    echo '<th>Acción 1</th>';
                    echo '<th>Acción 2</th>';
                    echo '</tr>';

                    foreach ($results as $result) {
                        echo '<tr>';
                        echo '<td>' . $result[0] . '</td>';
                        echo '<td><a href="aceptar.php?dni=' . $result[0] . '">Aceptar</a></td>';
                        echo '<td><a href="denegar.php?dni=' . $result[0] . '">Denegar</a></td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo '<h2 align="center">NO HAY SOLICITUDES PENDIENTES</h2>';
                }
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

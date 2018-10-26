<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Listado de empleados</title>
    </head>
    <body>
        <table border="2">
            <tr>
                <th>Número de empleado</th>
                <th>Nombre del empleado</th>
            </tr>

            <?php
                /*require '.env.php';*/

                $db = new mysqli(getenv('SERVERNAME'), getenv('USERNAME'), getenv('PASSWORD'), getenv('DATABASE'));

                if($db->connect_error){
                    die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
                }


                $query = "SELECT NOMBRE FROM EMPLEADOS";
                $results = $db->query($query);
                $results = $results->fetch_all(MYSQLI_NUM);
                $i = 1;

                foreach ($results as $name){
                    echo "<tr>\n<td>$i</td>\n";
                    echo "<td>\n";
                    echo '<a href="details.php?NOMBRE=' . urlencode($name[0]) . '">';
                    echo $name[0] . '</a>';
                    echo "</td></tr>";
                    $i++;
                }

                $db->close();
            ?>
        </table>
    </body>
</html>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Listado de empleados</title>
    </head>
    <body>
        <table border="2" align="center">
            <tr>
                <th>Número de empleado</th>
                <th>Nombre del empleado</th>
                <th>Acción 1</th>
                <th>Acción 2</th>
            </tr>

            <?php
                require '.env.php';
                $db = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DATABASE);

                if($db->connect_error){
                    die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
                }


                $query = "SELECT NOMBRE FROM EMPLEADOS";
                $results = $db->query($query);
                $results = $results->fetch_all(MYSQLI_NUM);
                $i = 1;

                foreach ($results as $name){
                    echo "<tr>\n<td>$i</td>\n";
                    echo '<td><a href="details.php?NOMBRE=' . urlencode($name[0]) . '">' . $name[0] . '</a></td>';
                    echo '<td><a href="delete.php?NOMBRE=' . urlencode($name[0]) . '">' . "Borrar" . '</a></td>';
                    echo '<td><a href="modify.php?NOMBRE=' . urlencode($name[0]) . '">' . "Modificar" . '</a></td>';
                    echo "</tr>";
                    $i++;
                }

                $db->close();
            ?>
        </table>
        <br>
        <div align="center">
            <form style="display: inline"  action="insert.php" method="get">
                <button>Añadir empleado</button>
            </form>
        </div>
    </body>
</html>

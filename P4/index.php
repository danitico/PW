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
                require 'comprobacion.php';
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
                    if(auth()) {
                        echo '<td><a href="delete.php?NOMBRE=' . urlencode($name[0]) . '">' . "Borrar" . '</a></td>';
                        echo '<td><a href="modify.php?NOMBRE=' . urlencode($name[0]) . '">' . "Modificar" . '</a></td>';
                    }
                    else{
                        echo '<td></td>';
                        echo '<td></td>';
                    }
                    echo "</tr>";
                    $i++;
                }

                $db->close();
            ?>
        </table>
        <br>
        <div align="center">
            <?php
                if(auth()) {
                    echo '<form style="display: inline"  action="insert.php" method="get">';
                    echo '<button>Añadir empleado</button>';
                    echo '</form>';

                    echo '<form style="display: inline"  action="auth.php" method="get">';
                    echo '<button>Cerrar sesión</button>';
                    echo '</form>';
                }
                else{
                    echo '<form style="display: inline"  action="auth.php" method="get">';
                    echo '<button>Iniciar sesión</button>';
                    echo '</form>';
                }
            ?>
        </div>
    </body>
</html>

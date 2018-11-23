<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Listado de empleados</title>
    </head>
    <body>
        <h2 align="center">EMPLEADOS</h2>
        <table border="2" align="center">
            <tr>
                <th>Número de empleado</th>
                <th>Nombre del empleado</th>
                <th>Acción 1</th>
                <th>Acción 2</th>
                <th>Acción 3</th>
            </tr>

            <?php
                require '.env.php';
                require 'funciones.php';
                $db = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DATABASE);

                if($db->connect_error){
                    die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
                }


                $query = "SELECT NOMBRE, USERNAME, DNI FROM PERSONAL WHERE NOMBRE NOT LIKE 'Administrador'";
                $results = $db->query($query);
                $results = $results->fetch_all(MYSQLI_NUM);
                $i = 1;

                foreach ($results as $result){
                    echo "<tr>\n<td>$i</td>\n";
                    if(adminAuth()) {
                        echo '<td><a href="details.php?NOMBRE=' . urlencode($result[0]) . '">' . $result[0] . '</a></td>';
                        echo '<td><a href="delete.php?NOMBRE=' . urlencode($result[0]) . '">' . "Borrar" . '</a></td>';
                        echo '<td><a href="modify.php?NOMBRE=' . urlencode($result[0]) . '">' . "Modificar" . '</a></td>';
                        echo '<td></td>';
                    }
                    else if(auth()){
                        echo '<td><a href="details.php?NOMBRE=' . urlencode($result[0]) . '">' . $result[0] . '</a></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td>';
                            if($result[1] === getUserFromCookie()){
                                if(! isApplied($db, $result[2])) {
                                    echo '<a href="solicitarAumento.php?usuario=' . urlencode($result[1]) . '">Solicitar Aumento</a>';
                                }
                                else{
                                    echo '<a href="estadoSolicitud.php?usuario=' . urlencode($result[1]) . '&dni=' . urlencode($result[2]) . '">Status Aumento</a>';
                                }
                            }
                        echo '</td>';
                    }
                    else{
                        echo '<td>' . $result[0] . '</td>';
                        echo '<td></td>';
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
                if(auth() and adminAuth()) {
                    echo '<form style="display: inline"  action="insert.php" method="get">';
                    echo '<button>Añadir empleado</button>';
                    echo '</form>';

                    echo '<form style="display: inline"  action="gestionSolicitud.php" method="get">';
                    echo '<button>Gestionar Solicitudes</button>';
                    echo '</form>';

                    echo '<form style="display: inline" action="logout.php" method="get">';
                    echo '<button>Cerrar sesión</button>';
                    echo '</form>';
                }
                else if(auth()){
                    echo '<form style="display: inline" action="logout.php" method="get">';
                    echo '<button>Cerrar sesión</button>';
                    echo '</form>';
                }
                else {
                    echo '<form style="display: inline"  action="auth.php" method="get">';
                    echo '<button>Iniciar sesión</button>';
                    echo '</form>';
                }
            ?>
        </div>
    </body>
</html>

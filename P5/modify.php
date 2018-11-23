<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta title="Modificar empleado">
    </head>
    <body>
        <?php
            require 'Trabajador.php';
            require '.env.php';
            require 'funciones.php';

            if(! adminAuth()){
                echo '<h1>401 Unauthorized</h1>';
                header("HTTP/1.0 401 Unauthorized");
            }
            else {
                echo '<h3 align="center">Modificación del empleado</h3>';
                if(isset($_GET['CONF'])){
                    echo "<div align='center'><p><font color=red>" . $_GET['CONF'] . "</font></p></div>";
                }
                $db = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DATABASE);

                if ($db->connect_error) {
                    die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
                }

                $query = "SELECT DNI,EDAD,DEPARTAMENTO FROM PERSONAL WHERE NOMBRE LIKE " . "'" . $_GET['NOMBRE'] . "'" . ";";
                $results = $db->query($query);
                $results = $results->fetch_all(MYSQLI_NUM);

                if (isset($_POST['submit'])) {
                    $empleado = new Trabajador($_POST['nombre'], $_POST['dni'], $_POST['edad'], $_POST['departamento']);

                    $query1 = "SELECT * FROM PERSONAL WHERE DNI=" . "'" . $empleado->getDNI() . "' AND NOMBRE NOT LIKE '" . $_GET['NOMBRE'] . "';";
                    $query_empleado = $db->query($query1);
                    $query_empleado = $query_empleado->fetch_all(MYSQLI_NUM);

                    if ($db->connect_error) {
                        die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
                    } else {
                        if($db->affected_rows != 0) {
                            $message = "Ese DNI ya existe en la BD";
                            $db->close();
                            header("Location: modify.php?NOMBRE=" . urlencode($_GET['NOMBRE']) . "&CONF=" . urlencode($message));
                        }
                    }

                    $query = "UPDATE EMPLEADOS SET NOMBRE=\"" . (string)$empleado->getNombre() . "\", DNI=\"" . (string)$empleado->getDNI() . "\", EDAD=" . $empleado->getEdad() . ", DEPARTAMENTO=\"" . utf8_decode($empleado->getDepartamento()) . "\" WHERE NOMBRE LIKE " . "'" . $_GET['NOMBRE'] . "'" . ";";

                    $flag = $db->query($query);

                    if (! $flag) {
                        die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
                    } else {
                        $db->close();
                        header("Location: index.php");
                    }
                }


                echo '<div align="center">';
                echo '<form method="post" action="">';
                echo '<label for="nombre">Nombre</label><br>';
                echo '<input type="text" name="nombre" value="' . $_GET['NOMBRE'] . '" required><br>';

                echo '<label for="dni">DNI</label><br>';
                echo '<input type="text" name="dni" value="' . $results[0][0] . '" required><br>';

                echo '<label for="edad">Edad</label><br>';
                echo '<input type="number" name="edad" value="' . $results[0][1] . '" required><br>';

                echo '<label for="departamento">Departamento</label><br>';
                echo '<input type="text" name="departamento" value="' . utf8_encode($results[0][2]) . '" required><br><br>';

                echo '<input name="submit" type="submit" value="Modificar Empleado">';
                echo '<input type="reset" value="Recuperar valores originales" />';
                echo '</form></div>';
            }
        ?>
    </body>
</html>

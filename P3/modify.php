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

            $db = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DATABASE);

            if($db->connect_error){
                die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
            }

            $query = "SELECT DNI,EDAD,DEPARTAMENTO FROM EMPLEADOS WHERE NOMBRE LIKE " . "'" . $_GET['NOMBRE'] . "'" . ";";
            $results = $db->query($query);
            $results = $results->fetch_all(MYSQLI_NUM);


            echo '<div align="center">';
            echo '<form method="post" action="">';
            echo '<label for="nombre">Nombre</label><br>';
            echo '<input type="text" name="nombre" value="' . $_GET['NOMBRE'] . '" required><br>';

            echo '<label for="dni">DNI</label><br>';
            echo '<input type="text" name="dni" value="' . $results[0][0] . '" required><br>';

            echo '<label for="edad">Edad</label><br>';
            echo '<input type="text" name="edad" value="' . $results[0][1] . '" required><br>';

            echo '<label for="departamento">Departamento</label><br>';
            echo '<input type="text" name="departamento" value="' . utf8_encode($results[0][2]) . '" required><br><br>';

            echo '<input name="submit" type="submit" value="Modificar Empleado">';
            echo '<input type="reset" value="Recuperar valores originales" />';
            echo '</form></div>';

            if(isset($_POST['submit'])) {
                $empleado = new Trabajador($_POST['nombre'], $_POST['dni'], $_POST['edad'], $_POST['departamento']);

                $query = "UPDATE EMPLEADOS SET NOMBRE=\"" . (string)$empleado->getNombre() . "\", DNI=\"" . (string)$empleado->getDNI() . "\", EDAD=" . $empleado->getEdad() . ", DEPARTAMENTO=\"" . utf8_decode($empleado->getDepartamento()) . "\" WHERE NOMBRE LIKE " . "'" . $_GET['NOMBRE'] . "'" . ";";

                if (!$db->query($query)) {
                    die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
                } else {
                    $db->close();
                    header("Location: index.php");
                    exit;
                }
            }
        ?>
    </body>
</html>

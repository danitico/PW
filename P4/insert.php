<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta title="Añadir empleado">
    </head>
    <body>
        <?php
            require 'Trabajador.php';
            require '.env.php';
            if(! auth()){
                echo '<h1>401 Unauthorized</h1>';
                header("HTTP/1.0 401 Unauthorized");
            }
            else {
                echo '<div align="center">';
                echo '<form method="post" action="">';
                echo '<label for="nombre">Nombre</label><br>';
                echo '<input type="text" name="nombre" required><br>';

                echo '<label for="dni">DNI</label><br>';
                echo '<input type="text" name="dni" required><br>';

                echo '<label for="edad">Edad</label><br>';
                echo '<input type="number" name="edad" required><br>';

                echo '<label for="departamento">Departamento</label><br>';
                echo '<input type="text" name="departamento" required><br><br>';

                echo '<input name="submit" type="submit" value="Añadir">';
                echo '</form>';
                echo '</div>';

                if (isset($_POST['submit'])) {
                    $empleado = new Trabajador($_POST['nombre'], $_POST['dni'], $_POST['edad'], $_POST['departamento']);


                    $db = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DATABASE);

                    if ($db->connect_error) {
                        die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
                    }

                    $query = "INSERT INTO EMPLEADOS VALUES (\"" . (string)$empleado->getNombre() . "\",\"" . (string)$empleado->getDNI() . "\"," . (int)$empleado->getEdad() . ",\"" . (string)$empleado->getDepartamento() . "\");";
                    if (!$db->query($query)) {
                        die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
                    } else {
                        $db->close();
                        header("Location: index.php");
                        exit;
                    }
                }
            }
        ?>
    </body>
</html>

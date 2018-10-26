<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta title="Añadir empleado">
    </head>
    <body>
        <div align="center">
            <form method="post" action="">
                <label for="nombre">Nombre</label><br>
                <input type="text" name="nombre" required><br>

                <label for="dni">DNI</label><br>
                <input type="text" name="dni" required><br>

                <label for="edad">Edad</label><br>
                <input type="number" name="edad" required><br>

                <label for="departamento">Departamento</label><br>
                <input type="text" name="departamento" required><br><br>

                <input name="submit" type="submit" value="Añadir">
            </form>
        </div>
        <?php
            require 'Trabajador.php';
            require '.env.php';

            if(isset($_POST['submit'])) {
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
        ?>
    </body>
</html>

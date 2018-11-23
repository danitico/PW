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
            require 'funciones.php';
            if(! adminAuth()){
                echo '<h1>401 Unauthorized</h1>';
                header("HTTP/1.0 401 Unauthorized");
            }
            else {
                echo '<h3 align="center">AÑADIR NUEVO EMPLEADO</h3>';
                echo '<div align="center">';
                echo '<form method="post" action="">';
                echo '<label for="nombre">Nombre</label><br>';
                echo '<input type="text" name="nombre" required><br>';

                echo '<label for="dni">DNI</label><br>';
                echo '<input type="text" name="dni" required><br>';

                echo '<label for="edad">Edad</label><br>';
                echo '<input type="number" name="edad" required><br>';

                echo '<label for="departamento">Departamento</label><br>';
                echo '<input type="text" name="departamento" required><br>';

                echo '<label for="username">Username</label><br>';
                echo '<input type="text" name="username" required><br>';

                echo '<label for="passwd">Password</label><br>';
                echo '<input type="password" name="passwd" required><br>';

                echo '<input name="submit" type="submit" value="Añadir">';
                echo '</form>';
                echo '</div>';

                if (isset($_POST['submit'])) {
                    $empleado = new Trabajador($_POST['nombre'], $_POST['dni'], $_POST['edad'], $_POST['departamento']);

                    $db = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DATABASE);

                    if ($db->connect_error) {
                        die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
                    }

                    $query = "SELECT * FROM PERSONAL WHERE USERNAME LIKE '" . $_POST['username'] . "' OR DNI LIKE '" . $empleado->getDNI() . "';";
                    $result = $db->query($query);
                    if (!$result) {
                        die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
                    }
                    else{
                        if ($db->affected_rows === 0){
                            $encrypted_password = password_hash($_POST['passwd'], PASSWORD_DEFAULT);

                            $query = "INSERT INTO PERSONAL VALUES ('" . $empleado->getNombre() . "','" . (string)$empleado->getDNI() . "'," . (int)$empleado->getEdad() . ",'" . (string)$empleado->getDepartamento() . "','" . $_POST['username'] . "','" . $encrypted_password . "');";
                            if (!$db->query($query)) {
                                die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
                            } else {
                                $db->close();
                                header("Location: index.php");
                                exit;
                            }
                        }
                        else{
                            echo "<div align='center'><p><font color=red>El usuario o el dni ya existe</font></p></div>";
                            $db->close();
                        }
                    }
                }
            }
        ?>
    </body>
</html>

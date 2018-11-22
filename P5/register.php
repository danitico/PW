<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Registro</title>
    </head>
    <body>
        <h3 align="center">REGISTRO</h3>
        <br>
        <?php
            require '.env.php';

            if(isset($_POST['submit'])) {
                $db = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DATABASE);

                if ($db->connect_error) {
                    die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
                }

                $query = "SELECT * FROM USUARIOS WHERE USERNAME LIKE '" . $_POST['username'] . "';";
                $result = $db->query($query);
                if (!$result) {
                    die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
                }
                else{
                    if ($db->affected_rows === 0){
                        $encrypted_password = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
                        $query = "INSERT INTO USUARIOS VALUES ('" . $_POST['username'] . "', '" . $encrypted_password . "');";
                        $result = $db->query($query);
                        if(!$result){
                            die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
                        }
                        else{
                            $confirmacion = "Usuario registrado correctamente";
                            $db->close();
                            header("Location: auth.php?conf=" . urlencode($confirmacion));
                        }
                    }
                    else{
                        echo "<div align='center'><p><font color=red>El usuario " . $_POST['username'] . " ya existe</font></p></div>";
                        $db->close();
                    }
                }
            }
        ?>
        <div align="center">
            <form method="post" action="">
                <label for="username">Username</label><br>
                <input type="text" name="username" required><br>

                <label for="passwd">Password</label><br>
                <input type="password" name="passwd" required><br>

                <br><input name="submit" type="submit" value="Registrarse">
            </form>
        </div>
    </body>
</html>

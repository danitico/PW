<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Página Principal</title>
    </head>
    <body>
    <br>
    <?php
    require '.env.php';

    if(isset($_POST['submit'])) {
        $db = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DATABASE);

        if ($db->connect_error) {
            die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
        }

        $query = "SELECT PASSWORD FROM USUARIOS WHERE USERNAME LIKE " . "'" . $_POST['username'] . "';";
        if (!$db->query($query)) {
            die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
        }
        else{
            if ($db->affected_rows === 0){
                echo "<div align='center'><p><font color=red>El usuario " . $_POST['username'] . " no existe</font></p></div>";

                $db->close();
                /*header("location: index.php");*/
            }
            else{
                echo "hola";
            }
            /*header("Location: uco.es");*/
            /*exit;*/
        }
    }

    ?>
    <div align="center">
        <form method="post" action="">
            <label for="username">Username</label><br>
            <input type="text" name="username" required><br>

            <label for="passwd">Password</label><br>
            <input type="password" name="passwd" required><br>

            <br><input name="submit" type="submit" value="Entrar">
        </form>
    </div>
    <div align="center">
        <form style="display: inline"  action="register.php" method="post">
            <button>Crear una cuenta</button>
        </form>
    </div>
    </body>
</html>

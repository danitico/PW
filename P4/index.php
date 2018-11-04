<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Authentication</title>
    </head>
    <body>
    <br>
    <?php
    require '.env.php';
    if(isset($_GET['conf'])){
        echo "<div align='center'><p><font color=green>" . $_GET['conf'] . "</font></p></div>";
    }

    if(isset($_POST['submit'])) {
        $db = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DATABASE);

        if ($db->connect_error) {
            die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
        }

        $query = "SELECT PASSWORD FROM USUARIOS WHERE USERNAME LIKE " . "'" . $_POST['username'] . "';";
        $result = $db->query($query);
        if (!$result) {
            die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
        }
        else{
            if ($db->affected_rows === 0){
                echo "<div align='center'><p><font color=red>El usuario " . $_POST['username'] . " no existe</font></p></div>";
                $db->close();
            }
            else{
                $result = $result->fetch_all(MYSQLI_NUM);

                if(password_verify($_POST['passwd'], $result[0][0])){
                    $secret_word = "I am a computer scientist";
                    setcookie('login',$_POST['username'].','.md5($_POST['username'].$secret_word), 0);
                    header("Location: prueba.php");
                }
                else{
                    echo "<div align='center'><p><font color=red>Contraseña equivocada</font></p></div>";
                }
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

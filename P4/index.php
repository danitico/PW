<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Página Principal</title>
    </head>
    <body>
    <br>
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
        <form style="display: inline"  action="register.php" method="get">
            <button>Crear una cuenta</button>
        </form>
    </div>

    </body>
</html>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index.php</title>
</head>
<body>

	<?php

		include "consultas.php";
        $tipoUsuario = null;
        if(isset($_POST["entrar"])) {
            $nombre = $_POST["nombre"];
            $correo = $_POST["correo"];
            $tipoUsuario = tipoUsuario($nombre, $correo);
            setcookie("tipoUsuario", $tipoUsuario, time() + 3600);
            switch ($tipoUsuario) {
                case "superadmin":
                    echo "<h1>Bienvenido, $nombre </h1>";
                    echo "<p>Puedes acceder a: <a href='usuarios.php'>usuarios</a></p>";
                    break;
                case "autorizado":
                    echo "<h1>Bienvenido, $nombre </h1>";
                    echo "<p>Puedes acceder a: <a href='articulos.php'>articulos</a></p>";
                    break;
                case "registrado":
                    echo "<h1>Bienvenido, $nombre </h1>";
                    echo "<p>No tienes permisos.</p>";
                    break;
                default:
                    echo "No estás registrado";
            }
        }
	?>

    <form action="index.php" method="POST">
        <label>Correo: <input type="email" name="correo" /></label>
        <br />
        <label>Nombre: <input type="text" name="nombre" /></label>
        <br />
        <input type="submit" value="Entrar" name="entrar" />
    </form>
</body>
</html>
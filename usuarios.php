<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Usuarios</title>
</head>
<body>

	<?php 

		include "funciones.php";
        if(!isset($_COOKIE["tipoUsuario"]) || $_COOKIE["tipoUsuario"] !== "superadmin"){
            die("No tienes permisos de acceso a esta pagina.");
        }
	?>

    <?php
        if(isset($_POST["permisos"])){
            cambiarPermisos();
        }
    ?>
    <p>Permisos actuales: <?= getPermisos() ?></p>
    <form action="usuarios.php" method="POST">
        <input type="submit" value="Cambiar permisos" name="permisos" />
    </form>

    <?php pintaTablaUsuarios() ?>
    <a href="index.php">volver a index.php</a>
</body>
</html>
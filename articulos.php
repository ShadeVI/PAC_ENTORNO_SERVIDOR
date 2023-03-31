<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Articulos</title>
</head>
<body>

	<?php 

		include "funciones.php";
        if(!isset($_COOKIE["tipoUsuario"]) || ($_COOKIE["tipoUsuario"] !== "autorizado")){
            die("No tienes permisos de acceso a esta pagina.");
        }
	?>

    <?php
        if(getPermisos() === 1){
            echo "<a href='formArticulos.php'>Añadir producto</a>";
        }
    ?>

	<h1>Lista de artículos</h1>

    <?php
        isset($_GET["orden"]) ? pintaProductos($_GET["orden"]) : pintaProductos("name");
    ?>

    <a href="index.php">volver a index.php</a>
</body>
</html>
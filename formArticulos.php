<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Formulario de artículos</title>
</head>
<body>

	<?php 

		include "funciones.php";
	    $tiposUsuariosPermitidos = ["registrado", "autorizado", "superadmin"];
        if(!isset($_COOKIE["tipoUsuario"]) || !in_array($_COOKIE["tipoUsuario"], $tiposUsuariosPermitidos)){
            die("No tienes permisos de acceso a esta pagina.");
        }
	?>

    <?php
        if(isset($_GET["q"])){
            $producto = getProducto($_GET["id"]);
        } else {
            $producto = [
                "id" => "",
                "name" => "",
                "cost" => "",
                "price" => "",
                "category_id" => 1
            ];
        }
    ?>

    <form action="formArticulos.php" method="POST">
        <label>ID: <input type="number" value="<?= $producto["id"] ?>" disabled /></label>
        <input type="number" name="id" value="<?= $producto["id"] ?>" hidden />
        <br />
        <label>Nombre: <input type="text" name="nombre" value="<?= $producto["name"] ?>" /></label>
        <br />
        <label>Coste: <input type="number" step="0.01" name="coste" value="<?= $producto["cost"] ?>" min="0" /></label>
        <br />
        <label>Precio: <input type="number" step="0.01" name="precio" value="<?= $producto["price"] ?>" min="0" /></label>
        <br />
        <label>Categoria:
            <select name="categoria">
                <?php pintaCategorias($producto["id"]) ?>
            </select>
        </label>
        <br />
        <?php if(isset($_GET["q"]) && $_GET["q"] === "editar") : ?>
            <input type="submit" name="op" value="Editar" />
        <?php elseif(isset($_GET["q"]) && $_GET["q"] === "borrar") : ?>
            <input type="submit" name="op" value="Borrar" />
        <?php else : ?>
            <input type="submit" name="op" value="Añadir" />
        <?php endif; ?>

    </form>

    <?php
        if(isset($_POST["op"])) {
            if($_POST["op"] === "Añadir"){
                $nombre = $_POST["nombre"];
                $coste = $_POST["coste"];
                $precio = $_POST["precio"];
                $categoria = $_POST["categoria"];
                $esAniadido = anadirProducto($nombre, $coste, $precio, $categoria);
                echo $esAniadido ? "<p>Producto añadido correctamente</p>" : "<p>Error, el producto no se ha añadido</p>";
            } elseif($_POST["op"] === "Editar"){
                $id = $_POST["id"];
                $nombre = $_POST["nombre"];
                $coste = $_POST["coste"];
                $precio = $_POST["precio"];
                $categoria = $_POST["categoria"];
                $esEditado = editarProducto($id, $nombre, $coste, $precio, $categoria);
                echo $esEditado ? "<p>Producto editado correctamente</p>" : "<p>Error, el producto no se ha editado</p>";
            } elseif($_POST["op"] === "Borrar"){
                $id = $_POST["id"];
                $esBorrado = borrarProducto($id);
                echo $esBorrado ? "<p>Producto eliminado correctamente</p>" : "<p>Error, el producto no se ha eliminado</p>";
            }
        }
    ?>

    <a href="articulos.php">volver a articulos.php</a>
</body>
</html>

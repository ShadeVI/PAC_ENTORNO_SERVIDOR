<?php 

	include "conexion.php";

	function tipoUsuario($nombre, $correo){
        $conexion = crearConexion();
		$sql = "SELECT * FROM user WHERE email = ? AND full_name = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$correo, $nombre]);
        $resultado = $stmt->fetch();
        cerrarConexion($conexion);
        if(esSuperadmin($nombre, $correo)){
            return "superadmin";
        } elseif (isset($resultado["enabled"]) && $resultado["enabled"] == 1){
            return "autorizado";
        } elseif (isset($resultado["enabled"]) && $resultado["enabled"] == 0){
            return "registrado";
        } else {
            return "no registrado";
        }
	}


	function esSuperadmin($nombre, $correo){
		// Completar...
        $conexion = crearConexion();
        $sql = "SELECT * FROM user 
                JOIN setup ON superadmin_id = id AND user.email = ? AND user.full_name = ?; ";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$correo, $nombre]);
        $resultado = $stmt->fetch();
        cerrarConexion($conexion);
        if(!isset($resultado["management"])){
            return false;
        }
        return true;
    }


	function getPermisos() {
		// Completar...
        $conexion = crearConexion();
        $sql = "SELECT management FROM setup;";
        $stmt = $conexion->query($sql);
        $resultado = $stmt->fetch();
        cerrarConexion($conexion);
        return $resultado["management"];
	}


	function cambiarPermisos() {
		// Completar...
        $conexion = crearConexion();
        if(getPermisos() == 1){
            $sql = "UPDATE setup SET management = 0;";
        } else {
            $sql = "UPDATE setup SET management = 1;";
        }
        $conexion->exec($sql);
        cerrarConexion($conexion);
	}


	function getCategorias() {
		// Completar...
        $conexion = crearConexion();
        $sql = "SELECT * FROM category";
        $stmt = $conexion->query($sql);
        return $stmt->fetchAll();
	}


	function getListaUsuarios() {
		// Completar...
        $conexion = crearConexion();
        $sql = "SELECT full_name, email, enabled FROM user";
        $stmt = $conexion->query($sql);
        return $stmt->fetchAll();
	}


	function getProducto($ID) {
		// Completar...
        $conexion = crearConexion();
        $sql = "SELECT * FROM product WHERE id = :ID";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([":ID" => $ID]);
        return $stmt->fetch();
	}


	function getProductos($orden) {
		// Completar...
        $ordenValidos = ["id", "name", "cost", "price", "categoria"];
        if(in_array($orden, $ordenValidos)){
            $sql = "SELECT product.id, product.name, product.cost, product.price, c.name as categoria FROM product LEFT JOIN category AS c ON c.id = product.category_id ORDER BY ".$orden." ASC";
        } else {
            $sql = "SELECT product.id, product.name, product.cost, product.price, c.name as category FROM product LEFT JOIN categoria AS c ON c.id = product.category_id ORDER BY name ASC";
        }
        $conexion = crearConexion();
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        return $resultado;
	}

    function anadirProducto($nombre, $coste, $precio, $categoria) {
		$conexion = crearConexion();

        $sql = "INSERT INTO product (name, cost, price, category_id) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        // Paso los parametros con conversion a su valores segun la tabla product (exepto los decimals que se pasan como string)
        $stmt->bindParam(1, $nombre, PDO::PARAM_STR);
        $stmt->bindParam(2, $coste, PDO::PARAM_STR);
        $stmt->bindParam(3, $precio, PDO::PARAM_STR);
        $stmt->bindParam(4, $categoria, PDO::PARAM_INT);
        $resultado = $stmt->execute();
        return $resultado;
	}


	function borrarProducto($id) {
        $conexion = crearConexion();

        $sql = "DELETE FROM product WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $resultado = $stmt->execute();
        return $resultado;
	}


	function editarProducto($id, $nombre, $coste, $precio, $categoria) {
        $conexion = crearConexion();

        $sql = "UPDATE product SET name = ?, cost = ?, price = ?, category_id = ? WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        // Paso los parametros con conversion a su valores segun la tabla product (exepto los decimals que se pasan como string)

        $stmt->bindParam(1, $nombre, PDO::PARAM_STR);
        $stmt->bindParam(2, $coste, PDO::PARAM_STR);
        $stmt->bindParam(3, $precio, PDO::PARAM_STR);
        $stmt->bindParam(4, $categoria, PDO::PARAM_INT);
        $stmt->bindParam(5, $id, PDO::PARAM_INT);
        $resultado = $stmt->execute();
        return $resultado;
	}

?>
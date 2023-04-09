<?php 

	function crearConexion() {
		// Cambiar en el caso en que se monte la base de datos en otro lugar
		$host = "localhost";
		$user = "root";
		$pass = "password";
		$baseDatos = "pac_dwes";

		// Completar...
        try{
            // Creo la variable para pasarla como parametro al PDO y crear la conexion
            $dns = "mysql:host=".$host.";dbname=".$baseDatos;
            $pdoConexion = new PDO($dns, $user, $pass);
            // cuando haremos fetching de datos, nos devolverá en formato de array asociativo
            $pdoConexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // devolvemos la conexion
            return $pdoConexion;
        } catch (PDOException $e){
            die("Fallo en la conexion a la Base de Dato: ".$e->getMessage());
        }

	}


	function cerrarConexion($conexion) {
        // cerramos la conexion con PDO
	}


?>
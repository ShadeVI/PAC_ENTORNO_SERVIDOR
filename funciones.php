<?php 

	include "consultas.php";


	function pintaCategorias($defecto) {
		// Completar...
        $categorias = getCategorias();
        foreach ($categorias as $categoria){
            if($categoria["id"] === $defecto){
                echo "<option value='".$categoria['id']."' selected>".$categoria["name"]."</option>";
            } else {
                echo "<option value='".$categoria['id']."'>".$categoria["name"]."</option>";
            }
        }
	}
	

	function pintaTablaUsuarios(){
		// Completar...
        $usuarios = getListaUsuarios();
        echo '<table>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Autorizado</th>
                </tr>';
        foreach ($usuarios as $usuario){
            echo '<tr>
                    <td>'.$usuario["full_name"].'</td>
                    <td>'.$usuario["email"].'</td>';
            $negrita = $usuario["enabled"] ? "bold" : "normal";
            echo '<td style="font-weight:'.$negrita.'" >'.$usuario["enabled"].'</td>';

        }
        echo "</tr>";
        echo "</table>";
    }

		
	function pintaProductos($orden) {
		// Completar...
        $productos = getProductos($orden);
        echo '<table>
        <tr>
            <th><a href="/articulos.php?orden=id">ID</a></th>
            <th><a href="/articulos.php?orden=name">Nombre</a></th>
            <th><a href="/articulos.php?orden=cost">Coste</a></th>
            <th><a href="/articulos.php?orden=price">Precio</a></th>
            <th><a href="/articulos.php?orden=categoria">Categoria</a></th>
            <th>Acciones</th>
        </tr>';
        foreach ($productos as $producto) {
            echo '<tr>
                    <td>'.$producto["id"].'</td>
                    <td>'.$producto["name"].'</td>
                    <td>'.$producto["cost"].'</td>
                    <td>'.$producto["price"].'</td>
                    <td>'.$producto["categoria"].'</td>';
            if (getPermisos() === 1) {
                echo '<td>
                    <a href="formArticulos.php?q=editar&id='.$producto["id"].'">Editar</a>
                     - 
                    <a href="formArticulos.php?q=borrar&id='.$producto["id"].'">Borrar</a>
                </td>';
            }
            echo '</tr>';
        }
        echo '</table>';
	}

?>
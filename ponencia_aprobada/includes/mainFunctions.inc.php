<?php

// Constantes conexión con la base de datos
include('conexion.php');

// Variable que indica el status de la conexión a la base de datos
$errorDbConexion = false;


// Función para extraer el listado de usurios
function consultaUsers($linkDB,$id_ponencia){

	$statusTipo = array("Autor-Ponente" => "btn-success",
						"Autor" => "btn-warning");

	$salida = '';

	$consulta = $linkDB -> query("SELECT id_user,usr_nombre,usr_identificacion,usr_email,
								institucion,facultad,grupo,usr_tipo
								  FROM tbl_usuarios WHERE id_ponencia = '".$id_ponencia."' ORDER BY usr_nombre ASC");

	if($consulta -> num_rows != 0){
		
		// convertimos el objeto
		while($listadoOK = $consulta -> fetch_assoc())
		{
			$salida .= '
				<tr>
					<td>'.$listadoOK['usr_nombre'].'</td>
					<td>'.$listadoOK['usr_identificacion'].'</td>
					<td>'.$listadoOK['usr_email'].'</td>
					<td>'.$listadoOK['institucion'].'</td>
					<td>'.$listadoOK['facultad'].'</td>
					<td>'.$listadoOK['grupo'].'</td>
					<td class="centerTXT"><span class="btn btn-mini '.$statusTipo[$listadoOK['usr_tipo']].'">'.$listadoOK['usr_tipo'].'</span></td>
					<td class="centerTXT"><a data-accion="eliminar" class="btn btn-mini" href="'.$listadoOK['id_user'].'" src="'.$listadoOK['id_ponencia'].'">Eliminar</a></td>
				<tr>
			';
		}

	}
	else{
		$salida = '
			<tr id="sinDatos">
				<td colspan="8" class="centerTXT">NO HAY REGISTROS</td>
	   		</tr>
		';
	}

	return $salida;
}

// Verificar constantes para conexión al servidor
if(defined('server') && defined('user') && defined('pass') && defined('mainDataBase'))
{
	// Conexión con la base de datos
	
	$mysqli = new mysqli(server, user, pass, mainDataBase);
	
	// Verificamos si hay error al conectar
	if (mysqli_connect_error()) {
	    $errorDbConexion = true;
	}

	// Evitando problemas con acentos
	$mysqli -> query('SET NAMES "utf8"');
}


?>
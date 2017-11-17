<?php
// Script para ejecutar AJAX

// Insertar y actualizar tabla de usuarios
sleep(2);

// Inicializamos variables de mensajes y JSON
$respuestaOK = false;
$mensajeError = "No se puede ejecutar la aplicación";
$contenidoOK = "";

// Incluimos el archivo de funciones y conexión a la base de datos
include('mainFunctions.inc.php');

$statusTipoOK = array("Autor-Ponente" => "btn-success",
					  "Autor" => "btn-warning");


// Validar conexión con la base de datos
if($errorDbConexion == false){
	// Validamos qe existan las variables post
	if(isset($_POST) && !empty($_POST)){
		// Verificamos las variables de acción
		switch ($_POST['accion']) {
			case 'addUser':
			
					
					// Armamos el query
					$query = sprintf("INSERT INTO tbl_usuarios_semillero
									 SET usr_nombre='%s', usr_identificacion='%s', usr_email='%s', semestre='%s', id_ponencia='%s'",
									 $_POST['nombre'],$_POST['identificacion'],$_POST['email'], $_POST['semestre'],$_POST['id_ponencia']);

					// Ejecutamos el query
					$resultadoQuery = $mysqli -> query($query);


					// Obtenemos el id de user para edición
					$id_userOK = $mysqli -> insert_id;

					if($resultadoQuery == true){
						$respuestaOK = true;
						$mensajeError = "Se ha agregado el registro correctamente";
						$contenidoOK = '
							<tr>
								<td>'.$_POST['nombre'].'</td>
								<td>'.$_POST['identificacion'].'</td>
								<td>'.$_POST['email'].'</td>
								<td>'.$_POST['semestre'].'</td>';

				        $contenidoOK.='<td class="centerTXT"><a data-accion="eliminar" class="btn btn-mini" href="'.$id_userOK.'" src="'.$_POST['id_ponencia'].'">Eliminar</a></td>
							<tr>
						';

					}
					else{
						$mensajeError = "No se puede guardar el registro en la base de datos";
					}

			break;
			
			case 'editUser':
				// Armamos el query
				$query = sprintf("UPDATE tbl_usuarios_semillero
								 SET usr_nombre='%s', usr_identificacion='%s', usr_email='%s', institucion='%s', 
								 facultad='%s', grupo='%s', usr_tipo='%s'
								 WHERE id_user=%d LIMIT 1",
								 $_POST['nombre'],$_POST['identificacion'],$_POST['email'],$institucion,
								 $_POST['facultad'],$_POST['grupo'],$_POST['usr_tipo'],$_POST['id_user']);

				// Ejecutamos el query
				$resultadoQuery = $mysqli -> query($query);

				// Validamos que se haya actualizado el registro
				if($mysqli -> affected_rows == 1){
					$respuestaOK = true;
					$mensajeError = 'Se ha actualizado el registro correctamente';

					$contenidoOK = consultaUsers($mysqli);

				}else{
					$mensajeError = 'No se ha actualizado el registro';
				}


			break;
			case 'eliminar':
				$consulta = $mysqli -> query("SELECT id_ponencia
								  FROM tbl_usuarios_semillero WHERE id_user = '".$_POST['id_user']."'");

				$id_ponencia='';

				if($consulta -> num_rows != 0){					
					// convertimos el objeto
					while($listadoOK = $consulta -> fetch_assoc())
					{
						$id_ponencia = $listadoOK['id_ponencia'];
					}

				}

				// Armamos el query
				$query = sprintf("DELETE FROM tbl_usuarios_semillero
								 WHERE id_user=%d LIMIT 1",
								 $_POST['id_user']);

				
				// Ejecutamos el query
				$resultadoQuery = $mysqli -> query($query);

				// Validamos que se haya actualizado el registro
				if($mysqli -> affected_rows == 1){
					$respuestaOK = true;
					$mensajeError = 'Se ha actualizado el registro correctamente';

					$contenidoOK = consultaUsers($mysqli, $id_ponencia);

				}else{
					$mensajeError = 'No se ha eliminado el registro';
				}
			break;

			default:
				$mensajeError = 'Esta acción no se encuentra disponible';
			break;
		}
	}
	else{
		$mensajeError = 'No se puede ejecutar la aplicación';
	}


}
else{
	$mensajeError = 'No se puede establecer conexión con la base de datos';
}

// Armamos array para convertir a JSON
$salidaJson = array("respuesta" => $respuestaOK,
					"mensaje" => $mensajeError,
					"contenido" => $contenidoOK);

echo json_encode($salidaJson);
?>
<?php

include('mySQL.php');


function getFacultad($tem = 0){
	$sql = mysql_query("SELECT * FROM facultad");
	while($row = mysql_fetch_assoc($sql)){
		echo "<option value='".$row['id_facultad']."'";
		if($tem != 0){
		  if ($row['id_facultad'] == $tem){ 
		      echo ' selected ';
           }
         }
         
		echo " >".$row['nombre']."</option>";
	}
}


function getGrupo($tem = 0){
	$sql = mysql_query("SELECT * FROM grupo_investigacion");
	while($row = mysql_fetch_assoc($sql)){
		echo "<option value='".$row['id_grupo']."'";
		if($tem != 0){
		  if ($row['id_grupo'] == $tem){ 
		      echo ' selected ';
           }
         }
         
		echo " >".$row['siglas']."</option>";
	}
}

function getSemillero($tem = 0){
	$sql = mysql_query("SELECT * FROM semillero_investigacion");
	while($row = mysql_fetch_assoc($sql)){
		echo "<option value='".$row['id_semillero']."'";
		if($tem != 0){
		  if ($row['id_semillero'] == $tem){ 
		      echo ' selected ';
           }
         }
         
		echo " >".$row['siglas']."</option>";
	}
}



function getGrupoFacultad($tem = 0){
	$sql = mysql_query("SELECT * FROM grupo_investigacion WHERE `id_facultad`='".$tem."'");
	while($row = mysql_fetch_assoc($sql)){
		echo "<option value='".$row['id_grupo']."'";
		echo " >".$row['siglas']."</option>";
	}
}

function getSemilleroFacultad($tem = 0){
	$sql = mysql_query("SELECT * FROM semillero_investigacion WHERE `id_facultad`='".$tem."'");
	while($row = mysql_fetch_assoc($sql)){
		echo "<option value='".$row['id_semillero']."'";
		echo " >".$row['siglas']."</option>";
	}
}


function getTipoEvento($tem = 0){
	$sql = mysql_query("SELECT * FROM tipo_evento");
	while($row = mysql_fetch_assoc($sql)){
		echo "<option value='".$row['id_tipo_evento']."'";
		if($tem != 0){if ($row['id_tipo_evento'] == $tem){ echo ' selected ';}}
		echo " >".$row['nombre']."</option>";
	}
}

function getEventos($tem = 0){
	$sql = mysql_query("SELECT * FROM evento ORDER BY fecha_inicio");
	while($row = mysql_fetch_assoc($sql)){
		echo "<option title='".$row['description']."' value='".$row['id_evento']."'";
		if($tem != 0){
		  if ($row['id_evento'] == $tem){ 
		      echo ' selected ';
           }
         }
         
		echo " >".date('d-m-Y', strtotime($row['fecha_inicio']) )." - ".$row['nombre']."</option>";
	}
}

function getProgramacion($tem = 0){
	$sql = mysql_query("SELECT * FROM programacion ORDER BY fecha");
	while($row = mysql_fetch_assoc($sql)){
		echo "<option title='".$row['lugar']."' value='".$row['id_programacion']."'";
		if($tem != 0){
		  if ($row['id_programacion'] == $tem){ 
		      echo ' selected ';
           }
         }
         
		echo " >".date('d-m-Y', strtotime($row['fecha']) )." - ".$row['nombre_ponencia']."</option>";
	}
}


function getMostrarEvento($tem = 0){

	$resultA = mysql_query("SELECT * FROM `evento_sistema`");  
	// obtenemos el número de filas  
	$cont = mysql_num_rows($resultA); 

	if($cont>='2'){
		echo "<label>Evento: </label>
		      <select name='evento' id='comboEvent'>	
	   		<option value='0'> Seleccione </option>";    

		while($row = mysql_fetch_assoc($resultA)){
			$sql = mysql_query("SELECT * FROM evento WHERE `id_evento`='".$row['id_evento']."'");
			if($rowA = mysql_fetch_assoc($sql)){			
				echo "<option value='".$rowA['id_evento']."'>".$rowA['nombre']."</option>";
			}
		}

	   echo "</select><br/><br/>";
         
	}
	/*else if($cont=='1'){
		echo " <label>Evento: </label>
		      <select name='evento' id='comboEvent' >	
		      <option value=''> </option>";
	   	while($row = mysql_fetch_assoc($resultA)){
	   	$sql = mysql_query("SELECT * FROM evento WHERE `id_evento`='".$row['id_evento']."'");
			if($rowA = mysql_fetch_assoc($sql)){
				echo "<option value='".$rowA['id_evento']."'>".$rowA['nombre']."</option>";
			
			}
		}
			echo "</select><br/><br/>";
	}*/
	else{
		echo "";
	}

}

function getMostrarInstitucion($tem = 0){

	$resultA = mysql_query("SELECT * FROM `evento_sistema`");  
	// obtenemos el número de filas  
	$cont = mysql_num_rows($resultA); 

	if($cont=='1'){
		while($r = mysql_fetch_assoc($resultA)){
			$sql = mysql_query("SELECT * FROM evento WHERE `id_evento`='".$r['id_evento']."'");
			if($row = mysql_fetch_assoc($sql)){

				$dirigido = explode(",", $row['dirigido']);
			    $ufps=0; $otro=0; $grupo=0; $semi=0;

			    foreach($dirigido as $dato){
			        if($dato=="1")
			            $ufps=1; 
			        if($dato=="2")
			            $otro=1; 
			        if($dato=="3")
			            $grupo=1; 
			        if($dato=="4")
			            $semi=1;
			     }

				echo '<label>Instituci&oacute;n o Empresa : <span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
				    <select name="institucion" id="comboInstitucion">';

				if($ufps==1 || $grupo==1 || $semi==1){
					echo '<option value="0"> UFPS </option>';
				}
				if($otro==1){
					echo '<option value="1"> Otro </option>';
				}
				echo '  
				    </select>
				    <br/><br/>';
			}
		}
		
	}
}

function getMostrarUnidad($tem = 0){

	$resultA = mysql_query("SELECT * FROM `evento_sistema`");  
	// obtenemos el número de filas  
	$cont = mysql_num_rows($resultA); 

	if($cont=='1'){
		while($r = mysql_fetch_assoc($resultA)){
			$sql = mysql_query("SELECT * FROM evento WHERE `id_evento`='".$r['id_evento']."'");
			if($row = mysql_fetch_assoc($sql)){

				$dirigido = explode(",", $row['dirigido']);
			    $grupo=0; $semi=0;

			    foreach($dirigido as $dato){
			        if($dato=="3")
			            $grupo=1; 
			        if($dato=="4")
			            $semi=1;
			     }

			     if($grupo==1 || $semi==1){
					if($grupo==1 && $semi==1){
					   	echo '<label style="width: 270px; ">Unidad de Investigaci&oacute;n: </label>
					   		<input class="rad" type="radio" name="investigacion" value="1" onclick="mostrarReferencia();"/><label style="width: 80px; font-size:11px;">Semillero</label>
							<input class="rad" type="radio" name="investigacion" value="2" onclick="mostrarReferencia();"/><label style="width: 80px; font-size:11px;">Grupo</label>';
						
					}
					else if(($grupo==1 && $semi==0) || ($grupo==0 && $semi==1)){
					   	echo '<label style="width: 310px; ">Unidad de Investigaci&oacute;n: </label>';

					   	if($semi==1){
							echo '<input class="rad" type="radio" name="investigacion" value="1" onclick="mostrarReferencia();"/><label style="width: 180px; font-size:11px;">Semillero</label>';
						}				     
						if($grupo==1){
							echo '<input class="rad" type="radio" name="investigacion" value="2" onclick="mostrarReferencia();"/><label style="width: 180px; font-size:11px;">Grupo</label>';
						}	
					}
							
					echo '<br/><br/>';		
			   }	
			}
		}
		
	}
}

function noCache() {
  header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
}


?>


<?
include('../scripts/gets.php');
include('../scripts/mySQL.php');

$id = $_POST["elegido"];

if ($id != '' and $id != '0'){
  echo ' 
      <p>Grupo de Investigaci&oacute;n</p>
		<span></span>
		<select class="form-control {required:true} span3" name="grupo"> 
         <option value=""> Seleccione </option>';
      echo getGrupoFacultad($id);  
  echo'</select>'; 
}

?>

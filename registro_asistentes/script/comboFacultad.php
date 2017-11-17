
<?
include('../scripts/gets.php');
include('../scripts/mySQL.php');

$id = $_POST["elegido"];

if ($id != '' and $id != '0'){
  echo ' 
  <div id="grupo" style="display:none;"> 
      <label>Grupo de Investigaci&oacute;n: <span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
      <select class="form-control" name="grupo"> 
         <option value="0"> Seleccione </option>';
      echo getGrupoFacultad($id);  
  echo'</select>
   </div>  

   <div id="semillero" style="display:none;"> 
      <label>Semillero de Investigaci&oacute;n:<span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span> </label>
      <select class="form-control " name="semillero"> 
         <option value="0"> Seleccione </option>';
      echo getSemilleroFacultad($id);    

  echo '</select>
   </div> '; 
}

?>

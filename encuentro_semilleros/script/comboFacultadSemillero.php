
<?
@include_once('../scripts/gets.php');
@include_once('../scripts/mySQL.php');

$id = $_POST["elegido"];

if ($id != '' and $id != '0'){
  
  echo'
      <label>Semillero de Investigaci&oacute;n:<span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span> </label>
      <select class="form-control" required name="semillero"> 
         <option value=""> Seleccione </option>';
      echo getSemilleroFacultad($id);    

  echo '</select>'; 
}

?>

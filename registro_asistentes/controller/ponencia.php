<?php


include('../scripts/mySQL.php');
include('../includes/mainFunctions.inc.php');
    
require ( '../lib/class.phpmailer.php');

require ( '../lib/class.smtp.php');

//$sqlmenu = mysql_query("SELECT * FROM `menu_usuario` WHERE `nombre_modulo`='ponente'");
$visible = 1;
$fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
$fecha_entrada = strtotime("01-10-2017 23:58:00");
$i=0;
/*
if ($fila = mysql_fetch_assoc($sqlmenu)){
  $visible =$fila['visible'];    
}

if (isset($_POST['boton'])){
  $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));

  if( ($visible==0) || ($fecha_actual > $fecha_entrada)){
    ?><script>alert("Estimado usuario, la convocatoria al evento de La III Semana Internacional y XI Semana de Ciencia,
           Tecnolog&iacute;a e Innovaci&oacute;n que se desarrollar&aacute; del 25 al 28 de octubre del 2016, finaliz&oacute; 
           su proceso de inscripci&oacute;n el 12 de Septiembre a las 11:59 pm.");</script><? 
                       $opc ="";
  }
  else{*/

      $sql = '';
      $opc ="";
      $id_evento = "1";
      /*$sql = mysql_query("SELECT * FROM `evento_sistema`");
      $cont = mysql_num_rows($sql); 
      if($cont>='2'){
          $id_evento = $_POST['evento'];
      }
      else if($cont=='1'){
          $row = mysql_fetch_assoc($sql);
          $id_evento=$row['id_evento'];
      }*/


$sql = mysql_query("SELECT * FROM `Participante` WHERE `identificacion` ='".$_POST['id']."' and `id_evet` ='".$id_evento."' ");
  
  
if ($row = mysql_fetch_assoc($sql)){
  echo "<script>location.href='../index.php?id=3';</script>";
    
}else{
      $investigacion='null';
       $id_invest='null';
       
       if($_POST['investigacion']=='1'){
            $investigacion="Semillero";
            $id_invest=$_POST['semillero'];
       }
       else if($_POST['investigacion']=='2'){
            $investigacion="Grupo";
            $id_invest=$_POST['grupo'];
       }

    
       $institucion="";
       if($_POST['institucion']=='0'){
            $institucion="UFPS";
       }
       else if($_POST['otro']==""){
            $institucion="OTRO";
        }
       else{        
            $institucion=$_POST['otro'];
       }

       $modalidad="";
       if($_POST['modalidad']!="1"){
        $modalidad=$_POST['modalidad'];
       }
       else if($_POST['mod_otro']==""){
         $modalidad="OTRO";
       }
       else{
        $modalidad=$_POST['mod_otro'];
       }
       
       $facultad='null';
       if($_POST['facultad']!='0'){
            $facultad=$_POST['facultad'];
            
       }
       
       
     if(mysql_query("INSERT INTO `Participante`(`id_evet`, `identificacion`, `nombre`, `apellido`, `institucion`, `celular`, `email`, `facultad`, `unidad_investigacion`, `id_investigacion`, `modalidad`) VALUES ('".$id_evento."', '".$_POST['id']."', '".$_POST['nombre']."', '".$_POST['apellidos']."', '".$institucion."', '".$_POST['tel']."', '".$_POST['mail']."', '".$facultad."','".$investigacion."', '".$id_invest."', '".$modalidad."');")){
        echo "<script>location.href='../index.php?id=1';</script>";
   }
    
}

?>
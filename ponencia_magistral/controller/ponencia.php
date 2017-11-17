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


      
        $id_ponencia = $_POST['id_ponencia'];
        $titulo_ponencia = $_POST['titulo_ponencia'];
        $titulo_proyecto = $_POST['titulo_proyecto'];
        $objetivos = $_POST['objetivos'];
        $estado = $_POST['estado'];
        $tipo_financiacion = $_POST['tipo_financiacion'];
        $modalidad = $_POST['modalidad'];
        
             
           if(mysql_query("INSERT INTO `Ponencia`(`id_event`, `id_ponencia`, `titulo_ponencia`, `titulo_proyecto`, `objetivos`, `estado`, `tipo_financiacion`, `avalado_oral`, `avalado_poster`, `modalidad`, `documentos`) VALUES ('".$id_evento."','".$id_ponencia."', '".$titulo_ponencia."', '".$titulo_proyecto."', '".$objetivos."', '".$estado."','".$tipo_financiacion."', '0', '0','".$modalidad."', '0');")){ 
                  $consulta = mysql_query("SELECT * FROM tbl_usuarios WHERE id_ponencia = '".$id_ponencia."' ORDER BY usr_nombre ASC");
                  $autor = '';
                  $numero = mysql_num_rows($consulta); 
                  if($numero != 0){
                    
                    // convertimos el objeto
                    while($listadoOK=mysql_fetch_array($consulta)) {
                      if(mysql_query("INSERT INTO `Ponente`(`usr_nombre`, `usr_identificacion`, `usr_email`, `institucion`, `facultad`, `grupo`, `usr_tipo`, `id_ponencia`)  VALUES ('".$listadoOK['usr_nombre']."','".$listadoOK['usr_identificacion']."', '".$listadoOK['usr_email']."', '".$listadoOK['institucion']."', '".$listadoOK['facultad']."', '".$listadoOK['grupo']."','".$listadoOK['usr_tipo']."','".$listadoOK['id_ponencia']."');")){
                         $autor.= "<b>Nombre: </b>".$listadoOK['usr_nombre']."<br>";

                      }
           
                    }

                  }
                          
                          $evento="";
                          $sql = mysql_query("SELECT * FROM evento WHERE `id_evento` = '".$id_evento."'");
                        if($row = mysql_fetch_assoc($sql)){
                           $evento=$row['nombre'];
                          
                        }
                          
                          $mail = new PHPMailer();   
                          
                          $mail->IsSMTP();   
                          // la dirección del servidor, p. ej.: smtp.servidor.com
                          $mail->Host = "smtp.gmail.com";
                          
                          $mail->FromName = $evento; 
                          
                          $mail->From = $email;//email de remitente desde donde se envi­a el correo.   
                          
                          $mail->AddAddress('semana_cyt@ufps.edu.co', 'Vicerrectoria Asistente de Investigacion y Extension');//destinatario que va a recibir el correo   
                          
                          
                          $mail->Subject = 'Registro Ponencia - '.$titulo_ponencia;   
                          
                          $body = "<strong>REGISTRO DEL PONENCIA</strong><br><br>";
                          
                          $body.= "<b>Titulo de Ponencia: </b>".$titulo_ponencia."<br><br>";
                          $body.= "<b>Autores: </b><br>";
                          $body.= $autor;
                                              
                          $mail->Body = $body;
                          
                          // si el cuerpo del mensaje es HTML
                          $mail->MsgHTML($body);
                          
                          
                          $varname1 = $_FILES['archivo1']['name'];
                          $vartemp1 = $_FILES['archivo1']['tmp_name'];

                          if ($varname1 != "") {
                                  $mail->AddAttachment($vartemp1, $varname1);
                          } 

                          $varname2 = $_FILES['archivo2']['name'];
                          $vartemp2 = $_FILES['archivo2']['tmp_name'];

                          if ($varname2 != "") {
                                  $mail->AddAttachment($vartemp2, $varname2);
                          } 

                          $varname3 = $_FILES['archivo3']['name'];
                          $vartemp3 = $_FILES['archivo3']['tmp_name'];

                          if ($varname3 != "") {
                                  $mail->AddAttachment($vartemp3, $varname3);
                          } 

                          $varname4 = $_FILES['archivo4']['name'];
                          $vartemp4 = $_FILES['archivo4']['tmp_name'];

                          if ($varname4 != "") {
                                  $mail->AddAttachment($vartemp4, $varname4);
                          } 

                          $varname5 = $_FILES['archivo5']['name'];
                          $vartemp5 = $_FILES['archivo5']['tmp_name'];

                          if ($varname5 != "") {
                                  $mail->AddAttachment($vartemp5, $varname5);
                          } 
                          
                           // si el SMTP necesita autenticación
                           $mail->SMTPAuth = true;

                           // Establece el tipo de seguridad SMTP 
                           $mail->SMTPSecure = "ssl";   

                           // Establece el puerto del servidor SMTP de Gmail
                           $mail->Port = 465;                                 

                          // credenciales usuario
                          $mail->Username = "semanacyt.ufps";
                          $mail->Password = "vicerrectoria_2"; 

                          if(!$mail->Send()) {
                          //  echo "Error enviando: " . $mail->ErrorInfo;
                            echo "<script>location.href='../index.php?id=2';</script>";
                          } else {
                           
                          echo "<script>location.href='../index.php?id=1';</script>";
                          
                            
                          }
                          
         }

        else{
          echo "<script>location.href='../index.php?id=3';</script>";
        }   
?>
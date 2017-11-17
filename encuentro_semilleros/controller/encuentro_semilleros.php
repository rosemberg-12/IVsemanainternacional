<?php


include('../scripts/mySQL.php');
include('../includes/mainFunctions.inc.php');
    
require ( '../lib/class.phpmailer.php');

require ( '../lib/class.smtp.php');

//$sqlmenu = mysql_query("SELECT * FROM `menu_usuario` WHERE `nombre_modulo`='ponente'");
$visible = 1;
$fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
$fecha_entrada = strtotime("01-09-2017 23:58:00");
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


        $id_ponencia = $_POST["id_ponencia"];
        $id_invest=$_POST['semillero'];
        $facult=$_POST['facultad'];
             
        if(mysql_query("INSERT INTO `lider_semillero`(`id_event`, `id_ponencia`, `facultad`, `id_semillero`) VALUES ('".$id_evento."','".$id_ponencia."', '".$facult."', '".$id_invest."');")){
              $consulta = mysql_query("SELECT * FROM tbl_usuarios_semillero WHERE id_ponencia = '".$id_ponencia."' ORDER BY usr_nombre ASC");
                  $autor = '';
                  $numero = mysql_num_rows($consulta); 
                  if($numero != 0){
                    
                    // convertimos el objeto
                    while($listadoOK=mysql_fetch_array($consulta)) {
                      if(mysql_query("INSERT INTO `Ponente_semillero`(`usr_nombre`, `usr_identificacion`, `usr_email`, `semestre`, `id_ponencia`)  VALUES ('".$listadoOK['usr_nombre']."','".$listadoOK['usr_identificacion']."', '".$listadoOK['usr_email']."', '".$listadoOK['semestre']."', '".$listadoOK['id_ponencia']."');")){
                         $autor.= "<b>Nombre: </b>".$listadoOK['usr_nombre']."<br>";

                      }
           
                    }

                  }

                        $facultad="";
                        $sql = mysql_query("SELECT * FROM facultad WHERE `id_facultad` = '".$facult."'");
                        if($row = mysql_fetch_assoc($sql)){
                          $facultad=$row['nombre'];
                        }
                          
                          
                          $evento="";
                          $sql = mysql_query("SELECT * FROM evento WHERE `id_evento` = '".$id_evento."'");
                        if($row = mysql_fetch_assoc($sql)){
                           $evento=$row['nombre'];
                          
                        }
                          
                        $investigacion="";
                        $sql = mysql_query("SELECT * FROM semillero_investigacion WHERE `id_semillero` = '".$id_invest."'");
                        if($row = mysql_fetch_assoc($sql)){
                           $investigacion=$row['siglas'].' - '.$row['nombre'];                          
                        }
                       

                          $mail = new PHPMailer();   
                          
                          $mail->IsSMTP();   
                          // la dirección del servidor, p. ej.: smtp.servidor.com
                          $mail->Host = "smtp.gmail.com";
                          
                          $mail->FromName = $evento; 
                          
                          $mail->From = $email;//email de remitente desde donde se envi­a el correo.   
                          
                          $mail->AddAddress('semana_cyt@ufps.edu.co', 'Vicerrectoria Asistente de Investigacion y Extension');//destinatario que va a recibir el correo   
                        //  $mail->AddAddress('coordinacionsemilleros@ufps.edu.co', 'Vicerrectoria Asistente de Investigacion y Extension');//destinatario que va a recibir el correo   
                          
                          
                          $mail->Subject = 'Registro II ENCUENTRO INSTITUCIONAL DE SEMILLEROS DE INVESTIGACION - '.$investigacion;   
                          
                          $body = "<strong>REGISTRO DEL SEMILLERO DE INVESTIGACION</strong><br><br>";
                          
                          $body.= "<b>Autores: </b><br>";
                          $body.= $autor;
                                           
                          $body.= "<b>Facultad:</b> ".$facultad."<br>";
                          $body.= "<b>Unidad de Investigacion:</b> ".$investigacion."<br><br>";
                                              
                                              
                          $mail->Body = $body;
                          
                          // si el cuerpo del mensaje es HTML
                          $mail->MsgHTML($body);
                          
                          
                          $varname1 = $_FILES['archivo1']['name'];
                          $vartemp1 = $_FILES['archivo1']['tmp_name'];

                          if ($varname1 != "") {
                                  $mail->AddAttachment($vartemp1, $varname1);
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
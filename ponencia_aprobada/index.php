<?php
// Omitir errores
ini_set("display_errors", false);


// Incluimos nustro script php de funciones y conexi&oacute;n a la base de datos
include('scripts/gets.php');
include('includes/mainFunctions.inc.php');
include('scripts/mySQL.php');
require ( 'lib/class.phpmailer.php');
require ( 'lib/class.smtp.php');

$sqlmenu = mysql_query("SELECT * FROM `menu_usuario` WHERE `nombre_modulo`='aprobado'");
$visible = 1;
$fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
$fecha_entrada = strtotime("31-10-2017 24:00:00");

  
if ($fila = mysql_fetch_assoc($sqlmenu)){
  $visible =$fila['visible'];    
}

$msg="";
$table="";
$sql="";
$id_evento="";


/*if (isset($_POST['buscar'])){

	$id_evento="1"; 

  
	$sql = mysql_query("SELECT * FROM `Ponencia` WHERE `id_ponencia` ='".$_POST['identificacion']."' and (`avalado_oral` = '1' or `avalado_poster` = '1') and `id_event` ='".$id_evento."' ");

    if ($row = mysql_fetch_assoc($sql)){

    	if($row['documentos']==0){
	
		$msg.= " <br/><label for='InputName1'><b>Titulo de la Ponencia: </b></label><label for='InputName1' style='width: auto;font-weight: normal;' for='inputSuccess4'>".$row['titulo_ponencia']."</label>";

	    $msg.= " <br/><label for='InputName1'><b>Modalidad Avalada: </b></label><label for='InputName1' style='width: auto;font-weight: normal;' for='inputSuccess4'>";

          if($row['avalado_oral']=="1"){
            $msg.= "Oral  ";
          }

          if($row['avalado_poster']=="1"){
            $msg.= " Poster  ";
          }
      $msg.= "</label><br/><br/>
      	     <label for='InputName1'>La totalidad de los archivos no debe exceder 7MB.</label><br>";

         $id=$row['id_ponencia'];		 
		

		$from= '<label for="InputName1">';

		if($row['avalado_poster']=="1"){
			$from.= 'Formato Poster';
		}else{
			$from.= 'Presentaci&oacute;n de la ponencia';
		} */
		
		$from.=':<span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
		         <input class="form-control" name="archivo1" type="file" required/>
				<br/><br/> ';
		$from.= '<label for="InputName1">Hoja de Vida Resumen:<span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
				<input class="form-control" name="archivo2" type="file" required/>
				<br/><br/>   
				<label for="InputName1">Autorizaci&oacute;n para publicaci&oacute;n:<span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
				<input class="form-control" name="archivo3" type="file" required/>
				<br/><br/>
				<label for="InputName1">In-extenso:<span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
				<input class="form-control" name="archivo4" type="file" required/>
				<br/><br/> ';
		$from.= " <center><input class='botom' name='guardar' type='submit' value='Enviar' /></center>";
 	   
 	   else{
 	   	$msg.= "<table><tr><td> <h3>YA SE CARGARON LOS RESPECTIVOS DOCUMENTOS DE LA PONENCIA, GRACIAS POR SU PARTICIPACI&Oacute;N.</h3></td></tr></table>";
 	   }
    }        
   /* else{
		$msg.= "<table><tr><td> <h3>LA PONENCIA   
		NO TIENE HABILITADO EL REGISTRO DE DOCUMENTOS, YA QUE NO FUE APROBADA EN ESTE EVENTO.</h3></td></tr></table>";
    }*/

   



if (isset($_POST['guardar'])){
	$fecha_actual = strtotime(date("d-m-Y H:i:00",time()));

  if( ($visible==0) && ($fecha_actual > $fecha_entrada)){
    
  }
  else{
  	$identificacion= $_POST['id'];
    $id_evento= $_POST['evento'];

    $sql = mysql_query("SELECT * FROM `Ponencia` WHERE `id_ponencia` ='".$identificacion."' and `id_event` ='".$id_evento."' ");

    if ($row = mysql_fetch_assoc($sql)){

    	
    	$identificacion = $row['id_ponencia'];
        $nombre = $row['titulo_ponencia'];

    	$mail = new PHPMailer();   
                    
	    $mail->IsSMTP();   
	    // la dirección del servidor, p. ej.: smtp.servidor.com
	    $mail->Host = "smtp.gmail.com";
	 	$mail->FromName = $evento; 
	                    
	    $mail->From = $email;//email de remitente desde donde se envi­a el correo.   
	                    
	    $mail->AddAddress('semana_cyt@ufps.edu.co', 'Vicerrectoria Asistente de Investigacion y Extension');//destinatario que va a recibir el correo   
	             
	    
	    $mail->Subject = 'Registro In-Extenso Ponencia - '.$nombre;   
	                    
	     $body = "<strong>REGISTRO DE PONENCIA</strong><br><br>";
	                    
	     $body.= "<b>Titulo: </b>".$nombre."<br>";
	     $body.= "<b>Número de Ponencia:</b> ".$identificacion."<br>";
	                                      
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
	      //echo "Error enviando: " . $mail->ErrorInfo;
	      	$i=3;
	       } else {
	       	$sqlA = "UPDATE `Ponencia` SET `documentos`= 1 WHERE `id_ponencia` ='".$identificacion."' and `id_event` ='".$id_evento."' ";
      		$result = mysql_query($sqlA); 
	        /*  ?><script>alert("Registro Exitoso");</script><? */
	          $i=1;
	           $opc ="";
	       }
    } 
    else{
    	$i=2;
    } 

  }        
}


?>
<!DOCTYPE html>
 
<html lang="es">
 
<head>
 	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../assets/img/ufps.ico">

    <title>Vicerrectoria Asistente de Investigaci&oacute;n y Extensi&oacute;n</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet"> 

    <!-- Custom styles for this template -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">

    <link href='../assets/css/owl-carousel/owl.carousel.css' rel='stylesheet'>
    <link href='../assets/css/owl-carousel/owl.theme.css' rel='stylesheet'>
    <link href='../assets/css/owl-carousel/custom.css' rel='stylesheet'>
    <link href='../assets/css/owl-carousel/animate.css' rel='stylesheet'>
    <link href="../assets/css/charisma-app.css" rel="stylesheet">


<link type="text/css" href="css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
<link type="text/css" href="css/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link type="text/css" href="css/master.css" rel="stylesheet" />

<script type="text/javascript" src="js/jquery_ui/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="js/jquery_ui/jquery-ui-1.8.23.custom.min.js"></script>
<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>

<script type="text/javascript" src="js/jquery-validation-1.10.0/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/jquery-validation-1.10.0/lib/jquery.metadata.js"></script>
<script type="text/javascript" src="js/jquery-validation-1.10.0/localization/messages_es.js"></script>

<script type="text/javascript" src="js/mainJavaScript.js"></script>


    <script type="text/javascript">
		<!--
		function mostrarTipo(){
		  //Si la opcion con id Conocido_1 (dentro del documento > formulario con name fcontacto >     y a  la vez dentro del array de Conocido) esta activada
		  if (document.fcontacto.tipo_financiacion.value == "0") {
		  //muestra (cambiando la propiedad display del estilo) el div con id 'desdeotro'
		   // document.getElementById('ufps').style.display='block';
		    document.getElementById('otro').style.display='none';               

		  //por el contrario, si no esta seleccionada
		  } else if (document.fcontacto.tipo_financiacion.value == "1") {
		    //oculta el div con id 'desdeotro'
		    document.getElementById('otro').style.display='block';
		  //  document.getElementById('ufps').style.display='none';
		  }           
		}
		
		function ValidaSoloNumeros() {
		 if ((event.keyCode < 48) || (event.keyCode > 57)) 
		  event.returnValue = false;
		}

		function txNombres() {
		 if ((event.keyCode != 32) && (event.keyCode < 65) || (event.keyCode > 90) && (event.keyCode < 97) || (event.keyCode > 122))
		  event.returnValue = false;
		}

	</script>
	<script type="text/javascript">
		function mostrarInstitucion(){
		  
		    document.getElementById('ufpsI').style.display='block';
		    document.getElementById('otroI').style.display='none';           
		         
		}

		function mostrarInstitucion2(){
		  
		    document.getElementById('otroI').style.display='block';
		    document.getElementById('ufpsI').style.display='none';
		       
		}

	</script>
	<script language="javascript">
		$(document).ready(function(){
		   $("#comboFacultad").change(function () {
		      $("#comboFacultad option:selected").each(function () {
		      //alert($(this).val());
		        elegido=$(this).val();
		        $.post("script/comboFacultad.php", { elegido: elegido }, function(data){
		        $("#facul").html(data);
		        
		      });     
		        });
		   })
		  
		});
</script>
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">IV SEMANA INTERNACIONAL Y XII SEMANA DE CIENCIA, TECNOLOG&Iacute;A E INNOVACI&Oacute;N</a>
        </div>
        <div class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">
            <li><a href="../index.html">INICIO</a></li>
	        <li><a href="ponencia.html">PONENCIAS</a></li>
	         <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">EVENTOS<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="rally.html">RALLY INNOVACI&Oacute;N</a></li>
                <li><a href="rutalab.html">RUTA LAB</a></li>
                <li><a href="retoinvestigacion.html">RETOS A LA INVESTIGACI&Oacute;N</a></li>
                               
              </ul> 
            </li>
            <li><a href="programacion.html">PROGRAMACI&Oacute;N</a></li>
	        <li><a href="../registro_asistentes/index.php">ASISTENTES</a></li>
            <li><a href="../semilleros.html">CONVOCATORIA SEMILLEROS</a></li>
            <li><a href="../comite.html">COMIT&Eacute; CIENT&Iacute;FICO</a></li>
            <li><a href="../contacto.html">CONTACTO</a></li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">MEMORIAS<b class="caret"></b></a>
	          <ul class="dropdown-menu">
	            <li><a href="http://www.ufps.edu.co/Isemanainternacionalcyt/" target="_blank">2014</a></li>
	            <li><a href="http://www.ufps.edu.co/ufps/IIsemanainternacional_cyt/" target="_blank">2015</a></li>
	            <li><a href="https://ww2.ufps.edu.co/public/archivos/oferta_academica/76c4c5574aeacbb649c348dec13a663e.pdf" target="_blank">2016</a></li>
	          </ul>	            
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

	<!-- *****************************************************************************************************************
	 BLUE WRAP
	 ***************************************************************************************************************** -->
	<div id="blue">
	    <div class="container">
			<div class="row">
				<h3>REGISTRO DE PONENCIA APROBADAS</h3>
			</div> 
	    </div>  
	</div> 
	<div class="box-content alerts">
		<?if($i==1){ ?>
			<div class="alert alert-success">
			    <button type="button" class="close" data-dismiss="alert">&times;</button>
			    <strong>Registro Exitoso</strong> 
			  </div>
		<?}?>
		<?if($i==2){ ?>
			<div class="alert alert-info">
			    <button type="button" class="close" data-dismiss="alert">&times;</button>
			    <strong>Error Conexion con la base de datos.</strong> 
			  </div>
		<?}?>
		<?if($i==3){ ?>
			<div class="alert alert-danger">
			    <button type="button" class="close" data-dismiss="alert">&times;</button>
			    <strong>Error. No se registro los documentos.</strong> 
			  </div>
		<?}?>
	  
	</div>

<?
if( ($visible==0) && ($fecha_actual > $fecha_entrada)){?>
    
    <br />
     Estimado usuario, el proceso de inscripci&oacute;n del In-extenso, hoja de vida resumen, 
    	autorizaci&oacute;n para publicaci&oacute;n y presentaci&oacute;n, para las ponencias aprobadas al evento de 
    	La IV Semana Internacional y XII Semana de Ciencia, Tecnolog&iacute;a e Innovaci&oacute;n que se 
    	desarrollar&aacute; del 07 al 10 de Noviembre del 2017, finaliz&oacute; el 31 de octubre a las 11:59 pm.
    <br /><br />

 <?
/*
<div class="container mtb" style="margin-top: 10px;">
	 	<div class="row">
	 		<div class="col-lg-8">	 			
		 		<form role="form" method="post" enctype="multipart/form-data" target="_parent" >
					<? echo getMostrarEvento(); ?> 
				     <label>N&uacute;mero de Ponencia : </label>
				     <input type="text" name="identificacion" /><br/>
				       
				    <br/><center><input class="botom" name="buscar" type="submit" value="Buscar" /><br><br><br></center>
				</form>
				<form role="form" method="post" enctype="multipart/form-data" target="_parent" >
	
				<?=$msg?>
				   <input type="hidden" name="id" value="<?=$id?>"/>
				    <input type="hidden" name="evento" value="<?=$id_evento?>"/>
				   <?=$from?>
				   <br><br>
				</form>

				</form>
			</div> 
	 		
	 	</div> 
	 </div> 

<?}?>


		

	<!-- *****************************************************************************************************************
	 FOOTER
	 ***************************************************************************************************************** -->
	<div class="row">
    <div class="owl-clients-v1 wow fadeInUp animated owl-carousel owl-theme animated" style="text-align:center;padding: 5px; opacity: 1; display: block; visibility: visible; animation-name: fadeInUp; background-color: rgb(238, 238, 238);">
      <div class="owl-wrapper-outer">
            <a href="http://www.mineducacion.gov.co"><img src="../assets/img/organismos/mineducacion.png" class="hover-shadow" alt=""></a>         
            <a href="http://www.gobiernoenlinea.gov.co"><img src="../assets/img/organismos/gobiernoenlinea.png" class="hover-shadow" alt=""></a>          
            <a href="http://www.icfes.gov.co/"><img src="../assets/img/organismos/icfes.png" class="hover-shadow" alt=""></a>         
            <a href="http://www.colombiaaprende.edu.co"><img src="../assets/img/organismos/colombiaaprende.png" class="hover-shadow" alt=""></a>          
            <a href="http://www.renata.edu.co"><img src="../assets/img/organismos/renata-logo.png" class="hover-shadow" alt=""></a>          
            <a href="http://www.colciencias.gov.co"><img src="../assets/img/organismos/COLCIENCIAS.png" class="hover-shadow" alt=""></a>  
       </div>
    </div>
</div>

<div>
    <footer class="row">
        <div class="col-xs-9">
            <br>
            <p style="text-align: center;color:#eee;"> 
             Avenida Gran Colombia No. 12E-96B Colsag. San Jos&eacute; de C&uacute;cuta - Colombia.
            </p>
            <p style="text-align: center;color:#eee;">
                Vicerrector&iacute;a Asistente de Investigaci&oacute;n y Extensi&oacute;n
            </p>
            <p style="text-align: center;color:#eee;">
                Edificio Vicerrectoría Asistente de Investigación y Extensión- Tel&eacute;fono (057)(7) 5776655 Ext 172.
            </p>
        </div>
        <center>
        <div class="col-xs-3">
            <div class="footer-main">
                <a href="http://www.ufps.edu.co/"> 
                <img src="../assets/img/logoufpsvertical.png" class="img-responsive" alt="">
                </a>
            </div>
        </div>
    </center>
    </footer>
    <div class="row">
        <div class="footer2">             
            <div class"col-md-8">
                <p style="margin-left:20px;color:#eee;"> 2017 &copy; Derechos Reservados. 
                <a href="http://www.ufps.edu.co/ufpsnuevo/modulos/contenido/view_contenido.php?item=22" target="_blank"> 
                    Vicerrector&iacute;a Asistente de Investigaci&oacute;n y Extensi&oacute;n</a>
                 | Desarrollado por: Valeria Salazar-VAIE </p>
            </div>
        </div>
    </div>
</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
 <!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
    <script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/retina-1.1.0.js"></script>
	<script src="../assets/js/jquery.hoverdir.js"></script>
	<script src="../assets/js/jquery.hoverex.min.js"></script>
	<script src="../assets/js/jquery.prettyPhoto.js"></script>
  	<script src="../assets/js/jquery.isotope.min.js"></script>
  	<script src="../assets/js/custom.js"></script>
</body>
</html>



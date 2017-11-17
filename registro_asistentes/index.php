<?php
// Omitir errores
ini_set("display_errors", false);


// Incluimos nustro script php de funciones y conexi&oacute;n a la base de datos
include('scripts/gets.php');
include('includes/mainFunctions.inc.php');
include('scripts/mySQL.php');
$i=$_GET['id'];
?>
<!DOCTYPE html>
 
<html lang="es">
 
<head>
 	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../assets/img/ufps.ico">

    <title>IV SEMANA INTERNACIONAL Y XII SEMANA DE CIENCIA, TECNOLOG&Iacute;A E INNOVACI&Oacute;N</title>

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
<!--
function mostrarInstitucion(){
  //Si la opcion con id Conocido_1 (dentro del documento > formulario con name fcontacto >     y a  la vez dentro del array de Conocido) esta activada
  if (document.fcontacto.institucion.value == "0") {
  //muestra (cambiando la propiedad display del estilo) el div con id 'desdeotro'
    document.getElementById('ufps').style.display='block';
    document.getElementById('otro').style.display='none';               

  //por el contrario, si no esta seleccionada
  } else if (document.fcontacto.institucion.value == "1") {
    //oculta el div con id 'desdeotro'
    document.getElementById('otro').style.display='block';
    document.getElementById('ufps').style.display='none';
  }           
}

</script>

<script type="text/javascript">
<!--
function mostrarReferencia(){
	//Si la opcion con id Conocido_1 (dentro del documento > formulario con name fcontacto >     y a 	la vez dentro del array de Conocido) esta activada
	if (document.fcontacto.investigacion.value == "2") {
	//muestra (cambiando la propiedad display del estilo) el div con id 'desdeotro'
		document.getElementById('grupo').style.display='block';
		document.getElementById('semillero').style.display='none';               

	//por el contrario, si no esta seleccionada
	} else if (document.fcontacto.investigacion.value == "1") {
		//oculta el div con id 'desdeotro'
		document.getElementById('semillero').style.display='block';
		document.getElementById('grupo').style.display='none';
 	}           
}

function mostrarReferencia2(){
  //Si la opcion con id Conocido_1 (dentro del documento > formulario con name fcontacto >     y a  la vez dentro del array de Conocido) esta activada
  if (document.fcontacto.modalidad.value == "1") {
  
    document.getElementById('modalidad_otro').style.display='block';               

  //por el contrario, si no esta seleccionada
  } else if (document.fcontacto.modalidad.value != "1") {
    
    document.getElementById('modalidad_otro').style.display='none';
  }           
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
	        <li class="active"><a href="index.php">ASISTENTES</a></li>
	        <li><a href="semilleros.html">CONVOCATORIA SEMILLEROS</a></li>
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
                <div class="col-lg-6">
                    <h3>Formulario de Inscripci&oacute;n</h3>
                </div>
                            
                <div class="col-lg-12">
                    <div class="spacing"></div>
                    <p style="text-align: center;" >
                        
                        <p style="text-align: center;" ><a href="<p style="text-align: center;" ><br/><a href="https://docs.google.com/forms/d/e/1FAIpQLSfr6vEn1IP2RNXeYjGR7-CLlShQv-1RbnY-LoUE6UVMdJ_dyA/viewform" class="btn btn-theme">REGISTRARSE</a></p>	
                </div>
	<!--<div id="blue">
	    <div class="container">
			<div class="row">
				<h3>REGISTRO DE ASISTENTES</h3>
			</div> 
	    </div>  
	</div> -->
	<!--<div class="box-content alerts">
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
			    <strong>Error. Ya se encuentra registrado.</strong> 
			  </div>
		<?}?>
	  
	</div>

	<div class="container mtb" style="margin-top: 10px;">
	 	<div class="row">
	 		<div class="col-lg-8">	 			
		 		<form role="form" method="post" enctype="multipart/form-data" target="_parent"  action="controller/ponencia.php" name="fcontacto" >
					  <label for="InputName1">Nombres : <span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
					    <input class="form-control" required type="text" name="nombre" onkeypress="txNombres()" /><br/><br/>

					    <label for="InputName1">Apellidos : <span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label> <!-- -->
					  <!--  <input class="form-control" required type="text" name="apellidos" onkeypress="txNombres()" /><br/><br/>
					    
					    <label for="InputName1">N&uacute;mero de Identificaci&oacute;n : <span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
					    <input  class="form-control" required  type="text" name="id" onkeypress="ValidaSoloNumeros()"/>
					    
					<br/><br/>

					    <label for="InputName1">Email : <span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label><!-- -->
					 <!--   <input class="form-control" required  type="text"  name="mail" /><br/><br/>

					    <label for="InputName1">Celular : </label>
					    <input class="form-control" required  type="text" name="tel" onkeypress="ValidaSoloNumeros()"/><br/><br/>

					<label for="InputName1">Instituci&oacute;n o Empresa : <span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
					    <select class="form-control" name="institucion" onclick="mostrarInstitucion();">	
						   <option value="0"> UFPS </option>
					        <option value="1"> OTRO </option>
					    </select>
					    <br/><br/>
					    <div id="ufps" style="display:block;">            
					            <label for="InputName1">&Aacute;rea de Conocimiento : <span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
					            <select class="form-control"  required name="facultad" id="comboFacultad"> 
					             <option value=""> Seleccione </option>
					               <? echo getFacultad(); ?>   
					            </select>
					            <br/><br/>
					             <label for="InputName1" style="width: 270px; ">Unidad de Investigaci&oacute;n: </label>
					            <input class="rad" type="radio" name="investigacion" value="1" onclick="mostrarReferencia();"/><label style="width: 80px; font-size:11px;">Semillero</label>
					            <input class="rad" type="radio" name="investigacion" value="2" onclick="mostrarReferencia();"/><label style="width: 80px; font-size:11px;">Grupo</label>       
					            <br/><br/> 
					            <div id="facul">
						            <div id="grupo" style="display:none;"> 
						              <label for="InputName1">Grupo de Investigaci&oacute;n: <span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
						              <select class="form-control" name="grupo"> 
						                 <option value=""> Seleccione </option>
						                 <? echo getGrupo(); ?>
						              </select>
						           </div>  

						           <div id="semillero" style="display:none;"> 
						              <label for="InputName1">Semillero de Investigaci&oacute;n:<span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span> </label>
						              <select class="form-control" name="semillero"> 
						                 <option value=""> Seleccione </option>
						                 <? echo getSemillero(); ?>
						              </select>
						              
						           </div>

					           </div>
					           <br/><br/>
					        </div>
					        <div id="otro" style="display:none;">
					          <label for="InputName1">  </label> <input class="form-control" type="text" name="otro" /><br/><br/><br/>
					        </div>

					<label for="InputName1">Tipo de Participante: <span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
					    <select class="form-control"  name="modalidad" onclick="mostrarReferencia2();">
					        <option value="Estudiante">Estudiante</option>
					        <option value="Docente">Docente</option>
					        <option value="Profesional">Profesional</option>
					        <option value="1">OTRO</option>
					     </select>
					<br/>
					<div id="modalidad_otro" style="display:none;"> 
					  <label for="InputName1"> </label>
					   <input class="form-control"  type="text"  name="mod_otro" /><br/><br/>
					</div>

					  <br>
					  <button type="submit" class="btn btn-theme">Registrar</button><br><br>
				</form>-->
			</div> 
	 		
	 	</div> 
	 </div> 

		

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
                 Edificio Vicerrector&iacute;a Asistente de Investigaci&oacute;n y Extensi&oacute;n - Tel&eacute;fono (057)(7) 5776655 Ext 172.
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



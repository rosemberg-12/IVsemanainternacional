<?php
// Omitir errores
ini_set("display_errors", false);


// Incluimos nustro script php de funciones y conexi&oacute;n a la base de datos
include('scripts/gets.php');
include('includes/mainFunctions.inc.php');

$id_ponencia = substr(str_shuffle("0123456789"), 0, 6);

$i=$_GET['id'];

if($errorDbConexion == false){
	// MAnda a llamar la funci&oacute;n para mostrar la lista de usuarios
	$consultaUsuarios = consultaUsers($mysqli,$id_ponencia);
}
else
{
	// Regresa error en la base de datos
	$consultaUsuarios = '
		<tr id="sinDatos">
			<td colspan="8" class="centerTXT">ERROR AL CONECTAR CON LA BASE DE DATOS</td>
	   	</tr>
	';
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
	        
            <li class="active"><a href="../ponencia.html">INSCRIPCI&Oacute;N PONENCIAS</a></li>
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
				<h3>REGISTRO DE PONENCIA</h3>
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
			    <strong>Error. No se registro la ponencia.</strong> 
			  </div>
		<?}?>
	  
	</div>


	    <div class="hide" id="agregarUser" Title="Agregar Autor">
	    	<form action="" method="post" id="formUsers" name="formUsers">
	    		<fieldset id="ocultos">
	    			<input type="hidden" id="accion" name="accion" class="{required:true}"/>
	    			<input type="hidden" id="id_user" name="id_user" class="{required:true}" value="0"/>
	    			<input type="hidden" id="id_ponencia" name="id_ponencia" class="{required:true}" value="<?echo $id_ponencia?>"/>	    		</fieldset>
				<fieldset id="datosUser">
					<p>Nombre</p>
					<span></span>
					<input type="text" onkeypress="txNombres()" class="form-control {required:true} span3" id="nombre" name="nombre" placeholder="Nombre Completo" />
					<p>N&uacute;mero de Identificaci&oacute;n</p>
					<span></span>
					<input type="text" onkeypress="ValidaSoloNumeros()" class="form-control {required:true} span3" id="identificacion" name="identificacion" placeholder="N&uacute;mero de Identificaci&oacute;n" />
					<p>Email</p>
					<span></span>
					<input type="text" class="form-control {required:true} span3" id="email" name="email" placeholder="Correo Electronico"/>
					<p>Instituci&oacute;n o Empresa</p>
					<span></span>
			        <input type="radio" name="institucion" onclick="mostrarInstitucion();" checked value="UFPS"> UFPS
  					<input type="radio" name="institucion" onclick="mostrarInstitucion2();" value="0"> Otro

			        <div id="ufpsI" style="display:block;">
			            
			            <p>&Aacute;rea de Conocimiento</p>
			            <span></span>
			            <select name="facultad" class="form-control {required:true} span3" id="comboFacultad">	
			        	   <option value=""> Seleccione </option>
			               <? echo getFacultad(); ?>   
			            </select>
			            
			            <div id="facul">
			              <p>Grupo de Investigaci&oacute;n</p>
			              <span></span>
			                <select class="form-control {required:true} span3" name="grupo"> 
			                   <option value=""> Seleccione </option>
			                   <? echo getGrupo(); ?>
			                </select>
			           </div>
			        </div>
			        <div id="otroI" style="display:none;">
			          <p>  </p><span></span> <input type="text" class="form-control {required:true} span3" name="otroI" placeholder="Otra Instituci&oacute;n o Empresa"  />
			        </div>

					<p>Tipo</p>
					<span></span>
					<select  class="form-control {required:true} span3" id="usr_tipo" name="usr_tipo">
						<option value="">Seleccione</option>
						<option value="Autor-Ponente">Autor-Ponente</option>
						<option value="Autor">Autor</option>	        	
					</select>
					<br>
				</fieldset>
				<fieldset id="btnAgregar" style="text-align:center;">
					<input class="btn btn-inverse btn-small" type="submit" id="continuar" value="Guardar" />
					<br>
				</fieldset>

				<fieldset id="ajaxLoader" class="ajaxLoader hide">
					<img src="images/default-loader.gif">
					<p>Espere un momento...</p>
				</fieldset>
			</form>
	    </div>
	
	    <div id="dialog-borrar" title="Eliminar registro" class="hide">
			<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Este registro se borrar&aacute; de forma permanente. ¿Esta seguro?</p>
		</div>
		
		<div class="container">
			<h4>Datos de los Autores de la Ponencia</h4>
		    <section id="content" style="overflow-x: scroll;">
		    	<div id="btnAddUser" class="center addUser">
		    		<button id="goNuevoUser" class="btn btn-inverse btn-small"><i class="icon-plus"></i> Agregar Autor</button>
		    	</div>
				<div id="listaOrganizadores">
					<table id="listadoUsers" class="table table-striped table-bordered table-hover table-condensed">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>N° de Identificaci&oacute;n</th>
								<th>Email</th>
								<th>Instituci&oacute;n</th>
								<th>&Aacute;rea de Conocimiento</th>
								<th>Grupo de Investigaci&oacute;n</th>
								<th>Tipo de Participaci&oacute;n</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="listaUsuariosOK">
							<?php echo $consultaUsuarios ?>
						</tbody>
					</table>
				</div>

		    </section>
 		</div>
  		

	<div class="container mtb" style="margin-top: 10px;">
	 	<div class="row">
	 		<div class="col-lg-8">	 			
		 		<form role="form" method="post" enctype="multipart/form-data" target="_parent"  action="controller/ponencia.php" name="fcontacto" >
					  <br><h4>Datos de la Ponencia</h4>
					  <div class="form-group">
					  	<input type="hidden" id="id_ponencia" name="id_ponencia" class="{required:true}" value="<?echo $id_ponencia?>"/>
					    <label for="InputName1">T&iacute;tulo de Ponencia/Conferencia: <span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
					    <input class="form-control" type="text" name="titulo_ponencia" required />
					  </div>
					  <div class="form-group">
					    <label for="InputName1">Modalidad: <span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
				        <select class="form-control" name="modalidad">
				            <option>Magistral</option>
				         </select>
					  </div>
					  <div class="form-group">
					  	<label>Resumen de Ponencia:<span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
					  	<input class="form-control" name="archivo1" type="file" required/>    
					  </div>
					  <div class="form-group">
					  	<label>In-extenso:<span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
					  	<input class="form-control" name="archivo2" type="file" required/>    
					  </div>
					  <div class="form-group">
					  	<label>Hoja de Vida Resumen:<span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
					  	<input class="form-control" name="archivo3" type="file" required/>    
					  </div>
					  <div class="form-group">
					  	<label>Autorizaci&oacute;n para publicaci&oacute;n:<span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
					  	<input class="form-control" name="archivo4" type="file" required/>    
					  </div>
					  <div class="form-group">
					  	<label>Presentaci&oacute;n de la Ponencia:<span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
					  	<input class="form-control" name="archivo5" type="file" required/>    
					  </div>
					  
					  <br><br>
					  <h4>Datos del Proyecto de Investigaci&oacute;n</h4>
					  <div class="form-group">
					    <label for="InputName1">T&iacute;tulo del Proyecto de Investigaci&oacute;n: <span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
					    <input class="form-control" type="text" name="titulo_proyecto" required/>
					  </div>
					  <div class="form-group">
					    <label for="InputName1">Objetivos del Proyecto: <span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
				        <textarea class="form-control" name="objetivos" rows="3" required></textarea>
					  </div>
					  <div class="form-group">
					    <label for="InputName1">Estado del Proyecto: <span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
				        <select class="form-control" name="estado">
				            <option>En Ejecucion</option>
				            <option>Terminado</option>
				         </select>
					  </div>
					  <div class="form-group">
					    <label for="InputName1">Tipo de Financiaci&oacute;n: <span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label>
					    <input class="form-control" type="text" name="tipo_financiacion" required/>
					  </div>
                        
                       
					  <br>
					  <button type="submit" class="btn btn-theme">Registrar</button><br><br>
				</form>
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
                Edificio Vicerrector&iacute;a Asistente de Investigaci&oacute;n y Extensi&oacute;n- Tel&eacute;fono (057)(7) 5776655 Ext 172.
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



<?php
session_start();
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>crear</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/estilo_form.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

		<link href='css/jquery-ui.min.css' type='text/css' rel='stylesheet'>
		<link href='css/jquery-ui.css' type='text/css' rel='stylesheet'>

		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script src="js/jquery-3.4.1.min.js" type="text/javascript"></script>
		<script src="js/jquery-ui.min.js" type="text/javascript"></script>
		<script src="js/jquery-ui.js" type="text/javascript"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/estilossicon.css">

		  <style>
		  .modal-header, h4, .close {
		    background-color: #5cb85c;
		    color:white !important;
		    text-align: center;
		    font-size: 30px;
		  }
		  .modal-footer {
		    background-color: #f9f9f9;
		  }
		  .estilo-colorg{
				font-family: Montserrat, Medium;
				font-size: 100px;
				color:  #6f7271 ;
				font-weight: bold;
			}

			.tbody {
		      display:block;
		      max-height:500px;
		      overflow-y:auto;
		  }
		  .thead, .tbody .tr {
		      display:table;
		      width:180%;
		      table-layout:fixed;
		  }
		  .thead2 {
		      width: calc( 100% - 1em )
		  } 
		
		  </style>
		<script type="text/javascript">
		$(document).ready(function(){
			document.getElementById('correo').addEventListener('input', function() {
				campo = event.target;
				valido = document.getElementById('emailOK');
					
				emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
				//Se muestra un texto a modo de ejemplo, luego va a ser un icono
				if (emailRegex.test(campo.value)) {
				valido.innerText = "válido";
				} else {
				valido.innerText = "incorrecto";
				}
			});
		});

		

		</script>
	</head>
	<body>

	<?php 
			include "./Controller/configuracion.php";
			$usuarioSeguir = $_SESSION['usuario_rol'];

			$sqlNombre = "SELECT nombrePersonal, id_rol FROM usuarios WHERE usuario = '$usuarioSeguir'";
			$result = mysqli_query($conexion,$sqlNombre);
			$nombreU = mysqli_fetch_row($result);

			if(isset($_SESSION['usuario_rol'])) 
			{ 
				// $mensaje = "el valor es:" .$_SESSION['contador'];
				
			} else{
				header('Location: ../LoginMenu/vista/inicio.php');
			}
		 ?>
 <br>
 <br>
 <br>


		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar" class=" bordv">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-outline-secondary">
	          <i class="fa fa-bars"></i>
	          <br>
	          <span class="sr-only">Menú</span>
	        </button>
        </div>
				<div class="p-4 ">

		  		<img class="img-responsive" src="img/ss1.png" height="50" width="190">
	        <ul class="list-unstyled components mb-5">
	        	<br>
	        	<center>
	        	<li class=" estilo-color">
	            <h1><b><?php echo (" $nombreU[0]"); ?></b></h1>
	          </li>
	      </center>
	          <li class=" estilo-color">
			  <a href= <?php echo ("'./menuPrincipal.php?usuario_rol=$usuarioSeguir'"); ?> > Bandeja</a>
	          </li>

	          <br>
	          <br>
	          <br>
	          <br>
	          <br>
	          <br>
	          <br>
	          <li class=" estilo-color">
	              <a class="nav-link" href=  "../LoginMenu/vista/cerrarsesion.php" > Cerrar Sesión</a>
	          </li>
	          
	          </li>
	          <li class=" estilo-color">
             
	          </li>

	        </ul>

	 
	      </div>
    	</nav>



			<form enctype="multipart/form-data" method="post" action="./Controller/validar_creacion.php"> 
				<div class="rounded border border-dark plantilla-inputv text-center">
					<div class="form-row">
						<div class="col">
							<div class="form-group col-md-12">
								<label class="plantilla-label" for="correo">*Correo:</label>
								<input type="text" style= "display:none" id="rol_usr" name="rol_usr" value="<?php if(isset($_POST["rol_usr"])){ echo $usuarioSeguir;}else{ echo $usuarioSeguir;} ?>"   required>
								
								<input type="email" class="form-control rfcL border border-dark" id="correo" name="correo" placeholder="correo" value="<?php if(isset($_POST["correo"])){ echo $_POST["correo"];} ?>"   maxlength="59"  required>
								<span id="emailOK"></span>
							</div>

						</div>
						
						<div class="col">
				  			<div class="col">
				  			<label  class="plantilla-label" for="nombreT">NOMBRE COMPLETO: </label>

						   <div class="form-group col-md-12">
						        <input type="text" class="form-control border border-dark" id="nombre" name="nombre"  value="<?php if(isset($_POST["nombre"])){ echo $_POST["nombre"];} ?>" maxlength="159"required>
						   <!--  <p class="help-block">Ejemplo de texto de ayuda.</p> -->
						  </div>
						</div>

						
				</div>
			
				
					<div class="form-group col-md-12">
						<div class="col text-center">
							
							<div class="columnaBoton">	
								 <input type="submit" name="guardarAdj" class="btn btn btn-danger tamanio-button plantilla-input text-white bord" value="Guardar"><br> 

							</div>
							
						</div>
					</div>

			</form>

		</div>
	

	</div>
		<br>
			
	</center>

			
<script src="js/bootstrap.min.js"></script>
   	<script src="js/main.js"></script>
			
	</body>

</html>


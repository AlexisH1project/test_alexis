<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta charset="UTF-8">
    <title>sing in</title>
   
   
    <link href="resource/css/login.css" rel="stylesheet" type="text/css"/>
    <link href="resource/css/boton.css" rel="stylesheet" type="text/css"/>
        <script src="resource/js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="resource/js/login.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     <script type="text/javascript" src="js/code.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="../../roles/js/funciones.js"></script>
</head>
    <body onload="nobackbutton();">   
 <div class="banner-img">
           <img src="resource/images/ss2.png" width="35%" height="25%" alt="logoGobMX" vertical-align="center"/>
        </div>
        <br/>
        <br/>
        <br/>
        <div class=" container">
            <?php
            if(isset($_SESSION['contador'])) 
            { 
              $_SESSION['contador'] = $_SESSION['contador'] + 1; 
              $mensaje = 'Número de visitas: ' . $_SESSION['contador']; 
            } 
            else 
            { 
              $_SESSION['contador'] = 1; 
              $mensaje = 'Bienvenido a nuestra página web'; 
            } 
            
            ?>
            <div class="row">
                <div class="col-lg-12">

                    <div class="form">
                        <h:form class="login-form">
                             <div class="container">
                                <div class="form-signin" role="form">
                                    <h3 class="form-signin-heading">Ingrese los datos:</h3>
                                    <input type="text" name = "user" id="usuario" class="form-control" placeholder="usuario" required autofocus>
                                    <input type="password" id="pass" class="form-control" placeholder="contraseña" required>

							     			<br>
										    <br>
							
                                <button class="btn btn-danger" id="singin" type="button">ingresar</button>
                              
                       
                            </div>
                            <div class="container" id="resultado">
    
                            </div>                  
                        </h:form>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
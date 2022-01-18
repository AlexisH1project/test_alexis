<?php
    include "configuracion.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP; 

    $correo_env = strtolower($_POST['correo']);
    $usuario_env = $_POST['nombre'];
    $user_seguir = $_POST['rol_usr'];


function enviarCorreo($correo, $usuario, $rol, $codigo){
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';
    require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/OAuth.php';


    //SMTP needs accurate times, and the PHP time zone MUST be set
    //This should be done in your php.ini, but this is how to do it if you don't have access to that
    date_default_timezone_set('Etc/UTC');


    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->SMTPSecure = 'tls';
    $mail->Username = '8add26ec7134d2';
    $mail->Password = '8f6d653a147dec';

    $mail->setFrom('snoop.alexs@gmail.com', 'Aministrador WEPORT');
    //Set an alternative reply-to address
    $mail->addReplyTo($correo, $usuario);
    //Set who the message is to be sent to
    $mail->addAddress($correo, $usuario);
    $mail->addCC($correo, $usuario);
    //Set the subject line
    $mail->Subject = 'Confirmación de Regitro en WEPORT';
    $mail->isHTML(true);
    $mail->Body = "Confirmar tu registro; \n https://app-96e3117e-56c3-448f-82f3-c440ff6bb22b.cleverapps.io/roles/Controller/link_confirmacion.php?cod=".$codigo."\n"; // Mensaje a enviar
    

    //send the message, check for errors
    if (!$mail->send()) {
        // echo "<script>alert('Existe un Error al enviar su correo, favor de reportarlo al correo snoop.alexs@gmail.com'); window.location.href = '../crearUser.php?usuario_rol=$rol'</script>";
        echo "<script>alert('Existe un Error al enviar su correo, favor de reportarlo al correo snoop.alexs@gmail.com');</script>";
        //$mail->ErrorInfo;
    } else {
        echo "<script>alert('Correo enviado correctamente!'); window.location.href = '../crearUser.php?usuario_rol=$rol'</script>";
    }
    
    $asunto = "Este mensaje es de prueba"; 
    $cuerpo = ' 
    <html> 
    <head> 
    <title>Prueba de correo</title> 
    </head> 
    <body> 
    <h1>Hola amigos!</h1> 
    <p> 
    <b>Bienvenidos a mi correo electrónico de prueba</b>. Estoy encantado de tener tantos lectores. Este cuerpo del mensaje es del artículo de envío de mails por PHP. Habría que cambiarlo para poner tu propio cuerpo. Por cierto, cambia también las cabeceras del mensaje. 
    </p> 
    </body> 
    </html> 
    ';

    mail($correo_cl,$asunto,$cuerpo) ;
}

// validamos que el correo no exista en la DB
    $sql_consulta = "SELECT * FROM clientes WHERE correo = '$correo_env'";
    if($res_consulta=mysqli_query($conexion, $sql_consulta)){
        $row_clientes = mysqli_fetch_row($res_consulta);
        
		//----------------Sacamos la Hora ::: PARA TENER UN ID unico 
        $hoy = "select CURDATE()";
        $tiempo ="select curTime()";

        if ($resultHoy = mysqli_query($conexion,$hoy) AND $resultTime = mysqli_query($conexion,$tiempo)) {
                $row = mysqli_fetch_row($resultHoy);
                $row2 = mysqli_fetch_row($resultTime);
        }
        $hora = str_replace ( ":", '',$row2[0] ); 
        $fecha = str_replace ( "-", '',$row[0] ); 
        $cod = $fecha.$hora;
        if (empty($row_clientes) || count($row_clientes) == 0){
            $sql_insertar = "INSERT INTO clientes (id_personal, correo, nombre_c) VALUES ($cod,'$correo_env', '$usuario_env')";

            if($res_insert = mysqli_query($conexion, $sql_insertar)){
                //check se ingreso 
                enviarCorreo($correo_env, $usuario_env, $user_seguir,$fecha.$hora); // enviamos correo
            }else{
                echo "ERROR !!!!! al Insertar  :( <br>";
                echo ("<a href='javascript:history.back(1)'>Regresar</a>") ;
            }

        }else{
            echo "ya existe <br>";
            echo ("<a href='javascript:history.back(1)'>Regresar</a>") ;

        }
    }else{
        echo "Error en la conexion <br>";
        echo ("<a href='javascript:history.back(1)'>Regresar</a>") ;
    }


?>
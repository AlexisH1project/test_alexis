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
    


    //SMTP needs accurate times, and the PHP time zone MUST be set
    //This should be done in your php.ini, but this is how to do it if you don't have access to that
    date_default_timezone_set('Etc/UTC');

    $mail = new PHPMailer();
    //Tell PHPMailer to use SMTP
    $mail->isSMTP();
    //Enable SMTP debugging
    // SMTP::DEBUG_OFF = off (for production use)
    // SMTP::DEBUG_CLIENT = client messages
    // SMTP::DEBUG_SERVER = client and server messages
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    //Set the SMTP port number - likely to be 25, 465 or 587
    $mail->Port = 25; //25,465
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    //Username to use for SMTP authentication
    $mail->Username = 'ximenahernandez422@gmail.com';
    //Password to use for SMTP authentication
    $mail->Password = 'Natacion151020';
    //Set who the message is to be sent from
    $mail->setFrom('ximenahernandez422@gmail.com', 'Aministrador WEPORT');
    //Set an alternative reply-to address
    $mail->addReplyTo('ximenahernandez422@gmail.com', 'Admin');
    //Set who the message is to be sent to
    $mail->addAddress($correo, $usuario);
    //Set the subject line
    $mail->Subject = 'Confirmación de Regitro en WEPORT';
    $mail->Body = "Confirmar tu registro; \n localhost/admin_alexis/roles/Controller/link_confirmacion.php?cod=".$codigo."\n"; // Mensaje a enviar
    

    //send the message, check for errors
    if (!$mail->send()) {
        // echo "<script>alert('Existe un Error al enviar su correo, favor de reportarlo al correo snoop.alexs@gmail.com'); window.location.href = '../crearUser.php?usuario_rol=$rol'</script>";
        echo "<script>alert('Existe un Error al enviar su correo, favor de reportarlo al correo snoop.alexs@gmail.com');</script>";
        //$mail->ErrorInfo;
    } else {
        echo "<script>alert('Correo enviado correctamente!'); window.location.href = '../crearUser.php?usuario_rol=$rol'</script>";
    }
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
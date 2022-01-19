<?php
    include "configuracion.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\OAuth;
    use League\OAuth2\Client\Provider\Google;
    
 

    $correo_env = strtolower($_POST['correo']);
    $usuario_env = $_POST['nombre'];
    $user_seguir = $_POST['rol_usr'];


function enviarCorreo($correo, $usuario, $rol, $codigo){
    //Load Composer's autoloader
    require '../../vendor/autoload.php';
    
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    
    //Set the encryption mechanism to use:
    // - SMTPS (implicit TLS on port 465) or
    // - STARTTLS (explicit TLS on port 587)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    
    $mail->SMTPAuth = true;
    $mail->AuthType = 'XOAUTH2';
    
    $email = 'snoop.alexs@gmail.com'; // the email used to register google app
    $clientId = '408726769843-jpqq616hobcbl5jf355m647hqcmpicp6.apps.googleusercontent.com';
    $clientSecret = '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';
    
    $refreshToken = '1//031WvAbgBDj3RCgYIARAAGAMSNwF-L9Ir74J_l23c51OeARW4mbyCEnUWOsfd3I_ZoTSG7XRk0gXLaqsCd6ruUEfWVByTYRpf6D0';
    
    //Create a new OAuth2 provider instance
    $provider = new Google(
        [
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
        ]
    );
    
    //Pass the OAuth provider instance to PHPMailer
    $mail->setOAuth(
        new OAuth(
            [
                'provider' => $provider,
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
                'refreshToken' => $refreshToken,
                'userName' => $email,
            ]
        )
    );
    
    $mail->setFrom($email, 'Administrador WEPORT');
    $mail->addAddress($correo, $usuario);
    $mail->isHTML(true);
    $mail->Subject = 'Confirmamos Registro en WEPORT ';
    $mail->Body = '<b>Bienvenido a WEPORT :) </b><br>
                <b>Confirmar tu registro:<br> <a>https://app-96e3117e-56c3-448f-82f3-c440ff6bb22b.cleverapps.io/roles/Controller/link_confirmacion.php?cod='.$codigo.'</a></b><br>';
    
    //send the message, check for errors
    if (!$mail->send()) {
        echo "<script> alert(Existe un error :( al enviar correo, favor de reportarlo al @: snoop.alexs@gmail.com / ERROR: ' . $mail->ErrorInfo);  window.location.href = '../crearUser.php?usuario_rol=$rol'</script>" ;
    } else {
        echo "<script>alert('El correo se ha enviado :) '); window.location.href = '../crearUser.php?usuario_rol=$rol'</script>";
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
<?php
    include "configuracion.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\OAuth;
    use League\OAuth2\Client\Provider\Google;

    $cod = $_GET['cod'];


function enviarCorreo($codigo, $nombre_cl, $correo_cl){
    include "configuracion.php";
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';
    require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/OAuth.php';

    $sql_admin = "SELECT * FROM usuarios WHERE id_rol = 3";
    if($res_adm = mysqli_query($conexion, $sql_admin)){
        $row_adm = mysqli_fetch_row($res_adm);
    }

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
      $mail->addAddress($correo_cl, $nombre_cl);
      $mail->isHTML(true);
      $mail->Subject = 'Confirmación de Regitro en WEPORT';
      $mail->Body = '<b>"Confirmo: </b>"'. $nombre_cl. '"<br><b>Con correo; </b>"'. $correo_cl;
      
    //send the message, check for errors
    if (!$mail->send()) {
        echo "<script>alert('Existe un Error al confirmar su registro, favor de reportarlo al correo $row_adm[5]');</script>";
        //$mail->ErrorInfo;
    } else {
        echo "<script>alert('Confirmacion correcta!'); </script>";
    }
}

// validamos que el correo no exista en la DB
    $sql_consulta = "SELECT * FROM clientes WHERE id_personal = '$cod'";
    if($res_consulta=mysqli_query($conexion, $sql_consulta)){
        $row_clientes = mysqli_fetch_row($res_consulta);

        if (empty($row_clientes) || count($row_clientes) == 0){
                echo "No se pudo confirmar, no se encontro cliente ";
        }else{
            enviarCorreo($cod, $row_clientes[2],$row_clientes[1]);
        }
    }else{
        echo "Error en la conexion <br>";
    }


?>
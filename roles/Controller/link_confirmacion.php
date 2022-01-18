<?php
    include "configuracion.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP; 

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
    $mail->SMTPSecure = 'ssl';
    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    //Set the SMTP port number - likely to be 25, 465 or 587
    $mail->Port = 465; //25,465
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
    $mail->addAddress($correo_cl, $nombre_cl);
    //Set the subject line
  
    $mail->Subject = 'Confirmación de Regitro en WEPORT';
    $mail->Body = "Confirmo: ". $nombre_cl. "\nCon correo; ". $correo_cl; // Mensaje a enviar
    

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
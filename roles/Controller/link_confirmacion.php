<?php
    include "configuracion.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP; 

    $cod = $_GET['cod'];


function enviarCorreo($codigo, $nombre_cl, $correo_cl){
    include "configuracion.php";


     
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
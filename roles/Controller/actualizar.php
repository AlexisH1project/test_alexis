<?php
    include "configuracion.php";
    $cod = $_POST['cod'];
    $correo_n = strtolower($_POST['correo']);
    $nombre_n = $_POST['nombre'];
    $rol = $_POST['usuario_rol'];

// validamos que el correo no exista en la DB
    $sql_consulta = "UPDATE clientes SET nombre_c = '$nombre_n',  correo = '$correo_n' WHERE id_personal = '$cod'";
    if($res_consulta=mysqli_query($conexion, $sql_consulta)){
        echo "<script>alert('Se Actualizo Cliente'); window.location.href = '../up_supUser.php?usuario_rol=$rol'</script>";
    }else{
        echo "Error en la conexion <br>";
    }


?>
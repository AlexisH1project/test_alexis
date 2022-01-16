<?php
    include "configuracion.php";
    $cod = $_POST['cod'];
    $rol = $_POST['usuario_rol'];

// validamos que el correo no exista en la DB
    $sql_consulta = "DELETE FROM clientes WHERE id_personal = '$cod'";
    if($res_consulta=mysqli_query($conexion, $sql_consulta)){
        echo "<script>alert('Se Elimino Cliente'); window.location.href = '../up_supUser.php?usuario_rol=$rol'</script>";
    }else{
        echo "Error en la conexion <br>";
    }


?>
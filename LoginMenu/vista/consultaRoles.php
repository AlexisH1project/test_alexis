
<?php

    include "configuracion.php";
   // $_SESSION['usuario_rol'] =  $_GET["usuario"];
    // $ROL = $_POST['rol'];
    // /*
   session_start();

    $_SESSION['usuario_rol']=$_GET['usuario'];

    $consultaRol = " SELECT * FROM usuarios WHERE usuario = '".$_SESSION['usuario_rol']."'";
        
            //echo $_SESSION['usuario_rol'];
    if($consultaRol = mysqli_query($conexion,$consultaRol)){
                $row = mysqli_fetch_assoc($consultaRol);
                $ROL = $row['id_rol'];
                $unidad =  $row['unidadCorrespondiente'];
                // $alc_mun = utf8_encode($row['alc_mun']);
                // $estado = utf8_encode($row['estado']);
                // $colonia = utf8_encode($row['colonia']);  
                   echo $ROL;

             if($ROL == 0 && $unidad == ''){
             
                        // echo '<script language="javascript">alert("Datos correctos/ Puedes dar de Baja o Actualizar");</script>';
                    header('Location:../../roles/menuPrincipal.php?usuario_rol='.urlencode($_SESSION['usuario_rol']));
                       // echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=./capturista.php>';

            }
            if($ROL == 0 &&  $unidad != ''){
             
                        // echo '<script language="javascript">alert("Datos correctos/ Puedes dar de Baja o Actualizar");</script>';
                    header('Location:../../roles/unidadCaptura.php?usuario_rol='.urlencode($_SESSION['usuario_rol']));
                       // echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=./capturista.php>';

            }
            
            if($ROL == 1){
                        
                      //  echo '<script language="javascript">alert("Datos correctos/ Puedes dar Alta");</script>';
                    header('Location:../../roles/menuPrincipal.php?usuario_rol='.urlencode($_SESSION['usuario_rol']));
                  
            }

           if($ROL == 2){
                        //echo '<script language="javascript">alert("Datos correctos/ Puedes dar Alta");</script>';
                    header('Location:../../roles/menuPrincipal.php?usuario_rol='.urlencode($_SESSION['usuario_rol']));
            }  

            if($ROL == 3){
                        //echo '<script language="javascript">alert("Datos correctos/ Puedes dar Alta");</script>';
                    header('Location:../../roles/menuPrincipal.php?usuario_rol='.urlencode($_SESSION['usuario_rol']));
            }
            if($ROL == 4){
                        //echo '<script language="javascript">alert("Datos correctos/ Puedes dar Alta");</script>';
                    header('Location:../../roles/menuPrincipal.php?usuario_rol='.urlencode($_SESSION['usuario_rol']));//cambiar
            }if($ROL == 5){
                        //echo '<script language="javascript">alert("Datos correctos/ Puedes dar Alta");</script>';
                    header('Location:../../roles/consultaEstado.php?usuario_rol='.urlencode($_SESSION['usuario_rol']));//cambiar
            }if($ROL == 6){
                        //echo '<script language="javascript">alert("Datos correctos/ Puedes dar Alta");</script>';
                    header('Location:../../roles/menuPrincipal.php?usuario_rol='.urlencode($_SESSION['usuario_rol']));//cambiar//cambiar
            }if($ROL == 7){
                        //echo '<script language="javascript">alert("Datos correctos/ Puedes dar Alta");</script>';
                    header('Location:../../roles/menuPrincipal.php?usuario_rol='.urlencode($_SESSION['usuario_rol']));//cambiar//cambiar
            }if($ROL == 8){
                        //echo '<script language="javascript">alert("Datos correctos/ Puedes dar Alta");</script>';
                    header('Location:../../roles/menuPrincipal.php?usuario_rol='.urlencode($_SESSION['usuario_rol']));//cambiar//cambiar
            }


             
     }




?>


<?php
    session_start ();
    // if(!empty($_SESSION['usuario_rol']))
    // {
    // session_destroy ();
    // echo "Sesión finalizada";
    // echo "<meta http-equiv='refresh' content='0;url=inicio.html'>";
    // }
      // Borra todas las variables de sesión 
      if(isset($_SESSION['usuario_rol'])) 
      { 
        $usr = $_SESSION['usuario_rol'];
        session_destroy ();
        // echo "<meta http-equiv='refresh' content='0;url=inicio.php'>";
        // echo "<meta http-equiv='refresh' content='0; url=../../roles/menuPrincipal.php?usuario_rol='admin'>";
        echo "<script>window.location.href = '../../roles/menuPrincipal.php?usuario_rol=$usr'</script>";
        // echo "<meta http-equiv='refresh' content='0;url=inicio.php'>";


      }
          
        
 
//   // Borra la cookie que almacena la sesión 
//   if(isset($_COOKIE[session_name()])) { 
//     setcookie(session_name(), '', time() - 42000, '/'); 
//   } 
//   // Finalmente, destruye la sesión 

//   session_destroy(); 

?>
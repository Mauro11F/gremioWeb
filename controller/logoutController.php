<?php
   session_start();

   if (isset($_GET['funcion']) && $_GET['funcion'] === "cerrarSesion") {
      
      cerrarSesion();

      $_SESSION['msj'] = "Sesion Cerrada: nos vemos!";
      $_SESSION['color_msj'] = "note";

   }


   // $_SERVER['HTTP_REFERER'] -> nos devuelve la ruta 'completa' de donde se hizo la peticion anterior o reciente
   $url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'Desconocido';
   // guardo la parte '/pagina.php'
   $primeraParte = substr($url, strrpos($url, '/'));
   
   if (strlen($primeraParte) <= 1) {
      header("location: ../index.php");
      exit();
   }else {
      header("location: ..{$primeraParte}");
      exit();
   }
   


   function cerrarSesion() {
      // Si se desea eliminar la cookie de sesión, también se debe destruir
      // la cookie. Nota: esto destruirá la sesión y no solo los datos de la sesión.
      // if (ini_get("session.use_cookies")) {
      //    $params = session_get_cookie_params();
      //    setcookie(session_name(), '', time() - 42000,
      //       $params["path"], $params["domain"],
      //       $params["secure"], $params["httponly"]
      //    );
      // }
      
      // Destruyo la sesion
      session_destroy();

   }

?>
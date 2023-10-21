<?php

   include('../db/db.php');
   session_start();
   // var_dump($_GET);
   if (isset($_POST['email'])) {
      
      var_dump($_POST);
      $tipo_usuario = 3; // Cliente gremio
      $sector = 3; // Publico

      $query = "INSERT INTO usuario (nombre, apellido, contrasenia, telefono, email, fk_tipo_usuario, fk_sector) VALUES ('$_POST[user]','$_POST[lastName]','$_POST[pass]','$_POST[telefono]','$_POST[email]','$tipo_usuario','$sector') ";

      $result = mysqli_query($conn, $query)or die("Problemas al crear al usuario");

   }

   $query = "SELECT * FROM usuario WHERE nombre = '$_POST[user]' AND contrasenia = '$_POST[pass]' ";

   $result = mysqli_query($conn, $query)or die("Probleas con la obtencion de Usuario");

   if ($dato = mysqli_fetch_array($result)) {

      switch ($dato['fk_tipo_usuario']) {
         case '1':
            // Admin
            $_SESSION['user_id'] = $dato['id_usuario'];
            $_SESSION['rol'] = $dato['fk_tipo_usuario'];
            break;
         case '2':
            // Vendedor
            $_SESSION['user_id'] = $dato['id_usuario'];
            $_SESSION['rol'] = $dato['fk_tipo_usuario'];
            break;
         default:
            // Cliente Gremio
            $_SESSION['user_id'] = $dato['id_usuario'];
            $_SESSION['rol'] = $dato['fk_tipo_usuario'];
            break;
      }

      // Guardamos nombre y mensaje de exito
      $_SESSION['user_name'] = $dato['nombre'] . " " . $dato['apellido'];
      $_SESSION['msj'] = "Acceso Exitoso !!";
      $_SESSION['color_msj'] = "success";

   }else {

      // Cliente Publico
      $_SESSION['user_id'] = $dato['id_usuario'];
      $_SESSION['rol'] = $dato['fk_tipo_usuario'];
      $_SESSION['msj'] = "Nombre de usuario y/o contraseña incorrectos";
      $_SESSION['color_msj'] = "error";
   }

   // $_SERVER['HTTP_REFERER'] -> nos devuelve la ruta 'completa' de donde se hizo la peticion anterior o reciente
   $url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'Desconocido';
   echo $url . "<br>";

   $primeraParte = substr($url, strrpos($url, '/'));
   echo $primeraParte;
   echo "<br>";
   echo strlen($primeraParte);

   if (strlen($primeraParte) <= 1) {

      header("location: ../index.php");
      exit();
   }else {

      header(("Location: ..{$primeraParte}"));
      exit();
   }
?>
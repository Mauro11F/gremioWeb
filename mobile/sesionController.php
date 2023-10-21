<?php
   include("../db/db.php");

   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      
      if (isset($_GET['id'])) {
         
         $query = "SELECT nombre, fk_tipo_usuario FROM usuario WHERE id_usuario = '$_GET[id]' AND contrasenia = '$_GET[pass]' ";

         $result = mysqli_query($conn, $query)or die("Problema para taer el usuario: ". mysqli_error($conn));

         $datos = array();
         if ($result -> num_rows > 0) {
            $datos[] = array(
               'mensaje' => 'exito'
            );
         }else {
            $datos[] = array(
               'mensaje' => 'usuario y/o contraseña incorrectos'
            );
         }

         echo json_encode($datos);
      }
   }
?>
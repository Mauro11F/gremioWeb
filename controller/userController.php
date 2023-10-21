<?php

   include("../db/db.php");
   session_start();

   if (isset($_POST['clave']) && $_POST['clave'] === 'ajax') {
      
      if (isset($_POST['buscaEsto'])) {

         $buscar = $_POST['buscaEsto'];
         
         $query = "SELECT * FROM usuario INNER JOIN tipo_usuario ON usuario.fk_tipo_usuario = tipo_usuario.id_tipo_usuario INNER JOIN sector ON usuario.fk_sector = sector.id_sector WHERE usuario.nombre LIKE '%$buscar%' OR usuario.apellido LIKE '%$buscar%' ";

         $result = mysqli_query($conn, $query)or die("Problemas para datos ajax");

         $json = array();
         while ($fila = mysqli_fetch_assoc($result)) {
            $json[] = array(
               'id' => $fila['id_usuario'],
               'nombre' => $fila['nombre'].' '.$fila['apellido'],
               'tipoUsuario' => $fila['fk_tipo_usuario'],
               'sector' => $fila['fk_sector'],
               'telefono' => $fila['telefono'],
               'fecha' => $fila['fecha_inscripcion'],
               'correo' => $fila['email']
            );
         }

         $jsonString = json_encode($json);
         echo $jsonString;
         exit();
      }

   }elseif (isset($_POST['updateUser']) && $_POST['updateUser'] === 'Confirmar') {
      
      $query = "UPDATE usuario SET nombre = '$_POST[nombre]', apellido = '$_POST[apellido]', telefono = '$_POST[tel]', email = '$_POST[email]' WHERE id_usuario = '$_SESSION[user_id]' AND contrasenia = '$_POST[pass]' ";

      $result = mysqli_query($conn, $query)or die("Problemas para modificar el usuario: ". mysqli_error($conn));

      if ($result) {
         // echo "Modificado correctamente...";
         $_SESSION['msj'] = "Modificado Correctamente !!";
         $_SESSION['color_msj'] = "note";
      }else {
         // echo "Problemas en la modificacion...";
         $_SESSION['msj'] = "Contraseña incorrecta ?";
         $_SESSION['color_msj'] = "error";
      }

   }elseif (isset($_POST['updateTipo'])) {
      
      $nuevoTipoUsuario = $_POST['tipoUser'];
      $nuevoSector = $_POST['sector'];
      // Hacer alta de una vendedor en la empresa y colocarle un sector de trabajo

      $query = "UPDATE usuario SET fk_tipo_usuario = '$nuevoTipoUsuario', fk_sector = '$nuevoSector' WHERE id_usuario = '$_POST[id]'";

      $result = mysqli_query($conn, $query)or die("Problemas para cambiar tipo de usuario");

      if ($result) {
         $_SESSION['msj'] = "Modificacion Exitosa !!";
         $_SESSION['color_msj'] = "success";
      }else {
         $_SESSION['msj'] = "Problemas para modificar !!";
         $_SESSION['color_msj'] = "error";
      }

   }elseif (isset($_POST['deleteUser'])) {
      
      echo var_dump($_POST) . "<br>";
      echo " Borrando Usuario";
      // Borrar el usuario del sistema

      $query = "DELETE FROM usuario WHERE id_usuario = '$_POST[id]' ";

      $result = mysqli_query($conn, $query)or die("Problemas para eliminar usuario");

      if ($result) {
         $_SESSION['msj'] = "Se elimino el Usuario Correctamente";
         $_SESSION['color_msj'] = "success";
      }else {
         $_SESSION['msj'] = "No se pudo eliminar al Usuario";
         $_SESSION['color_msj'] = "error";
      }

   }else {
      echo "no pasa nada. ";
   }

   header("Location: ../profile.php");
   exit();

?>
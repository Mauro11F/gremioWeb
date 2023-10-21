<?php

   include("../db/db.php");
   session_start();

   // Cambiar el estado de los pedidos (pendientes... en proceso, listo, etc)
   // variables necesarias : id del pedido; por cual estado cambiar; (2)

   if (isset($_POST['confirmar']) && $_POST['confirmar'] === 'Confirmar') {
      
      $newEstate = $_POST['estadoPedido'];
      $idPedido = $_POST['id'];

      var_dump($_POST);
      $query = "UPDATE pedido SET fk_estado_pedido = '$newEstate' WHERE id_pedido = '$idPedido' ";

      $_SESSION['msj'] = "Estado actualizado Correctamente!";
      $_SESSION['color_msj'] = "note";

      mysqli_query($conn, $query)or die("Problemas apra actualizar el estado: ". mysqli_error($conn));

      header("Location: ../ordenes.php");
      exit();

   }

?>
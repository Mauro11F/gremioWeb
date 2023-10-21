<?php

   include("../db/db.php");


   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      
      // cliente mas efectivo o que compro mas, gasto mas
      // nombre clientes, cuanto gasto, en que mes?
      $query = "SELECT usuario.nombre, usuario.apellido, pedido.fecha, SUM(pedido.precio_final) AS 'sumaGastos' FROM pedido INNER JOIN usuario ON pedido.fk_usuario = usuario.id_usuario GROUP BY usuario.nombre ORDER BY sumaGastos DESC";

      $result = mysqli_query($conn, $query)or die("Problemas para taer ventas por usuario: ". mysqli_error($conn));

      $datos = array();
      while ($fila = mysqli_fetch_assoc($result)) {
         
         $datos[] = array(
            'nombre' => $fila['nombre']. " ". $fila['apellido'],
            'gasto' => $fila['sumaGastos'],
            'fecha' => date('m', strtotime($fila['fecha']))
         );
      }

      $jsonString = json_encode($datos);
      echo $jsonString;
      exit();

   }

?>
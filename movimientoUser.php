<?php
   include("db/db.php");
   session_start();

   $page = "profile";

   if (isset($_GET['id'])) {
                     
      $query = "SELECT usuario.nombre, tipo_usuario.descripcion,detalle_pedido.articulo, SUM(pedido.precio_final) AS 'sumaGastos', COUNT(pedido.precio_final) AS 'cantidadPedidos' FROM usuario INNER JOIN tipo_usuario ON usuario.fk_tipo_usuario = tipo_usuario.id_tipo_usuario INNER JOIN pedido ON pedido.fk_usuario = usuario.id_usuario INNER JOIN detalle_pedido ON detalle_pedido.fk_pedido = pedido.id_pedido WHERE usuario.id_usuario = '$_GET[id]' ORDER BY pedido.fecha DESC";

      $result = mysqli_query($conn, $query)or die("Problemas para traer los datos del usuario: ". mysqli_error($conn));

      $datos = array();
      while ($fila = mysqli_fetch_assoc($result)) {
         $datos[] = $fila;
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Movimientos</title>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

   <?php include("includes/header.php"); ?>

   <!-- Barra deslizante y menu de navegacion -->
   <?php include("includes/sidebar.php"); ?>

   <!-- contenido de la pagina -->
   
   <section class="movimentos">
      <h3 class="heading">Movimento de Usuario</h3>

      <div class="cardBox">
         <div class="card">
            <div>
               <div class="numbers"><?php echo ucfirst($datos[0]['nombre']) ?></div>
               <div class="cardName"><?php echo ucfirst($datos[0]['descripcion']) ?></div>
            </div>
            <div class="iconBx">
               <ion-icon name="person-outline"></ion-icon>
            </div>
         </div>
         <div class="card">
            <div>
               <div class="numbers"><?php echo $datos[0]['cantidadPedidos'] ?></div>
               <div class="cardName"> Pedidos </div>
            </div>
            <div class="iconBx">
               <ion-icon name="cart-outline"></ion-icon>
            </div>
         </div>
         <div class="card">
            <div>
               <div class="numbers"><?php echo substr($datos[0]['articulo'],0,8). "."?></div>
               <div class="cardName"> Más pedido </div>
            </div>
            <div class="iconBx">
               <ion-icon name="heart-outline"></ion-icon>
            </div>
         </div>
         <div class="card">
            <div>
               <div class="numbers"><?php echo "$".$datos[0]['sumaGastos'] ?></div>
               <div class="cardName"> Gastos totales </div>
            </div>
            <div class="iconBx">
               <ion-icon name="cash-outline"></ion-icon>
            </div>
         </div>
      </div>
   </section>

   <section class="detalles">
      <div class="recentOrders">
         <div class="cardHeader">
            <h3>Ordenes Recientes</h3>
            <a href="#" class="btn-ver">ver todos</a>
         </div>
         <table>
            <thead>
               <tr>
                  <th> Articulo </th>
                  <th> Precio </th>
                  <th> Estado </th>
                  <th> Tipo envio </th>
               </tr>
            </thead>
            <tbody>
               <?php

                  $query = "SELECT pedido.precio_final, pedido.direccion_envio, detalle_pedido.articulo, estado_pedido.descripcion FROM pedido INNER JOIN detalle_pedido ON pedido.id_pedido = detalle_pedido.fk_pedido INNER JOIN estado_pedido ON pedido.fk_estado_pedido = estado_pedido.id_estado_pedido WHERE pedido.fk_usuario = '$_GET[id]' ORDER BY pedido.fecha DESC LIMIT 6 ";

                  $result = mysqli_query($conn, $query)or die("Problemas para traer los pedidos historicos: ". mysqli_error($conn));

                  while ($fila = mysqli_fetch_assoc($result)) {?>
                     <tr>
                        <td><?php echo $fila['articulo']?></td>
                        <td><?php echo "$".$fila['precio_final']?></td>
                        <td><?php echo $fila['descripcion']?></td>
                        <td><?php echo $fila['direccion_envio']?></td>
                     </tr>
                     <?php
                  }
               ?>
            </tbody>
         </table>
      </div>

      <div class="recentCustomers">
         <div class="cardHeader">
            <h3> Top Clientes </h3>
         </div>
         <table>
            <?php
               $position = 0;
               $query = "SELECT usuario.nombre, tipo_usuario.descripcion, SUM(pedido.precio_final) AS 'sumaGastos' FROM usuario 
               INNER JOIN tipo_usuario ON usuario.fk_tipo_usuario = tipo_usuario.id_tipo_usuario
               INNER JOIN pedido ON pedido.fk_usuario = usuario.id_usuario
               GROUP BY pedido.fk_usuario ORDER BY 'sumaGastos' DESC LIMIT 6";

               $result = mysqli_query($conn, $query)or die("Problemas para traer los usuarios: ".mysqli_error($conn));

               while ($fila = mysqli_fetch_assoc($result)) {
                  $position += 1;
                  ?>
                  <tr>
                     <td><?php echo $position."°"?></td>
                     <td>
                        <div class="imgBx">
                           <img src="img/gremio.png" class="imgBx">
                        </div>
                     </td>
                     <td>
                        <h4><?php echo ucfirst($fila['nombre'])?><br><span><?php echo ucfirst($fila['descripcion'])?></span></h4>
                     </td>
                  </tr>
                  <?php
               }
            ?>
         </table>
      </div>

   </section>


   <?php include("includes/modals.php"); ?>

   <?php include("includes/notifications.php"); ?>

   <?php include("includes/footer.php"); ?>

</body>
</html>
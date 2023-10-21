<?php
   include("db/db.php");

   session_start();
   $page = 'ordenes';
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title> Ordenes </title>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
   <!-- header -->
   <?php include("includes/header.php"); ?>
   
   <!-- sidebar -->
   <?php include("includes/sidebar.php"); ?>

   <section class="ordenes">

      <h3 class="heading"> Ordenes Pendientes </h3>

      <div class="ordenes-container">
         <div class="filtros">
            <div class="search">
               <input type="search" name="" id="">
               <ion-icon name="search-outline"></ion-icon>
            </div>
            <button id="pendientes"><ion-icon name="ellipse"></ion-icon> Pendientes</button>
            <button id="masComprados"><ion-icon name="ellipse"></ion-icon> En proceso</button>
         </div>

         <div class="table-container">
            <table>
               <thead>
                  <tr>
                     <th> Serial </th>
                     <th> Fecha </th>
                     <th> Vendedor </th>
                     <th> Producto </th>
                     <th> Cantidad </th>
                     <th> Precio </th>
                     <th> Medio Pago </th>
                     <th> Retiro </th>
                     <th> Estado </th>
                     <?php
                        if (isset($_SESSION['rol']) && ($_SESSION['rol'] === '1' || $_SESSION['rol'] === '2')) {
                           echo '
                              <th> Accion </th>
                           ';
                        }
                     ?>
                  </tr>
               </thead>
               <tbody>
               <?php
                  // echo var_dump($_SESSION). "<br>";
                  if ((isset($_SESSION['rol'])) && ($_SESSION['rol'] === '1' || $_SESSION['rol'] === '2')) {
                     
                     $query = "SELECT usuario.nombre, pedido.*, detalle_pedido.*, estado_pedido.*, tipo_pago.descripcion AS 'desc_pago' FROM pedido INNER JOIN detalle_pedido ON pedido.id_pedido = detalle_pedido.fk_pedido INNER JOIN estado_pedido ON pedido.fk_estado_pedido = estado_pedido.id_estado_pedido INNER JOIN tipo_pago ON tipo_pago.id_tipo_pago = pedido.fk_tipo_pago INNER JOIN usuario ON pedido.fk_usuario = usuario.id_usuario WHERE pedido.fk_estado_pedido != 3 ORDER BY pedido.fecha DESC";
                     
                     $result = mysqli_query($conn, $query)or die("Problemas para taer datos del usuario: ". mysqli_error($conn));

                     $x = 0;
                     if (mysqli_num_rows($result) >= 1) {

                        while ($fila = mysqli_fetch_assoc($result)) {
                           // echo var_dump($fila) . "<br> aca termina";
                           $x += 1;
                           ?>
                              <tr>
                                 <td><?php echo $x; ?></td>
                                 <td><?php echo date("d-m-Y", strtotime($fila['fecha'])); ?></td>
                                 <td class="vendedor"><?php echo ucfirst($fila['nombre']); ?></td>
                                 <td><?php echo $fila['articulo']; ?></td>
                                 <td><?php echo $fila['cantidad']; ?></td>
                                 <td><?php echo "$".$fila['precio_total']; ?></td>
                                 <td class="metodoPago"><?php echo $fila['desc_pago']; ?></td>
                                 <td><?php echo $fila['direccion_envio']; ?></td>
                                 <form action="controller/estadosController.php" method="POST">
                                    <td class="estado pendiente">
                                       <select name="estadoPedido" id="estadoPedido">
                                          <option value="1" <?php echo ($fila['id_estado_pedido'] === '1' ? 'selected' : '');?>>pendiente</option>
                                          <option value="2" <?php echo ($fila['id_estado_pedido'] === '2' ? 'selected' : '');?>>en proceso</option>
                                          <option value="3" <?php echo ($fila['id_estado_pedido'] === '3' ? 'selected' : '');?>>listo</option>
                                          <option value="4" <?php echo ($fila['id_estado_pedido'] === '4' ? 'selected' : '');?>>cancelado</option>
                                          <option value="5" <?php echo ($fila['id_estado_pedido'] === '5' ? 'selected' : '');?>>devuelto</option>
                                       </select>
                                    </td>
                                    <td>
                                       <input type="hidden" name="id" value="<?php echo $fila['id_pedido']; ?>">
                                       <input type="submit" name="confirmar" value="Confirmar">
                                    </td>
                                 </form>
                                 
                              </tr>
                           <?php
                        }
                     }

                  } elseif ((isset($_SESSION['rol'])) && !empty($_SESSION['rol'])) {
                     // echo "Clientes";
                     // var_dump($_SESSION);
                     $query = "SELECT usuario.nombre, pedido.*, detalle_pedido.*, estado_pedido.*, tipo_pago.descripcion AS 'desc_pago' FROM pedido INNER JOIN detalle_pedido ON pedido.id_pedido = detalle_pedido.fk_pedido INNER JOIN estado_pedido ON pedido.fk_estado_pedido = estado_pedido.id_estado_pedido INNER JOIN tipo_pago ON tipo_pago.id_tipo_pago = pedido.fk_tipo_pago INNER JOIN usuario ON pedido.fk_usuario = usuario.id_usuario WHERE pedido.fk_usuario = '$_SESSION[user_id]' AND pedido.fk_estado_pedido != 3";

                     $result = mysqli_query($conn, $query)or die("Problemas para taer datos del usuario: ". mysqli_error($conn));

                     $x = 0;
                     if (mysqli_num_rows($result) >= 1) {

                        while ($fila = mysqli_fetch_assoc($result)) {
                           // echo var_dump($fila) . "<br> aca termina";
                           $x += 1;
                           ?>
                              <tr>
                                 <td><?php echo $x; ?></td>
                                 <td><?php echo date("d-m-Y", strtotime($fila['fecha'])); ?></td>
                                 <td class="vendedor"><?php ucfirst($fila['nombre']); ?></td>
                                 <td><?php echo $fila['articulo']; ?></td>
                                 <td><?php echo $fila['cantidad']; ?></td>
                                 <td><?php echo "$".$fila['precio_total']; ?></td>
                                 <td class="metodoPago"><?php echo $fila['desc_pago']; ?></td>
                                 <td><?php echo $fila['direccion_envio']; ?></td>
                                 <td class="estado pendiente"><?php echo $fila['descripcion']; ?></td>
                              </tr>
                           <?php
                        }
                     } else {
                        echo '
                        <tr class="accordion">
                           <td style="font-size: 16px; text-align: center;" colspan="8">
                              <p> No Tienes pedidos Realizados aun... </p>
                           </td>
                        </tr>
                        ';
                     }
                  }else {
                     echo '
                        <tr class="accordion">
                           <td style="font-size: 16px; text-align: center;" colspan="8">
                              <p> Debes iniciar Sesion !!... </p>
                           </td>
                        </tr>
                        ';
                  }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
      
   </section>

   <section class="ordenes">

      <h3 class="heading">Ordenes Ralizadas</h3>

      <div class="ordenes-container">
         <div class="filtros">
            <!-- <div class="search">
               <input type="search" name="" id="">
               <ion-icon name="search-outline"></ion-icon>
            </div> -->
            <button id="masComprados"><ion-icon name="ellipse"></ion-icon> Articulo más comprado</button>
            <button id="pendientes"><ion-icon name="ellipse"></ion-icon> Top Clientes</button>
            <button id="pendientes"><ion-icon name="ellipse"></ion-icon> Top Vendedores</button>
            <div class="buscaFecha">
               <div class="titulo" style="text-align: center;">
                  <p>buscar por fecha</p>
               </div>
               <input type="date" name="" id="">
               <input type="date" name="" id="">
               <input type="submit" value="Buscar">
            </div>
         </div>
         
         <div class="table-container">
            <table>
               <thead>
                  <tr>
                     <th> Serial </th>
                     <th> Fecha </th>
                     <th> Vendedor </th>
                     <th> Producto </th>
                     <th> Cantidad </th>
                     <th> Precio </th>
                     <th> Medio Pago </th>
                     <th> Estado </th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  // mostrando al admin todo
                     if ((isset($_SESSION['rol'])) && ($_SESSION['rol'] === '1' || $_SESSION['rol'] === '2')) {

                        $query = "SELECT usuario.nombre, pedido.*, detalle_pedido.*, estado_pedido.*, tipo_pago.descripcion AS 'desc_pago' FROM pedido INNER JOIN detalle_pedido ON pedido.id_pedido = detalle_pedido.fk_pedido INNER JOIN estado_pedido ON pedido.fk_estado_pedido = estado_pedido.id_estado_pedido INNER JOIN tipo_pago ON tipo_pago.id_tipo_pago = pedido.fk_tipo_pago INNER JOIN usuario ON pedido.fk_usuario = usuario.id_usuario WHERE pedido.fk_estado_pedido = 3 ORDER BY pedido.fecha DESC ";

                        $result = mysqli_query($conn, $query)or die("Problemas para taer datos del usuario: ". mysqli_error($conn));

                        $x = 0;
                        if (mysqli_num_rows($result) >= 1) {

                           while ($fila = mysqli_fetch_assoc($result)) {
                              // echo var_dump($fila) . "<br> aca termina";
                              if ($fila['descripcion'] !== 'pendiente' && $fila['descripcion'] !== 'en proceso') {
                                 $x += 1;
                              ?>
                                 <tr>
                                    <td><?php echo $x; ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($fila['fecha'])); ?></td>
                                    <td class="vendedor"><?php echo ucfirst($fila['nombre']); ?></td>
                                    <td><?php echo $fila['articulo']; ?></td>
                                    <td><?php echo $fila['cantidad']; ?></td>
                                    <td><?php echo "$".$fila['precio_total']; ?></td>
                                    <td class="metodoPago"><?php echo $fila['desc_pago']; ?></td>
                                    <td class="estado pendiente"><?php echo $fila['descripcion']; ?></td>
                                 </tr>
                              <?php
                              }
                           }
                        }
                     }elseif ((isset($_SESSION['rol'])) && !empty($_SESSION['rol'])) {
                        // mostrando al cliente su pedidos LISTOS
                        // echo "Clientes";
                        $query = "SELECT usuario.nombre, pedido.*, detalle_pedido.*, estado_pedido.*, tipo_pago.descripcion AS 'desc_pago' FROM pedido INNER JOIN detalle_pedido ON pedido.id_pedido = detalle_pedido.fk_pedido INNER JOIN estado_pedido ON pedido.fk_estado_pedido = estado_pedido.id_estado_pedido INNER JOIN tipo_pago ON tipo_pago.id_tipo_pago = pedido.fk_tipo_pago INNER JOIN usuario ON pedido.fk_usuario = usuario.id_usuario WHERE pedido.fk_usuario = '$_SESSION[user_id]' AND pedido.fk_estado_pedido = 3 ORDER BY pedido.fecha DESC";

                        $result = mysqli_query($conn, $query)or die("Problemas para taer datos del usuario: ". mysqli_error($conn));

                        $x = 0;
                        if (mysqli_num_rows($result) >= 1) {

                           while ($fila = mysqli_fetch_assoc($result)) {
                              // echo var_dump($fila) . "<br> aca termina";
                              if ($fila['descripcion'] !== 'pendiente' && $fila['descripcion'] !== 'en proceso') {
                                 $x += 1;
                              ?>
                                 <tr>
                                    <td><?php echo $x; ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($fila['fecha'])); ?></td>
                                    <td class="vendedor"><?php echo ucfirst($fila['nombre']); ?></td>
                                    <td><?php echo $fila['articulo']; ?></td>
                                    <td><?php echo $fila['cantidad']; ?></td>
                                    <td><?php echo "$".$fila['precio_total']; ?></td>
                                    <td class="metodoPago"><?php echo $fila['desc_pago']; ?></td>
                                    <td class="estado pendiente"><?php echo $fila['descripcion']; ?></td>
                                 </tr>
                              <?php
                              }
                           }
                        } else {
                           echo '
                           <tr class="accordion">
                              <td style="font-size: 16px; text-align: center;" colspan="8">
                                 <p> No Tienes pedidos Realizados aun... </p>
                              </td>
                           </tr>
                           ';
                        }
                     }else {
                        
                     }
                  ?>
            
               </tbody>
            </table>
      </div>
      

   </section>

   <!-- modals -->
   <?php include("includes/modals.php"); ?>

   <?php include("includes/notifications.php"); ?>

   <!-- footer -->
   <?php include("includes/footer.php"); ?>
   <script>

      document.addEventListener('DOMContentLoaded', function () {
         
         var pendientes = document.getElementById('pendientes');
         var masComprados = document.getElementById('masComprados');

         pendientes.addEventListener('click', function(){
            pendientes.classList.toggle('active');
         });
         masComprados.addEventListener('click', function() {
            masComprados.classList.toggle('active');
         });

         var estadoPedido = document.querySelectorAll('td.estado');
         estadoPedido.forEach( (celda) => {
            var textoCelda = celda.textContent;
            textoCelda = textoCelda.trim();
            // console.log(textoCelda);
            
            switch (textoCelda) {
               case 'pendiente':
                  
                  break;
               case 'en proceso':
                  celda.classList.remove('pendiente');
                  celda.classList.add('enProceso');
                  break;
               case 'listo':
                  celda.classList.remove('pendiente');
                  celda.classList.remove('enProceso');
                  celda.classList.add('listo');
                  break;
               case 'cancelado':
                  celda.classList.remove('pendiente');
                  celda.classList.remove('enProceso');
                  celda.classList.remove('listo');
                  celda.classList.add('cancelado');
                  break;
            
               default:
                  break;
            }

         });

         var idEstadoPedido = document.querySelectorAll('td.estado');
         idEstadoPedido.forEach( (dataSelect) => {
            console.log(dataSelect);
            var valorSelect = dataSelect.querySelector('select');
            console.log(valorSelect.value);
            switch (valorSelect.value) {
               case '1':
                  console.log("pendiente");
                  break;
               case '2':
                  dataSelect.classList.remove('pendiente');
                  dataSelect.classList.add('enProceso');
                  break;
               case '3':
                  dataSelect.classList.remove('pendiente');
                  dataSelect.classList.remove('enProceso');
                  dataSelect.classList.add('listo');
                  break;
               case '4':
                  dataSelect.classList.remove('pendiente');
                  dataSelect.classList.remove('enProceso');
                  dataSelect.classList.remove('listo');
                  dataSelect.classList.add('cancelado');
                  break;
            
               default:
                  console.log("No entro en ninguno");
                  break;
            }
         });
         // var textoEstado = estadoPedido ? estadoPedido.textContent : 'No se encontró la celda';
         // console.log(textoEstado);

      });

   </script>


</body>
</html>
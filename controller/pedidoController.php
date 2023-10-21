<?php
   session_start();
   include('../db/db.php');

   // Registro en las tablas "pedido" ; "detalle_pedido" y "producto_recetas"
   // Registro en las tablas "pedido" ; "detalle_pedido" y "producto_recetas"
   // Registro en las tablas "pedido" ; "detalle_pedido" y "producto_recetas"
   if (isset($_POST['pedido'])) {

      // Siempre insertar con "estado de pedido" en *pendiente = 1* y por el momento "tipo de pago" *mercado pago= 2*
      $estPedido = 1;
      $tipoPago = 2;

      if ($_POST['papel'] === '2') {
         //  Chambril_210gr

         $query = "
            SELECT id_tarjeta_210gr, fk_produc_receta,
               CASE 
                  WHEN '$_POST[cantidad]' = 100 THEN x100
                  WHEN '$_POST[cantidad]' >= 200 AND '$_POST[cantidad]' < 500 THEN x200
                  WHEN '$_POST[cantidad]' >= 500 AND '$_POST[cantidad]' < 1000 THEN x500 
                  WHEN '$_POST[cantidad]' = 1000 THEN x1000 
               END AS precio 
            FROM tarjetas_210gr WHERE lados = '$_POST[terminacion]'
         ";
         
         $resultado = mysqli_query($conn, $query)or die("Problemas con tarjetas_210gr sin laminado". mysqli_error($conn));

         $datos = mysqli_fetch_assoc($resultado);
         $precioTotal = floatval($datos['precio']); // Precio total. uso(tabla.pedido;  tabla.detalle_pedido)
         $fkProducReceta = $datos['fk_produc_receta']; // fk de producto, relacionado a la tabla produc_receta. uso(tabla.tarjeta_armada)

         // var_dump($precioTotal);
         // echo "<br>";
         
         $tarjeta = 'Tarjetas Chambril 210gr'; // articulo. uso(tabla.detalle_pedido)
         $lados = $_POST['terminacion']; // tipo de terminacion o lado color. uso(tabla.tarjeta_armada)
         $observaciones = $_POST['observacion']; // observaciones del cliente. uso(tabla.tajeta_armada)
         $cantidad = $_POST['cantidad']; // cantidad. uso(tabla.detalle_pedido;  tabla.tarjeta_armada)
         $precioUni = $precioTotal / $cantidad; // precio unitario. uso(tabla.detalle_pedido)
         $retiro = "retira en el local"; // tipo retiro. uso(tabla.pedido)

         // insertando datos en * pedido * --> detalle_pedido ---> tarjeta_armada

         $query = "INSERT INTO pedido (precio_final, direccion_envio, fk_tipo_pago, fk_estado_pedido, fk_usuario) VALUES ('$precioTotal', '$retiro', '$tipoPago', '$estPedido', '$_SESSION[user_id]') ";
         
         $resultado = mysqli_query($conn, $query)or die("Problemas para guardar el pedido: ". mysqli_error($conn));

         // mysqli_insert_id($conn); me devuelve el ultimo "id" o valor auincrementable insertado recientemente en la consulta
         $idPedido = mysqli_insert_id($conn); // id ultimo pedido. uso(tabla.detalle_pedido)

         // insertando datos en * detalle_pedido * ---> tarjeta_armada
         $query = "INSERT INTO detalle_pedido (articulo, cantidad, precio_unitario, precio_total, fk_pedido) VALUES ('$tarjeta', '$cantidad', '$precioUni', '$precioTotal', '$idPedido') ";

         $resultado = mysqli_query($conn, $query)or die("Problemas para insertar en detalle_pedido: ". mysqli_error($conn));

         $idDetallePedido = mysqli_insert_id($conn); // ultimo id de detalle pedido. uso(tabla.tarjeta_armada)

         // insertando datos en * tarjeta_armada *
         $query = "INSERT INTO tarjeta_armada (fk_detalle_pedido, fk_produc_recetas, cantidad, lados, precio_total, observaciones) VALUES ('$idDetallePedido', '$fkProducReceta', '$cantidad', '$lados', '$precioTotal', '$observaciones') ";

         $resultado = mysqli_query($conn, $query)or die("Problemas con guardar en Tarjeta Armada: ". mysqli_error($conn));

         if ($resultado) {
            echo "Datos guardados con exito en todas las tablas. <br>";
         }

      } elseif ($_POST['papel'] === '1') {
         
         if ($_POST['laminado'] === 'sinLaminar') {
            // tarjetas_300gr sin laminar

            $estPedido = 1;
            $tipoPago = 2;

            $query = "
            SELECT id_tarjeta, fk_produc_receta,
               CASE 
                  WHEN '$_POST[cantidad]' = 100 THEN x100
                  WHEN '$_POST[cantidad]' >= 200 AND '$_POST[cantidad]' < 500 THEN x200
                  WHEN '$_POST[cantidad]' >= 500 AND '$_POST[cantidad]' < 1000 THEN x500 
                  WHEN '$_POST[cantidad]' = 1000 THEN x1000 
               END AS precio 
            FROM tarjetas_300gr WHERE terminacion = '-' AND lados = '$_POST[terminacion]' ";

            $resultado = mysqli_query($conn, $query)or die("Problemas con tarjetas300gr sin laminado". mysqli_error($conn));

            $datos = mysqli_fetch_assoc($resultado);
            $precioTotal = floatval($datos['precio']); // Precio total. uso(tabla.pedido;  tabla.detalle_pedido)
            $fkProducReceta = $datos['fk_produc_receta']; // fk de producto, relacionado a la tabla produc_receta. uso(tabla.tarjeta_armada)

            // var_dump($precioTotal);
            // echo "<br>";
            
            $tarjeta = 'Tarjetas Ilustracion 300gr'; // articulo. uso(tabla.detalle_pedido)
            $lados = $_POST['terminacion']; // tipo de terminacion o lado color. uso(tabla.tarjeta_armada)
            $observaciones = $_POST['observacion']; // observaciones del cliente. uso(tabla.tajeta_armada)
            $cantidad = $_POST['cantidad']; // cantidad. uso(tabla.detalle_pedido;  tabla.tarjeta_armada)
            $precioUni = $precioTotal / $cantidad; // precio unitario. uso(tabla.detalle_pedido)
            $retiro = "retira en el local"; // tipo retiro. uso(tabla.pedido)

            // insertando datos en * pedido * --> detalle_pedido ---> tarjeta_armada

            $query = "INSERT INTO pedido (precio_final, direccion_envio, fk_tipo_pago, fk_estado_pedido, fk_usuario) VALUES ('$precioTotal', '$retiro', '$tipoPago', '$estPedido', '$_SESSION[user_id]') ";
            
            $resultado = mysqli_query($conn, $query)or die("Problemas para guardar el pedido: ". mysqli_error($conn));

            // mysqli_insert_id($conn); me devuelve el ultimo "id" o valor auincrementable insertado recientemente en la consulta
            $idPedido = mysqli_insert_id($conn); // id ultimo pedido. uso(tabla.detalle_pedido)

            // insertando datos en * detalle_pedido * ---> tarjeta_armada
            $query = "INSERT INTO detalle_pedido (articulo, cantidad, precio_unitario, precio_total, fk_pedido) VALUES ('$tarjeta', '$cantidad', '$precioUni', '$precioTotal', '$idPedido') ";

            $resultado = mysqli_query($conn, $query)or die("Problemas para insertar en detalle_pedido: ". mysqli_error($conn));

            $idDetallePedido = mysqli_insert_id($conn); // ultimo id de detalle pedido. uso(tabla.tarjeta_armada)

            // insertando datos en * tarjeta_armada *
            $query = "INSERT INTO tarjeta_armada (fk_detalle_pedido, fk_produc_recetas, cantidad, lados, precio_total, observaciones) VALUES ('$idDetallePedido', '$fkProducReceta', '$cantidad', '$lados', '$precioTotal', '$observaciones') ";

            $resultado = mysqli_query($conn, $query)or die("Problemas con guardar en Tarjeta Armada: ". mysqli_error($conn));

            if ($resultado) {
               echo "Datos guardados con exito en todas las tablas. <br>";
            }

         } else {

            // Con laminado. No importa el tipo(mate , brillante), el precio es el mismo

            $query = "
            SELECT id_tarjeta, fk_produc_receta,
               CASE 
                  WHEN '$_POST[cantidad]' = 100 THEN x100
                  WHEN '$_POST[cantidad]' >= 200 AND '$_POST[cantidad]' < 500 THEN x200
                  WHEN '$_POST[cantidad]' >= 500 AND '$_POST[cantidad]' < 1000 THEN x500 
                  WHEN '$_POST[cantidad]' = 1000 THEN x1000 
               END AS precio 
            FROM tarjetas_300gr WHERE terminacion = 'mate' AND lados = '$_POST[terminacion]' ";

            $resultado = mysqli_query($conn, $query)or die("Problemas con tarjetas300grLaminadas sin laminado". mysqli_error($conn));

            $datos = mysqli_fetch_assoc($resultado);
            $precioTotal = floatval($datos['precio']); // Precio total. uso(tabla.pedido;  tabla.detalle_pedido)
            $fkProducReceta = $datos['fk_produc_receta']; // fk de producto, relacionado a la tabla produc_receta. uso(tabla.tarjeta_armada)

            // var_dump($precioTotal);
            // echo "<br>";
            
            $tarjeta = 'Tarjetas Ilustracion 300gr laminado'; // articulo. uso(tabla.detalle_pedido)
            $lados = $_POST['terminacion']; // tipo de terminacion o lado color. uso(tabla.tarjeta_armada)
            $observaciones = $_POST['observacion']; // observaciones del cliente. uso(tabla.tajeta_armada)
            $cantidad = $_POST['cantidad']; // cantidad. uso(tabla.detalle_pedido;  tabla.tarjeta_armada)
            $precioUni = $precioTotal / $cantidad; // precio unitario. uso(tabla.detalle_pedido)
            $retiro = "retira en el local"; // tipo retiro. uso(tabla.pedido)

            // insertando datos en * pedido * --> detalle_pedido ---> tarjeta_armada

            $query = "INSERT INTO pedido (precio_final, direccion_envio, fk_tipo_pago, fk_estado_pedido, fk_usuario) VALUES ('$precioTotal', '$retiro', '$tipoPago', '$estPedido', '$_SESSION[user_id]') ";
            
            $resultado = mysqli_query($conn, $query)or die("Problemas para guardar el pedido: ". mysqli_error($conn));

            // mysqli_insert_id($conn); me devuelve el ultimo "id" o valor auincrementable insertado recientemente en la consulta
            $idPedido = mysqli_insert_id($conn); // id ultimo pedido. uso(tabla.detalle_pedido)

            // insertando datos en * detalle_pedido * ---> tarjeta_armada
            $query = "INSERT INTO detalle_pedido (articulo, cantidad, precio_unitario, precio_total, fk_pedido) VALUES ('$tarjeta', '$cantidad', '$precioUni', '$precioTotal', '$idPedido') ";

            $resultado = mysqli_query($conn, $query)or die("Problemas para insertar en detalle_pedido: ". mysqli_error($conn));

            $idDetallePedido = mysqli_insert_id($conn); // ultimo id de detalle pedido. uso(tabla.tarjeta_armada)

            // insertando datos en * tarjeta_armada *
            $query = "INSERT INTO tarjeta_armada (fk_detalle_pedido, fk_produc_recetas, cantidad, lados, precio_total, observaciones) VALUES ('$idDetallePedido', '$fkProducReceta', '$cantidad', '$lados', '$precioTotal', '$observaciones') ";

            $resultado = mysqli_query($conn, $query)or die("Problemas con guardar en Tarjeta Armada: ". mysqli_error($conn));

            if ($resultado) {
               echo "Datos guardados con exito en todas las tablas. <br>";
            }
         }

      }

      $_SESSION['msj'] = "Se ha registrado su pedido!";
      $_SESSION['color_msj'] = "success";

      header("Location: ../tarjetasPersonales.php");
      exit();

   }

   // Funcionamiento logico para AJAX
   // Funcionamiento logico para AJAX
   // Funcionamiento logico para AJAX
   if (isset($_POST['ajax']) && $_POST['ajax'] === 'true') {
      
      // json_decode() "transforma" el objeto JSON en array o dato que pueda interpretar PHP
      // $datos = json_decode($_POST['datos']);
      if ($_POST['papel'] === '2') {
         
         // cantidad , sin laminado
         $query = "
         SELECT papel, lado_color, lados,
            CASE
               WHEN '$_POST[cantidad]' = 100 THEN x100
               WHEN '$_POST[cantidad]' >= 200 AND '$_POST[cantidad]' < 500 THEN x200
               WHEN '$_POST[cantidad]' >= 500 AND '$_POST[cantidad]' < 1000 THEN x500
               WHEN '$_POST[cantidad]' = 1000 THEN x1000
            END AS precio
         FROM tarjetas_210gr WHERE lados = '$_POST[terminacion]' ";
         
         $resultado = mysqli_query($conn, $query)or die("Problemas con la peticion tarjetas210". mysqli_error($conn));

         $valor = mysqli_fetch_assoc($resultado);
         // $valor = $_POST['cantidad'];
         $jsonstring = json_encode($valor);
         echo $jsonstring;

      } elseif ($_POST['papel'] === '1') {
         
         if ($_POST['laminado'] === 'sinLaminar') {
            
            // preguntar tabla tarjetas_300gr "sin laminar"
            $query = "
            SELECT papel, lado_color, lados,
               CASE 
                  WHEN '$_POST[cantidad]' = 100 THEN x100
                  WHEN '$_POST[cantidad]' >= 200 AND '$_POST[cantidad]' < 500 THEN x200
                  WHEN '$_POST[cantidad]' >= 500 AND '$_POST[cantidad]' < 1000 THEN x500 
                  WHEN '$_POST[cantidad]' = 1000 THEN x1000 
               END AS precio 
            FROM tarjetas_300gr WHERE terminacion = '-' AND lados = '$_POST[terminacion]' ";

            $resultado = mysqli_query($conn, $query)or die("Problemas con tarjetas300gr sin laminado". mysqli_error($conn));

            $valor = mysqli_fetch_assoc($resultado);
            $jsonstring = json_encode($valor);
            echo $jsonstring;

         } else {
            
            $query = "
            SELECT papel, lado_color, lados,
               CASE 
                  WHEN '$_POST[cantidad]' = 100 THEN x100
                  WHEN '$_POST[cantidad]' >= 200 AND '$_POST[cantidad]' < 500 THEN x200
                  WHEN '$_POST[cantidad]' >= 500 AND '$_POST[cantidad]' < 1000 THEN x500 
                  WHEN '$_POST[cantidad]' = 1000 THEN x1000 
               END AS precio 
            FROM tarjetas_300gr WHERE terminacion = 'mate' AND lados = '$_POST[terminacion]' ";

            $resultado = mysqli_query($conn, $query)or die("Problemas con tarjetas300gr CON laminado". mysqli_error($conn));

            $valor = mysqli_fetch_assoc($resultado);
            $jsonstring = json_encode($valor);
            echo $jsonstring;
         }
      }
      // json_decode() transforma el objeto php en JSON
      // $jsonstring = json_encode($_POST['papel']);
      // echo $jsonstring;
   }else {
      echo json_encode("Error en la codificaion JSON: " . json_last_error_msg());
   }


?>
<?php
include("db/db.php");
session_start();
$page = 'newPedido';

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tarjetas Personales</title>
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

   <!-- header -->
   <?php include("includes/header.php"); ?>

   <!-- sidebar -->
   <?php include("includes/sidebar.php"); ?>

   <!-- contenido de la pagina -->

   <section class="tarjetas">

      <h3 class="heading">Tarjetas Personales</h3>

      <div class="notas">
         <div class="nota-parr">
            <p> (<span>*</span>) Indica que el campo es obligatorio.<br>El precio puede variar según la selección de terminaciones extras.</p>
         </div>
      </div>

      <div class="row">

         <form action="controller/pedidoController.php" method="POST" id="formulario">
            <div class="fila">
               <div class="columna">
                  <p>Archivo <span>*</span> </p>
                  <input type="file" name="archivo" id="" require>
               </div>
            </div>
            <div class="fila">
               <div class="columna">
                  <p>Papel <span>*</span> </p>
                  <select name="papel" id="tipoPapel" require>
                     <option value="" disabled selected>Seleccione tipo Papel</option>
                     <option value="1">Ilustracion 300gr</option>
                     <option value="2">Chambril 210gr</option>
                  </select>
               </div>
               <div class="columna">
                  <p>Cantidad <span>*</span> </p>
                  <select name="cantidad" id="" require>
                     <option value="" disabled selected>Seleccione una cantidad</option>
                     <option value="100">100</option>
                     <option value="200">200</option>
                     <option value="300">300</option>
                     <option value="400">400</option>
                     <option value="500">500</option>
                     <option value="600">600</option>
                     <option value="700">700</option>
                     <option value="800">800</option>
                     <option value="900">900</option>
                     <option value="1000">1000</option>
                  </select>
               </div>
            </div>
            <div class="fila">
               <div class="columna">
                  <!-- mostrar segun base de datos -->
                  <p>Terminaciones</p>
                  <div class="cont-color">
                     <div class="color">
                        <input type="radio" name="terminacion" id="" value="4/4" require>
                        <label for=""> Frente - Dorso Full color <span>(4/4)</span> </label>
                     </div>

                     <div class="color">
                        <input type="radio" name="terminacion" id="" value="4/0" require>
                        <label for=""> Frente Full color <span>(4/0)</span> </label>
                     </div>

                     <div class="color">
                        <input type="radio" name="terminacion" id="" value="4/1" require>
                        <label for=""> Frente Full color - Dorso 1 Color <span>(4/1)</span> </label>
                     </div>

                  </div>
               </div>

            </div>
            <div class="fila" id="laminado">
               <div class="columna">
                  <!-- laminado unicamnete parap Targetas 300gr -->
                  <p>Tipo de laminado</p>
                  <div class="cont-color">
                     <div>
                        <input type="radio" name="laminado" id="" value="brillante" require>
                        <label for=""> Laminado Brillante </label>
                     </div>

                     <div>
                        <input type="radio" name="laminado" id="" value="matte" require>
                        <label for=""> Laminado Matte </label>
                     </div>

                     <div>
                        <input type="radio" name="laminado" id="" value="sinLaminar" require checked>
                        <label for=""> Sin Laminado </label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="fila">
               <div class="columna">
                  <p>Observaciones</p>
                  <textarea name="observacion" id="" rows="5"></textarea>
               </div>
            </div>

            <div class="submit">
               <input type="submit" value="Realizar Pedido" name="pedido">
            </div>

         </form>

         <div class="carta">
            <p>El precio aplica unicamente para pago en efectivo y no incluye IVA.<br>Recordá que el pedido minimo mensual es de $5000</p>

            <div class="fila">
               <h3>Simulador de costo</h3>
               <div class="wallet">
                  <ion-icon name="wallet"></ion-icon>
                  <p id="dinero"><span>$</span>0.00</p> <!-- precio con PHP -->
               </div>
            </div>
            <div class="columna borde">
               <p>Papel:<span id="aca_papel"> --- </span> </p>
               <p>Cantidad:<span id="aca_cantidad"> --- </span> </p>
               <p>Terminacion:<span id="aca_terminacion"> --- </span> </p>
               <p>Laminado :<span id="aca_laminado"> --- </span> </p>
            </div>
            <div class="columna">
               <button id="consultaPrecio" type="submit"> Simular Costo </button>
            </div>

         </div>
      </div>
   </section>



   <!-- modals -->
   <?php include("includes/modals.php"); ?>

   <?php include("includes/notifications.php"); ?>

   <!-- footer -->
   <?php include("includes/footer.php"); ?>
   <script>

      document.addEventListener('DOMContentLoaded', function () {

         var precio = document.getElementById('consultaPrecio');
         precio.addEventListener('click', (event) => {

            var formulario = document.getElementById('formulario');

            var acaPapel = document.getElementById('aca_papel');
            var acaCantidad = document.getElementById('aca_cantidad');
            var acaTerminacion = document.getElementById('aca_terminacion');
            var acaLaminado = document.getElementById('aca_laminado');

            var datos = new FormData(formulario);
            datos.append('ajax', 'true');

            event.preventDefault();

            console.log([...datos.entries()]);

            acaLaminado.innerHTML = datos.get('laminado');
            acaCantidad.innerHTML = datos.get('cantidad') + "uni";

            fetch('controller/pedidoController.php', {
                  method: "POST",
                  body: datos
               })
               .then(function(response) {
                  return response.json();
               })
               .then(function(data) {
                  // devuelve los datos
                  // console.log(data);

                  const dinero = document.getElementById('dinero');
                  dinero.innerHTML = `
                                    <span>$</span>${data.precio}
                                    `;
                  acaPapel.innerHTML = data.papel.replace(/_/g, ' ');
                  acaTerminacion.innerHTML = data.lado_color + " (" + data.lados + ")";

               })
               .catch(function(error) {
                  console.error(error);
               });
         });         
      });

   </script>

</body>

</html>
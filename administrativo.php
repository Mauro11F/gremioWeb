<?php
   session_start();
   $page = "administrar";
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Panel Administrativo</title>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
   <?php include("includes/header.php"); ?>

   <?php include("includes/sidebar.php"); ?>

   <!-- contenido de la pagina -->
   <section class="administrar">

      <h3 class="heading"> Seccion administrativa </h3>

      <div class="graphBox">
         <div class="box">
            <canvas id=""></canvas>
         </div>
         <div class="box">
            <h4 class="heading"> Ventas durante el año </h4>
            <canvas id="myChart"></canvas>
         </div>
      </div>

   </section>

   <section>

      <h3 class="heading">Top Clientes</h3>

      <div class="graphBox">
         <div class="box">
            <canvas id="clienteEfect">myChart</canvas>
         </div>
         <div class="box">
            <table style="width: 100%;">
               <thead>
                  <tr>
                     <th> ... </th>
                     <th> Nombre </th>
                     <th> Gastado </th>
                     <th> Articulo mas comprado </th>
                     <th> fecha Inicio </th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td> 1° </td>
                     <td> Carlos Pollo </td>
                     <td> $59.450,00 </td>
                     <td> Tarjetas Personales 300gr </td>
                     <td> 01/05/1993 </td>
                  </tr>
                  <tr>
                     <td> 2° </td>
                     <td> Roque Rojas </td>
                     <td> $59.250,00 </td>
                     <td> Tarjetas Personales 300gr </td>
                     <td> 23/02/1998 </td>
                  </tr>
                  <tr>
                     <td> 3° </td>
                     <td> Mario Fernandez </td>
                     <td> $26.520,00 </td>
                     <td> Impresiones A3+ </td>
                     <td> 15/03/2000 </td>
                  </tr>
                  <tr>
                     <td> 4° </td>
                     <td> Maria Rosa </td>
                     <td> $7.230,00 </td>
                     <td> Tarjetas Personales 210gr </td>
                     <td> 27/01/2020 </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </section>

   <?php include("includes/modals.php"); ?>

   <?php include("includes/notifications.php"); ?>

   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <script>

         function crearTorta() {
            
            const clienteEfectivo = document.getElementById('clienteEfect');
            var myChart = new Chart(clienteEfectivo, {
               type: 'pie',
               data: {
                  labels: [], // etiquetas del grafico
                  datasets: [{
                     label: 'Cliente mas Efectivo',
                     data: [], // datos del grafico
                     backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgba(93, 170, 16)'
                     ],
                     hoverOffset: 4
                  }]
               },
               options: {
                  responsive: true,
               }
            });

            return myChart;
         }

         async function topClientes() {

            const myChart = crearTorta(); // crea el grafico y almacena la referencia
            
            let url = 'controller/statisticsController.php';
            const response = await fetch(url);
            const datos = await response.json();

            mostrar(datos, myChart);

            function mostrar(clientes, chart) {
               clientes.forEach(element => {
                  chart.data.labels.push(element.nombre);
                  chart.data.datasets[0].data.push(element.gasto);
               });

               chart.update();
            }
         }


      document.addEventListener('DOMContentLoaded', function() {

         topClientes();

         // graficos estadisticos
         const ctx = document.getElementById('myChart');
         new Chart(ctx, {
            type: 'bar',
            data: {
               labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
               datasets: [{
                  label: 'Rendimiento 2023',
                  data: [1280700, 2029200, 3210090, 5918100, 2020910, 3219100, 2039300, 3019100, 9594100, 3789100, 3439100, 7458900],
                  backgroundColor: [
                     'rgba(255, 99, 132, 0.7)',
                     'rgba(54, 162, 235, 0.7)',
                     'rgba(255, 206, 86, 0.7)',
                     'rgba(75, 192, 192, 0.7)',
                     'rgba(153, 102, 255, 0.7)',
                     'rgba(255, 159, 64, 0.7)',
                     'rgba(255, 99, 132, 0.7)',
                     'rgba(54, 162, 235, 0.7)',
                     'rgba(255, 206, 86, 0.7)',
                     'rgba(75, 192, 192, 0.7)',
                     'rgba(153, 102, 255, 0.7)',
                     'rgba(255, 159, 64, 0.7)',                  
                  ],
                  borderWidth: 1
                  
               }]
            },
            options: {
               responsive: true,
            }
         });         

         
      });
   
   </script>

   <?php include("includes/footer.php"); ?>


</body>
</html>
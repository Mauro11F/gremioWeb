<?php
session_start();
$page = 'home';
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sliding sidebar Menu</title>
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include("includes/header.php"); ?>

   <!-- Barra deslizante y menu de navegacion -->
   <?php include("includes/sidebar.php"); ?>

   <!-- contenido de la pagina -->
   <section class="home">

      <div class="row active">
         <div class="slide">
            <div class="content">
               <span>Lorem, ipsum dolor.</span>
               <h3>Lorem, ipsum dolor.</h3>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum voluptates totam qui minima corporis?</p>
               <a href="" class="btn">Más info</a>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="slide">
            <div class="content">
               <span>Lorem, ipsum dolor.</span>
               <h3>Lorem, ipsum dolor.</h3>
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi distinctio sed rerum quisquam obcaecati doloribus non quaerat, veritatis est nihil!</p>
               <a href="" class="btn">Más info</a>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="slide">
            <div class="content">
               <span>Lorem, ipsum dolor.</span>
               <h3>Lorem ipsum dolor sit amet.</h3>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum voluptates totam qui minima corporis?</p>
               <a href="" class="btn">Más info</a>
            </div>
         </div>
      </div>

      <div id="prev" onclick="prev()">
         <ion-icon name="chevron-back-outline"></ion-icon>   
      </div>
      <div id="next" onclick="next()">
         <ion-icon name="chevron-forward-outline"></ion-icon>
      </div>

   </section>

   <section class="services">

      <h3 class="heading">Services</h3>

   </section>

   <?php include("includes/modals.php"); ?>

   <?php include("includes/notifications.php") ?>

   <?php include("includes/footer.php"); ?>


</body>

</html>
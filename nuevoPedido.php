<?php 
   session_start(); 
   $page = 'newPedido';
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Nuevo Pedido</title>
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

   <!-- header -->
   <?php include("includes/header.php"); ?>
   
   <!-- sidebar -->
   <?php include("includes/sidebar.php"); ?>

   <!-- contenido de la pagina -->

   <section class="productos">
      <h1 class="heading">Nuevo pedido</h1>

      <div class="box-container">

         <a href="granFormato.php" class="box" style="pointer-events: none; opacity: 0.7">
            <div class="icon">
               <ion-icon name="arrow-redo-sharp"></ion-icon>
            </div>
            <img src="img/granFormato.png" alt="">
            <h3>Gran Formato</h3>
         </a>

         <a href="#" class="box" style="pointer-events: none; opacity: 0.7">
            <div class="icon">
               <ion-icon name="arrow-redo-sharp"></ion-icon>
            </div>
            <img src="img/ploter.png" alt="">
            <h3>Sublimación</h3>
         </a>

         <a href="#" class="box" style="pointer-events: none; opacity: 0.7">
            <div class="icon">
               <ion-icon name="arrow-redo-sharp"></ion-icon>
            </div>
            <img src="img/banner.png" alt="">
            <h3>Porta Banner + lona impresa</h3>
         </a>

         <a href="impreLaserA3.php" class="box">
            <div class="icon">
               <ion-icon name="arrow-redo-sharp"></ion-icon>
            </div>
            <img src="img/impresoraA3.png" alt="">
            <h3>impresion laser A3</h3>
         </a>

         <a href="#" class="box">
            <div class="icon">
               <ion-icon name="arrow-redo-sharp"></ion-icon>
            </div>
            <img src="img/impresora3.png" alt="">
            <h3>impresion laser A4</h3>
         </a>
         <a href="#" class="box" style="pointer-events: none; opacity: 0.7">
            <div class="icon">
               <ion-icon name="arrow-redo-sharp"></ion-icon>
            </div>
            <img src="img/papeles.png" alt="">
            <h3>hojas membretadas</h3>
         </a>
         <a href="#" class="box" style="pointer-events: none; opacity: 0.7">
            <div class="icon">
               <ion-icon name="arrow-redo-sharp"></ion-icon>
            </div>
            <img src="img/folleto.png" alt="">
            <h3>talonarios & recetarios</h3>
         </a>
         <a href="#" class="box" style="pointer-events: none; opacity: 0.7">
            <div class="icon">
               <ion-icon name="arrow-redo-sharp"></ion-icon>
            </div>
            <img src="img/folleto.png" alt="">
            <h3>talonarios & recetarios b/n</h3>
         </a>
         <a href="tarjetasPersonales.php" class="box">
            <div class="icon">
               <ion-icon name="arrow-redo-sharp"></ion-icon>
            </div>
            <img src="img/tarjeta.png" alt="">
            <h3>tarjetas personales</h3>
         </a>
         <a href="#" class="box" style="pointer-events: none; opacity: 0.7">
            <div class="icon">
               <ion-icon name="arrow-redo-sharp"></ion-icon>
            </div>
            <img src="img/carpetaCorp1.png" alt="">
            <h3>carpetas corporativas</h3>
         </a>
      </div>
   </section>

   <!-- modals -->
   <?php include("includes/modals.php"); ?>

   <?php include("includes/notifications.php"); ?>

   <!-- footer -->
   <?php include("includes/footer.php"); ?>
</body>

</html>
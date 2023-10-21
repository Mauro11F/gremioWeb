<?php
   session_start();
   $page = 'newPedido';
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Gran Formato</title>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   <style>
      section
      {
         display: flex;
         justify-content: space-between;
      }
      div label span
      {
         color: red;
      }
      div h3 span
      {
         color: #1ee21e;
      }
   </style>
   
   <?php include("includes/header.php"); ?>

   <?php include("includes/sidebar.php"); ?>
   
   <!-- Contenido de la pagina -->
   <section>
      <div>
         <label for="">Productos <span>*</span></label>
         <br>
         <input type="text" placeholder="F - Impresion Digital Laser A3">
         <br>
         <br>
         <label for="">Archivo <span>*</span></label>
         <br>
         <input type="file" name="" id="">
         <br>
         <br>
         <label for="">Color <span>*</span></label>
         <br>
         <input type="checkbox" name="" id="">
         <label for="">Simple Laser A3 Color</label>
         <input type="checkbox" name="" id="">
         <label for="">Doble faz A3 Color</label>
         <br>
         <label for="">Medida <span>*</span></label>
         <br>
         <select name="">
            <option value="">Seleccione una medida</option>
         </select>
         <br>
         <label for="">Cantidad <span>*</span></label>
         <br>
         <input type="number" name="" id="" placeholder="cantidad">
         <br>
         <br>
         <hr>
         <br>
         <input type="checkbox" name="" id="">
         <label for="">Chambril 120 grs</label>
         <br>
         <input type="checkbox" name="" id="">
         <label for="">Chambril 180 grs</label>
         <br>
         <input type="checkbox" name="" id="">
         <label for="">Chambril 210 grs</label>
         <br>
         <input type="checkbox" name="" id="">
         <label for="">Ilustración 130 Gramos</label>
         <br>
         <input type="checkbox" name="" id="">
         <label for="">Ilustración 200/230 Gramos</label>
         <br>
         <input type="checkbox" name="" id="">
         <label for="">Ilustración 270 Gramos A3+</label>
         <br>
         <br>
         <label for="">Observaciones</label>
         <br>
         <textarea name="" id="" cols="30" rows="10"></textarea>
      </div>
      
      <div>
         <h3>Total: <span>$</span>3000</h3>
      </div>

   </section>
   
   <?php include("includes/modals.php"); ?>

   <?php include("includes/notifications.php"); ?>
   
   <?php include("includes/footer.php"); ?>


</body>
</html>
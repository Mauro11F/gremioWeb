<?php
session_start();
$page = "newPedido";
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Impresion Lazer A3</title>
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

   <style>
      span {
         color: red;
      }
   </style>


   <?php include("includes/header.php"); ?>

   <?php include("includes/sidebar.php"); ?>


   <section>

      <h3 class="heading">Impresiones Laser A3</h3>

      <form action="">

         <p><span>*</span>Indica que el campo es obligatorio</p>
         <br>
         <p>El precio puede variar según a la selección de termincaciones y extras.</p>
         <br>

         <p>Producto <span>*</span></p>
         <select name="" id="" disabled="disabled">
            <option value="">Impresion Digital Lazer A3</option>
         </select>
         <br>
         <br>
         <p>Archivo <span>*</span></p>
         <input type="file" name="" id="">
         <br>
         <br>
         <p>Color <span>*</span></p>
         <input type="radio" name="tipoFaz" value="1">
         <label for=""> Simple Faz A3 Color </label>
         <br>
         <input type="radio" name="tipoFaz" value="2">
         <label for=""> Doble Faz A3 Color </label>
         <br>
         <br>
         <p>Medida <span>*</span></p>
         <select name="" id="">
            <option value=""> A3 </option>
         </select>
         <br>
         <br>
         <p>Cantidad <span>*</span></p>
         <input type="number" name="" id="">
         <br>
         <br>
         <h4>Terminaciones</h4>
         <hr>
         <br>
         <br>
         <input type="radio" name="terminacion" id="" value="1">
         <label for="">Chambril 120 grs</label>
         <input type="radio" name="terminacion" id="" value="1">
         <label for="">Chambril 210 grs</label>
         <input type="radio" name="terminacion" id="" value="1">
         <label for="">Ilustracion 130 grs</label>
         <input type="radio" name="terminacion" id="" value="1">
         <label for="">Ilustracion 200/230 grs</label>
         <input type="radio" name="terminacion" id="" value="1">
         <label for="">Ilustracion 270 grs A3+</label>
         <input type="radio" name="terminacion" id="" value="1">
         <label for="">Ilustracion 300 grs</label>
         <br>
         <br>
         <h4>Observacioens</h4>
         <hr>
         <br>
         <textarea name="" id="" cols="100" rows="10" placeholder="Escriba alguna obsevacion adicional sobre su pedido...">

         </textarea>

      </form>

   </section>


   <?php include("includes/modals.php"); ?>

   <?php include("includes/notifications.php"); ?>

   <?php include("includes/footer.php"); ?>


</body>

</html>
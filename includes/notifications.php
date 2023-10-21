<?php
   if (isset($_SESSION['msj'])) {?>
      <div class="alert show <?php echo $_SESSION['color_msj']?>">
         <ion-icon class="alert-icon <?php echo $_SESSION['color_msj']?>" name="alert-circle"></ion-icon>
         <span class="msg <?php echo $_SESSION['color_msj']?>"> <?php echo $_SESSION['msj']?> </span>
         <span class="close-btn <?php echo $_SESSION['color_msj']?>" onclick="closeNoti();">
            <ion-icon class="<?php echo $_SESSION['color_msj']?>" name="close"></ion-icon>
         </span>
      </div>
   <?php

      // Elimino el mensaje una ves mostrado...
      unset($_SESSION['msj']);
      unset($_SESSION['color_msj']);

   }
?>

<?php
   // Los datos de "tipo de alertas" se podrian enviar por *session* alterando las clases de estas alertas o notificaciones (warning, error, success y note).
   // msg:
   // {
   //    msg_color : 'success',
   //    msg : 'Se ah guardado correctamente...'
   // }
?>
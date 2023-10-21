<header class="header">
   <div class="flex">
      <div class="toggle">
         <ion-icon name="menu-outline"></ion-icon>
      </div>

      <?php
      if (!empty($_SESSION)) {
         switch ($_SESSION['rol']) {
            case '1':
               // Admin
               echo "
                     <div class='profile'>
                        <h3>{$_SESSION['user_name']}<br><span>Admin</span></h3>
                        <div class='user'>
                           <img src='img/admin.png'>
                        </div>
                     </div>
                  ";
               break;
            case '2':
               // Vendedor
               echo "
                     <div class='profile'>
                        <h3>{$_SESSION['user_name']}<br><span>Vendedor</span></h3>
                        <div class='user'>
                           <img src='img/vendedor2.png'>
                        </div>
                     </div>
                  ";
               break;
            case '3':
               // Cliente Gremio
               echo "
                     <div class='profile'>
                        <h3>{$_SESSION['user_name']}<br><span>Gremio</span></h3>
                        <div class='user'>
                           <img src='img/gremio.png'>
                        </div>
                     </div>
                  ";
               break;
            default:
               // Cliente Publico
               echo "
                     <div class='profile'>
                        <h3>Anonimo<br><span>Publico</span></h3>
                        <div class='user'>
                           <img src='img/public.png'>
                        </div>
                     </div>
                  ";
               break;
         }
      } else {
         echo "
               <div class='profile'>
                  <h3>Anonimo<br><span>Publico</span></h3>
                  <div class='user'>
                     <img src='img/public.png'>
                  </div>
               </div>
           ";
      }
      ?>
      <!-- Menu flotante para opciones de usuarios y/o log-out -->
      <?php
      if (!empty($_SESSION['rol'])) {
         echo '
               <div class="menu">
                  <ul>
                     <li>
                        <a href="#"><ion-icon name="person-outline"></ion-icon> Profile </a>
                     </li>
                     <li>
                        <a href="#"><ion-icon name="help-outline"></ion-icon> Help </a>
                     </li>
                     <li>
                        <a href="controller/logoutController.php?funcion=cerrarSesion" ><ion-icon name="log-out-outline"></ion-icon> Logout </a>
                     </li>
                  </ul>
               </div>
               ';
      }
      ?>
   </div>
</header>
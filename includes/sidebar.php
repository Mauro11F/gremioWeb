<div class="sidebar">
      <ul>
         <li class="logo">
            <a href="index.php">
               <span class="icon"><ion-icon name="logo-apple"></ion-icon></span>
               <span class="text">GremioWeb</span>
            </a>
         </li>
         <li class="list <?php echo ($page == 'home') ? 'active' : '';?>">
            <b></b>
            <b></b>
            <a href="index.php">
               <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
               <span class="text">Inicio</span>
            </a>
         </li>
         <li class="list <?php echo ($page == 'profile') ? 'active' : '';?>">
            <b></b>
            <b></b>
            <a href="profile.php">
               <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
               <span class="text">Cuenta</span>
            </a>
         </li>
         <li class="list <?php echo ($page == 'ordenes') ? 'active' : '';?>">
            <b></b>
            <b></b>
            <a href="ordenes.php">
               <span class="icon"><ion-icon name="cart-outline"></ion-icon></span>
               <span class="text">Ordenes</span>
            </a>
         </li>
         <li class="list <?php echo ($page == 'newPedido') ? 'active' : '';?>">
            <b></b>
            <b></b>
            <a href="nuevoPedido.php">
               <span class="icon"><ion-icon name="add-circle-outline"></ion-icon></span>
               <span class="text">Nuevo Pedido</span>
            </a>
         </li>
         <?php
            if (!empty($_SESSION['rol'])) {
               if ($_SESSION['rol'] == '1' || $_SESSION['rol'] == '2') {?>
                  <li class="list <?php echo ($page == 'administrar') ? 'active' : '';?>">
                     <b></b>
                     <b></b>
                     <a href="administrativo.php">
                        <span class="icon"><ion-icon name="bar-chart-outline"></ion-icon></span>
                        <span class="text">Administrativo</span>
                     </a>
                  </li>
                  <li class="list <?php echo ($page == 'config') ? 'active' : '';?>">
                     <b></b>
                     <b></b>
                     <a href="#settings">
                        <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                        <span class="text">Configuraciones</span>
                     </a>
                  </li>
                  <?php
               }
               echo '
                  <div class="bottom">
                     <li class="list">
                        <b></b>
                        <b></b>
                        <a href="#" onclick="login()">
                           <span class="icon"><ion-icon name="exit-outline"></ion-icon>
                           </span>
                           <span class="text">Logout</span>
                        </a>
                     </li>
                  </div>
               ';

            }else {
               echo '
                  <div class="bottom">
                     <li class="list">
                        <b></b>
                        <b></b>
                        <a href="#" onclick="login()">
                           <span class="icon"><ion-icon name="enter-outline"></ion-icon>
                           </span>
                           <span class="text">Login</span>
                        </a>
                     </li>
                  </div>
               ';
            }
         ?>

         
      </ul>
   </div>
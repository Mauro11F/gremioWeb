<?php
   if (isset($_SESSION['rol']) && ($_SESSION['rol'] === '1' || $_SESSION['rol'] === '2')) {?>
      <section class="footer" style="padding: 0px 10px; margin-top: 0px; min-height: 0; justify-content: normal;">
         <div class="copyrightText" style="border-radius: 5px">
            <p>Copyright © 2021 Franco H Mauro. All Rights Reserved</p>
         </div>
      </section>
      <?php
   } else {?>
      <section class="footer">
         <footer>
            <div class="container">
               <div class="sec aboutus">
                  <h2>Quienes Somos?</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi provident harum quod eveniet, vitae laborum rerum atque quia laudantium repellendus dolore distinctio deserunt veritatis quidem?</p>
                  <ul class="sci">
                     <li><a href="#"><ion-icon name="logo-facebook"></ion-icon></a></li>
                     <li><a href="#"><ion-icon name="logo-instagram"></ion-icon></a></li>
                     <li><a href="#"><ion-icon name="logo-twitter"></ion-icon></a></li>
                     <li><a href="#"><ion-icon name="logo-youtube"></ion-icon></a></li>
                  </ul>
               </div>

               <div class="sec quicklinks">
                  <h2>Algunos Links</h2>
                  <ul>
                     <li><a href="#">About</a></li>
                     <li><a href="#">FAQ</a></li>
                     <li><a href="#">Privacy Policu</a></li>
                     <li><a href="#">Help</a></li>
                     <li><a href="#">Terms & Conditions</a></li>
                     <li><a href="#">Constact</a></li>
                  </ul>
               </div>

               <div class="sec quicklinks">
                  <h2>Articulos</h2>
                  <ul>
                     <li><a href="#">Impre A4</a></li>
                     <li><a href="#">Impre A3+</a></li>
                     <li><a href="#">Gran Formato</a></li>
                     <li><a href="#">Gigantografia</a></li>
                     <li><a href="#">Tarjetas personales</a></li>
                     <li><a href="#">Troquelados</a></li>
                  </ul>
               </div>

               <div class="sec contact">
                  <h2>Contactanos</h2>
                  <ul class="info">
                     <li>
                        <span><ion-icon name="map-outline"></ion-icon></span>
                        <span>647 Calle Por aca<br>
                           Misiones, POS 19460,<br>ARG</span>
                     </li>
                     <li>
                        <span><ion-icon name="call-outline"></ion-icon></span>
                        <p><a href="tel:+12345678900">+1 234 567 8900</a><br>
                           <a href="tel:+12345678900">+1 234 567 8900</a>
                        </p>
                     </li>
                     <li>
                        <span><ion-icon name="mail-outline"></ion-icon></span>
                        <p><a href="mailto:knowmore@gmail.com">gremioWeb@gmail.com</a></p>
                     </li>
                  </ul>
               </div>
            </div>
         </footer>
         <div class="copyrightText">
            <p>Copyright © 2021 Franco H Mauro. All Rights Reserved</p>
         </div>
      </section>
      <?php
   }
?>

<!-- CDN ionicons -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<!-- My script js -->
<script src="js/app.js"></script>
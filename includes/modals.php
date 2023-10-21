   <!-- INICIO Modal para Inicio Sesion -->
   <div class="modal" id="popup">
      <h3>Login with my account</h3>
      <div class="salir">
         <ion-icon onclick="login()" name="close-circle-outline"></ion-icon>
      </div>
      <div class="form">
         <form action="controller/userAccount.php" id="registrar-form" method="POST">
            <div class="form-group">
               <input type="text" id="" class="form-control" placeholder="User..." required name="user">
            </div>
            <div class="form-group">
               <input type="password" id="" class="form-control" placeholder="Password..." required name="pass">
            </div>
            <div class="modal-footer">
               <button type="submit"> Log In </button>
            </div>
         </form>
      </div>
      <div class="modal-links">
         <a href="#" onclick="formCreate()"> Create an account </a>
      </div>
   </div>
   <!-- FIN Modal para Inicio Sesion -->
   <!-- INICIO Modal para registrarce -->
   <div class="modal" id="popup2">
      <h3>Create an account</h3>
      <div class="salir">
         <ion-icon onclick="login()" name="close-circle-outline"></ion-icon>
      </div>
      <div class="form">
         <form action="controller/userAccount.php" id="registrar-form" method="POST">
            <div class="form-group">
               <input type="text" id="" class="form-control" placeholder="First Name" required name="user">
            </div>
            <div class="form-group">
               <input type="text" id="" class="form-control" placeholder="Last Name" required name="lastName">
            </div>
            <div class="form-group">
               <input type="text" id="" class="form-control" placeholder="Email" required name="email">
            </div>
            <div class="form-group">
               <input type="password" id="" class="form-control" placeholder="Number" required name="telefono">
            </div>
            <div class="form-group">
               <input type="password" id="" class="form-control" placeholder="Password" required name="pass">
            </div>
            <div class="modal-footer">
               <button type="submit"> Create </button>
            </div>
         </form>
      </div>
      <div class="modal-links">
         <a href="#" onclick="formLogint()"> I have an account... Logint </a>
      </div>
   </div>
   <!-- FIN Modal para registrarce -->


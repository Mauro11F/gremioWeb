<?php
   include("db/db.php");
   session_start();
   $page = 'profile';

   if (isset($_SESSION['user_id'])) {
      $query = "SELECT * FROM usuario WHERE id_usuario = '$_SESSION[user_id]' ";

      $resultado = mysqli_query($conn, $query);
      $infoUser = mysqli_fetch_assoc($resultado);
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Profile</title>
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

   <?php include("includes/header.php"); ?>

   <!-- Barra deslizante y menu de navegacion -->
   <?php include("includes/sidebar.php"); ?>

   <!-- contenido de la pagina -->

   <?php
      if (!isset($_SESSION['rol'])) {?>
      <section class="profile-pag">

         <h3 class="heading">No tienes Cuenta ?</h3>

         <div class="details" id="">
            <div class="form">
               <form action="controller/userAccount.php" id="registrar-form" method="POST">
                  <h3>Create una Cuenta</h3>
                  <div class="form-group">
                     <input type="text" placeholder="Nombre" required name="user">
                  </div>
                  <div class="form-group">
                     <input type="text" placeholder="Apellido" required name="lastName">
                  </div>
                  <div class="form-group">
                     <input type="text" placeholder="Email" required name="email">
                  </div>
                  <div class="form-group">
                     <input type="number" placeholder="Telefono" required name="telefono">
                  </div>
                  <div class="form-group">
                     <input type="password" placeholder="Contraseña" required name="pass">
                  </div>
                  <div class="form-group">
                     <button type="submit"> Crear </button>
                  </div>
               </form>
            </div>

            <div class="nota">
               <h3>Condiciones para ser Gremio</h3>
               <ul>
                  <li><p>Compras mensuales de por lo menos <span>$5000</span> </p></li>
                  <li><p>Lorem ipsum dolor sit amet consectetur <span>adipisicing</span> elit. Quibusdam, tenetur?</p></li>
                  <li><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio <span>perferendis</span> quaerat deserunt similique maxime <span>corporis</span> unde blanditiis nihil.</p></li>
                  <li><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. <span>Consequatur</span> culpa qui recusandae nemo <span>consectetur alias</span>!</p></li>
                  <li><p>Lorem ipsum, dolor sit amet consectetur <span>adipisicing</span> elit.</p></li>
               </ul>
            </div>
         </div>
      </section>
         <?php
      } else {?>
         <section class="profile-pag">

            <h1 class="heading">Datos Personales</h1>

            <div class="details">
               <div class="user">
                  <img src="img/admin.png" alt="">
                  <div style="text-transform: capitalize" class="description">
                     <h3><?php echo $_SESSION['user_name'] ?></h3>
                     <?php
                        switch ($_SESSION['rol']) {
                           case '1':
                              echo "<span>admin</span>";
                              break;
                           
                           case '2':
                              echo "<span>vendedor</span>";
                              break;
                           
                           case '3':
                              echo "<span>gremio</span>";
                              break;
                           default:
                              echo "<span>publico</span>";
                              break;
                        }
                     ?>
                  </div>
               </div>
               <div class="formulario-profile">
                  <form action="controller/userController.php" method="POST">
                     <div class="row">
                        <input type="text" name="nombre" value="<?php echo $infoUser['nombre'] ?>" placeholder="First Name">
                        <input type="text" name="apellido" value="<?php echo $infoUser['apellido'] ?>" placeholder="Last Name">
                        <input type="email" name="email" value="<?php echo $infoUser['email'] ?>" placeholder="email">
                     </div>
                     
                     <div class="row">
                        <input type="number" name="tel" value="<?php echo $infoUser['telefono'] ?>" placeholder="Tel. Number">
                        <input type="password" name="pass" placeholder="Password" required>
                        <!-- <input type="newPass" name="newPass" placeholder="New Password"> -->
                     </div>
                     <div class="row">
                        <input class="btn" type="submit" name="updateUser" value="Confirmar">
                     </div>
                  </form>
               </div>
            </div>
         </section>
   <?php
      }
   ?>

   <?php
      if (isset($_SESSION['rol']) && intval($_SESSION['rol']) <= 2) {?>
         
         <section class="profile-users">

            <h1 class="heading">Usuarios en el sistema</h1>

            <div class="users-container">
               <div class="filtros">
                  <div class="search">
                     <input type="search" name="data" id="buscar">
                     <ion-icon name="search-outline"></ion-icon>
                  </div>
                  <button id="vendedores"><ion-icon name="ellipse"></ion-icon> Vendedores </button>
                  <button id="sector"><ion-icon name="ellipse"></ion-icon> Sector </button>
               </div>

               <div class="table-container">
                  <table>
                     <thead>
                        <tr>
                           <th> Nombre </th>
                           <th> Tipo </th>
                           <th> Sector </th>
                           <th> Telefono </th>
                           <th> Fecha</th>
                           <th> Correo </th>
                           <th> Ver movimiento </th>
                           <th> Opciones </th>
                        </tr>
                     </thead>
                     <tbody id="tablaAll">
                     <?php
                           // Todo esto poner dentro de ajax para poder mostrar la "busqueda" o "todo los datos"
                        $query = "SELECT * FROM usuario INNER JOIN tipo_usuario ON usuario.fk_tipo_usuario = tipo_usuario.id_tipo_usuario INNER JOIN sector ON usuario.fk_sector = sector.id_sector";
                        $info = mysqli_query($conn, $query)or die("Problemas en traer usuario pagina profile". mysqli_error($conn));

                        while ($user= mysqli_fetch_array($info)) {?>
                           <tr>
                              <form action="controller/userController.php" method="post">
                                 <input type="hidden" name="id" value="<?php echo $user['id_usuario']; ?>">
                                 <td><?php echo $user['nombre']." ".$user['apellido'] ?></td>
                                 <td class="tipo_user cliGremio">
                                    <select name="tipoUser" id="tipoUser">
                                       <option value="3"<?php echo ($user['fk_tipo_usuario'] === '3' ? 'selected' : '');?>>Cliente Gremio</option>
                                       <option value="2"<?php echo ($user['fk_tipo_usuario'] === '2' ? 'selected' : '');?>>Vendedor</option>
                                    </select>
                                 </td>
                                 <td class="sector publico">
                                    <select name="sector" id="sectorUser">
                                       <option value="1"<?php echo ($user['fk_sector'] === '1' ? 'selected' : '');?>>Centro</option>
                                       <option value="2"<?php echo ($user['fk_sector'] === '2' ? 'selected' : '');?>>Deposito</option>
                                       <option value="3"<?php echo ($user['fk_sector'] === '3' ? 'selected' : '');?>>Publico</option>
                                    </select>
                                 </td>
                                 <td><?php echo $user['telefono'] ?></td>
                                 <td><?php echo date("d-m-Y", strtotime($user['fecha_inscripcion'])); ?></td>
                                 <td><?php echo $user['email'] ?></td>
                                 <td><a href="movimientoUser.php?id=<?php echo $user['id_usuario'];?>">ver movimiento</a></td>
                                 <td class="botones">
                                    <div class="update" method="post" action="">
                                       <button type="submit" name="updateTipo" style="font-size: 14px; padding: 6px 10px;">
                                          Modificar
                                       </button>
                                    </div>
                                    <div class="delete" method="post" action="">
                                       <button type="submit" name="deleteUser">
                                          <ion-icon name="trash-outline"></ion-icon>
                                       </button>
                                    </div>
                                 </td>
                              </form>
                           </tr>
                        <?php
                        }
                        ?>
                     </tbody>
                     <!-- aca poner lo saco con ajax  -->
                     <tbody id="mostrarBusqueda">

                     </tbody>
                  </table>
               </div>
            </div>
         </section>
         <?php
      }
   ?>

   <?php include("includes/modals.php"); ?>

   <?php include("includes/notifications.php"); ?>

   <?php include("includes/footer.php"); ?>

   <script>
      document.addEventListener('DOMContentLoaded', function() {

         aplicarEstilosTabla();
         
         var acaBusqueda = document.getElementById('mostrarBusqueda');
         var buscar = document.getElementById('buscar');
         buscar.addEventListener('input', () => {
            // console.log(buscar.value);
            var buscaEsto = buscar.value;
            if (buscaEsto.trim() != '') {
               
               const datos = new FormData();
               datos.append('buscaEsto', buscaEsto);
               datos.append('clave', 'ajax');

               fetch('controller/userController.php', {
                  method: 'POST',
                  body: datos
               })
               .then(response => response.json())
               .then(data => {

                  // borra el contenido anterior
                  // acaBusqueda.innerHTML = '';

                  /*tendria que crear
                  a)_ tr
                  b)_ form
                  c)_ 1) input:hidden- 8) td
                  d)_ 2) select "en td corresponidentes, con sus option"
                  e)_ 2) div "con sus botones" 2) button:submit */

                  let elementos = ``;
                  data.forEach(contenido => {

                     // const trElement = document.createElement('tr');

                     // const formElement = document.createElement('form');
                     // formElement.action = 'controller/index.php';
                     // formElement.method = 'post';

                     // const inputElement = document.createElement('input');
                     // inputElement.type = 'hidden';
                     // inputElement.name = 'id';
                     // inputElement.value = contenido.id;

                     // const tdNombre = document.createElement('td');
                     // tdNombre.textContent = contenido.nombre;

                     // const tdTipoUser = document.createElement('td');
                     // tdTipoUser.classList.add('tipo_user cliGremio');

                     // const selectTipoUser = document.createElement('select');
                     // selectTipoUser.name = 'tipoUser';
                     // selectTipoUser.id = 'tipoUser';

                     // const optionTipoUser1 = document.createElement('option');
                     // optionTipoUser.value = '3';
                     // optionTipoUser.textContent = 'Cliente Gremio';
                     // if (contenido.tipoUsuario === '3') {
                     //    optionTipoUser.selected = true
                     // }

                     // const optionTipoUser2 = document.createElement('option');
                     // optionTipoUser2.value = '2';
                     // optionTipoUser2.textContent = 'Vendedor';
                     // if (contenido.tipoUsuario === '2') {
                     //    optionTipoUser2.selected = true
                     // }

                     // const tdSector = document.createElement('td');
                     // tdSector.name = 'sector publico';
                     // tdSector.id = 'sectorUser';

                     // const selectSector = document.createElement('select');
                     // selectSector.name = 'sector';
                     // selectSector.id = 'sectorUser';

                     // const optionSector1 = document.createElement('option');
                     // optionSector1.value = '1';
                     // optionSector1.textContent = 'Centro';
                     // if (contenido.sector === '1') {
                     //    optionSector1.selected = true;
                     // }

                     // const optionSector2 = document.createElement('option');
                     // optionSector2.value = '2';
                     // optionSector2.textContent = 'Deposito';
                     // if (contenido.sector === '2') {
                     //    optionSector2.selected = true;
                     // }

                     // const optionSector3 = document.createElement('option');
                     // optionSector3.value = '3';
                     // optionSector3.textContent = 'Publico';
                     // if (contenido.sector === '3') {
                     //    optionSector3.selected = true;
                     // }

                     // const tdTelefono = document.createElement('td');
                     // tdTelefono.textContent = contenido.telefono;

                     // const tdFecha = document.createElement('td');
                     // tdFecha.textContent = contenido.fecha;
                     
                     // const tdCorreo = document.createElement('td');
                     // tdCorreo.textContent = contenido.correo;

                     // const tdEnlace = document.createElement('td');
                     // const aElement = document.createElement('a');
                     // aElement.textContent = 'ver movimientos';

                     // const tdBoton = document.createElement('td');
                     // tdBoton.classList.add('botones');








                     elementos += `
                     <tr>
                        <form action="controller/userController.php" method="post">
                           <input type="hidden" name="id" value="${contenido.id}">
                           <td>${contenido.nombre}</td>
                           <td class="tipo_user cliGremio">
                              <select name="tipoUser" id="tipoUser">
                                 <option value="3" ${contenido.tipoUsuario === '3' ? 'selected' : ''} >Cliente Gremio</option>
                                 <option value="2" ${contenido.tipoUsuario === '2' ? 'selected' : ''} >Vendedor</option>
                              </select>
                           </td>
                           <td class="sector publico">
                              <select name="sector" id="sectorUser">
                                 <option value="1" ${contenido.sector === '1' ? 'selected' : ''} >Centro</option>
                                 <option value="2" ${contenido.sector === '2' ? 'selected' : ''} >Deposito</option>
                                 <option value="3" ${contenido.sector === '3' ? 'selected' : ''} >Publico</option>
                              </select>
                           </td>
                           <td> ${contenido.telefono} </td>
                           <td> ${contenido.fecha} </td>
                           <td> ${contenido.correo} </td>
                           <td><a href="">ver movimiento</a></td>
                           <td class="botones">
                              <div class="update">
                                 <button type="submit" name="updateTipo" style="font-size: 14px; padding: 6px 10px;">
                                    Modificar
                                 </button>
                              </div>
                              <div class="delete">
                                 <button type="submit" name="deleteUser">
                                    <ion-icon name="trash-outline"></ion-icon>
                                 </button>
                              </div>
                           </td>
                        </form>
                     </tr>`;
                  });
                  // esconder tablaAll
                  var tablaAll = document.getElementById('tablaAll');
                  tablaAll.classList.add('esconder');

                  acaBusqueda.classList.remove('esconder');
                  acaBusqueda.classList.add('mostrar');

                  acaBusqueda.innerHTML = elementos;

                  // una ves puesto los elementos ejecutamos los estilos
                  aplicarEstilosTabla();
               });

            }else {

               var tablaAll = document.getElementById('tablaAll');
               tablaAll.classList.remove('esconder');

               // acaBusqueda.innerHTML = ''; //lo llenamos con datos vacios para evitar algun problemas
               acaBusqueda.classList.remove('mostrar');
               acaBusqueda.classList.add('esconder');

            }

         });

         function mandarFormulario() {
            


         }

         function aplicarEstilosTabla() {
            // INICIO colores a los selects
            var tipoUser = document.querySelectorAll('td.tipo_user');
            tipoUser.forEach( (dataSelect) => {
               valorSelect = dataSelect.querySelector('select');
               // console.log(valorSelect.value);
               switch (valorSelect.value) {
                  case '3':
                     // console.log("Cliente");
                     break;
                  case '2':
                     // console.log("Vendedor");
                     dataSelect.classList.remove('cliGremio');
                     dataSelect.classList.add('vendedor');
                     break;
                  default:
                     break;
               }
            });

            var tipoSector = document.querySelectorAll('td.sector');
            tipoSector.forEach((dataSector) => {
               var valorSector = dataSector.querySelector('select');
               switch (valorSector.value) {
                  case '1':
                     dataSector.classList.remove('publico');
                     dataSector.classList.add('centro');
                     break;
                  case '2':
                     dataSector.classList.remove('publico');
                     dataSector.classList.add('deposito');
                     break;
                  default:
                     // publico
                     break;
               }
            });
            // FIN colores a los selects 

         }
      });
   </script>

</body>

</html>
<?php

   $conn = mysqli_connect(
      'localhost',
      'id20602451_mauro',
      '1B@seDeDatos',
      'id20602451_sistgremio'
   );

   $query = "SELECT * FROM personas";

   $result = mysqli_query($conn,$query);

   $data = array();
   while ($fila = mysqli_fetch_assoc($result)) {
      array_push($data, $fila);
   }

   // $data = mysqli_fetch_assoc($result);
   $jsonstring = json_encode($data);

   echo $jsonstring;

?>
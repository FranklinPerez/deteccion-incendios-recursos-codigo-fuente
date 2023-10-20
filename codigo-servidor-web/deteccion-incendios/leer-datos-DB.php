<?php

include('database.php');

$sql = "SELECT * FROM gas_fuego_detectado ORDER BY id_alarma DESC LIMIT 1; ";
$result = $conn->query($sql);

  while($row = mysqli_fetch_array($result)) {
    $descripcion_alarma = $row['descripcion_alarma'];
    $tipo_alarma = $row['tipo_alarma'];
    $fecha_alarma = $row['fecha_alarma'];
    $hora_alarma = $row['hora_alarma'];

    $json[] = array(
        'descripcion_alarma'=> $descripcion_alarma,
        'tipo_alarma'=> $tipo_alarma,
        'fecha_alarma'=> $fecha_alarma,
        'hora_alarma'=> $hora_alarma
        );
  }
  if(!empty($json)) {
    $jsonstring = json_encode($json);
    echo $jsonstring;
    }else{
      $jsonstring = json_encode(null);
      echo $jsonstring;
    }

$conn->close();

?>
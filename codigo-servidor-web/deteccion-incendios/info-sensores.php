<?php

include('enviarAlarma.php');
include('database.php');

date_default_timezone_set('America/El_Salvador');
$date = date('Y-m-d');
$hour = date( "H:i:s" );
$descripcion_alarma = "";
$tipo_alarma = "";
$alarma = "";


//funcion para guardar en base de datos la alarma con fecha y hora
function guardarAlarma($descripcion_alarma, $tipo_alarma, $fecha_alarma, $hora_alarma, $conn){
    $sql = "INSERT INTO gas_fuego_detectado (descripcion_alarma, tipo_alarma, fecha_alarma, hora_alarma)
            VALUES ('$descripcion_alarma','$tipo_alarma','$fecha_alarma','$hora_alarma')";
    if ($conn->query($sql) === TRUE) {
        echo "alarma guardada\n";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
}

if (isset($_POST["alarma_gas"])) {
    $correo = $_POST["correo"];
    $alarma = $_POST["alarma_gas"];
    enviarAlarma('#FF8C00', $correo, 'Fuga de Gas Detectada', 'Se ha detectado una fuga de gas', $date, $hour, $conn);
    guardarAlarma($alarma, "gas", $date, $hour, $conn);
}

if (isset($_POST["alarma_fuego"])) {
    $correo = $_POST["correo"];
    $alarma = $_POST["alarma_fuego"];
    enviarAlarma('#DC143C', $correo, 'Fuego Detectado', 'Se ha detectado Fuego', $date, $hour, $conn);
    guardarAlarma($alarma, "fuego", $date, $hour, $conn);
}

?>
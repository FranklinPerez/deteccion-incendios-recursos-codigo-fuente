<?php

$conn = new mysqli("localhost", "arc115@2023incendios", "arc115@2023incendios", "arc_deteccion_incendios");
if ($conn->connect_errno) {
    return die("Connection failed: " . $conn->connect_error);
}
// for testing connection
if(!$conn) {
  echo 'database is not connected';
}

?>
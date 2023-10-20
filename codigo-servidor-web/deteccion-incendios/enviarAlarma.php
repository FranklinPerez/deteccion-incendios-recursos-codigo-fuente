<?php

include('database.php');

function enviarAlarma($color, $correo, $tipoAlarma, $mensajeAlarma, $fecha, $hora, $conn){

    $sql = "SELECT * FROM correo_notificar WHERE correo_notificar = '$correo' LIMIT 1; ";
    $result = $conn->query($sql);

    if(mysqli_num_rows( $result )==0){
        echo "correo no existe";
    } else{
        echo "correo existe";
        while($row = mysqli_fetch_array($result)) {
            $estado_verificacion = $row['estado_verificacion'];
          }
          if ($estado_verificacion=="verificado") {
            $to = $correo;
            // Armar correo a enviar con la alarma
            $subject = "Alarma: ".$tipoAlarma."";

            $message = '
            <html>
            <head>
            <title>Detección Incendios - '.$tipoAlarma.'</title>
            </head>
            <body >
            <table width="100%" height="100%" style="min-width:348px" border="0" cellspacing="0" cellpadding="0" lang="es" >
            <tbody>
            <tr height="32" style="height:32px">
            <td>
            </td>
            </tr>
            <tr align="center">
            <td>
            <div>
            <div>
            </div>
            </div>
            <table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:20px;max-width:516px;min-width:220px">
            <tbody>
            <tr >
            <td width="8" style="width:8px">
            </td>
            <td style="color: white !important; background-color:' .$color. ' !important; border-radius:8px;">
            <div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:40px 20px" align="center"  width="74" height="24" aria-hidden="true" style="margin-bottom:16px">
            <div style="font-family:"Google Sans",Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom:thin solid #dadce0;line-height:32px;padding-bottom:24px;text-align:center;word-break:break-word">
            <div style="font-size:32px; font-weight: bold;">Alarma de '.$tipoAlarma.'</div>
            </div>
            <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:20px;line-height:20px;padding-top:20px;text-align:center; font-weight: bold;">
            '.$mensajeAlarma.'</div><br>
            <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:20px;line-height:20px;padding-top:20px;text-align:center; font-weight: bold;">
            Fecha (Año-mes-día):<br><br>'.$fecha.'</div><br>
            <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:20px;line-height:20px;padding-top:20px;text-align:center; font-weight: bold;">
            Hora (24 horas):<br><br>'.$hora.'</div>

            <div style="text-align:left">
            <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:11px;line-height:18px;padding-top:12px;text-align:center">

            </div></div></td></tr></tbody></table></td></tr></tbody></table>

            </body>
            </html>
            ';

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8\r\n";

            // More headers
            $headers .= "From: Servicio Detección Incendios <servicio.deteccion.incendios@gmail.com>\r\n";
            //$headers .= 'Cc: myboss@example.com' . "\r\n";
            $headers .= "Return-path: $to\r\n";


            if(mail($to,$subject,$message,$headers)){
                //echo "<script>alert('correo enviado')</script>";
                echo "enviado";
            }else {
                //echo "<script>alert('falló')</script>";
                echo "falló";
            }
          }else {}
    }


}

?>
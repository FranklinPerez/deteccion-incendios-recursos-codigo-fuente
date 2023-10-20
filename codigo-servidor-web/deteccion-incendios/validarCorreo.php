<?php

include('database.php');

if(isset($_POST['validarCodigo'])){
    validarCodigo($_POST["correo_validar"], $_POST["codigo_validar"], $conn);
}

if(isset($_POST['enviarCodigo'])){
    $codigo = rand(100000,999999);
    guardarCorreoCodigo($_POST["correoValidar"], $codigo, $conn);
}

function validarCodigo($correo, $codigo, $conn){
    $sql = "SELECT * FROM correo_notificar WHERE correo_notificar = '$correo' LIMIT 1; ";
    $result = $conn->query($sql);
    if(mysqli_num_rows( $result )==0){
        echo "correo no existe";
    } else {
        while($row = mysqli_fetch_array($result)) {
            $estado_verificacion = $row['estado_verificacion'];
            $correo_notificar = $row['correo_notificar'];
            $codigo_verificacion = (string) $row['codigo_verificacion'];
          }
        if ($estado_verificacion=="verificado") {
            echo "correo verificado";
        }else{
            if ($correo_notificar==$correo && $codigo_verificacion==$codigo) {

                $sql = "UPDATE correo_notificar SET estado_verificacion = 'verificado' WHERE correo_notificar = '$correo'";
                if ($conn->query($sql) === TRUE) {
                    corroCorreoConfirmado($correo);
                    echo "correo validado";

                } else {
                    echo "Error: " . $sql . "</br>" . $conn->error;
                }
            }else{
                echo "codigo incorrecto";
            }
        }
    }

}

function guardarCorreoCodigo($correo, $codigo, $conn){
    $correo = $correo;
    // validar si el correo ya existe en la base
    $sql = "SELECT * FROM correo_notificar WHERE correo_notificar = '$correo'";
    $result = $conn->query($sql);
    if(mysqli_num_rows( $result )!=0){
        $estado_verificacion = "";
        while($row = mysqli_fetch_array($result)) {
            $estado_verificacion = $row['estado_verificacion'];
          }
        if ($estado_verificacion=="verificado") {
            echo "correo existe y verificado";
        }
        if ($estado_verificacion=="sin verificar") {
            echo "correo existe y sin verificar";
        }
    }else {
        $sql = "INSERT INTO correo_notificar (correo_notificar, codigo_verificacion, estado_verificacion)
        VALUES ('$correo',$codigo,'sin verificar')";

        if ($conn->query($sql) === TRUE) {
            enviarCorreo($correo, $codigo);
            echo "correo guardado";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }


}

function corroCorreoConfirmado($correo){
    $to = $correo;
    // Armar correo a enviar con el codigo de verificacion
    $subject = "Deteccion Incendios: correo confirmado";

    $message = '
    <html>
    <head>
    <title>Correo Confirmado</title>
    </head>
    <body>
    <table width="100%" height="100%" style="min-width:348px" border="0" cellspacing="0" cellpadding="0" lang="es">
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
    <tr>
    <td width="8" style="width:8px">
    </td>
    <td>
    <div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:40px 20px" align="center"  width="74" height="24" aria-hidden="true" style="margin-bottom:16px">
    <div style="font-family:"Google Sans",Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom:thin solid #dadce0;color:rgba(0,0,0,0.87);line-height:32px;padding-bottom:24px;text-align:center;word-break:break-word">
    <div style="font-size:24px">Se ha validado esta dirección de correo electrónico</div>
    </div>
    <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:left">
    Se ha verificado el correo: <a style="font-weight:bold">'.$to.'</a> como dirección de correo electrónico para enviar alarmas de fuga de gas e incendios en dado caso se detecten.<br>
    <br>Esta cuenta de correo ha sido verificada<br>


    </div>
    <div style="text-align:left">
    <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">

    </div></div></td><td width="8" style="width:8px"></td></tr></tbody></table></td></tr><tr height="32" style="height:32px"><td></td></tr></tbody></table>

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
        //echo "enviado";
    }else {
        //echo "<script>alert('falló')</script>";
        echo "falló";
    }
}

function enviarCorreo($correo, $codigo){
    $to = $correo;
    // Armar correo a enviar con el codigo de verificacion
    $subject = "Deteccion Incendios: código de verificacion";

    $message = '
    <html>
    <head>
    <title>Servicio Detección Incendios</title>
    </head>
    <body>
    <table width="100%" height="100%" style="min-width:348px" border="0" cellspacing="0" cellpadding="0" lang="es">
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
    <tr>
    <td width="8" style="width:8px">
    </td>
    <td>
    <div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:40px 20px" align="center"  width="74" height="24" aria-hidden="true" style="margin-bottom:16px">
    <div style="font-family:"Google Sans",Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom:thin solid #dadce0;color:rgba(0,0,0,0.87);line-height:32px;padding-bottom:24px;text-align:center;word-break:break-word">
    <div style="font-size:24px">Verifica tu dirección de correo electrónico</div>
    </div>
    <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:left">Se ha recibido una solicitud para usar <a style="font-weight:bold">'.$to.'</a> como dirección de correo electrónico para enviar alarmas de fuga de gas e incendios en dado caso se detecten.<br>
    <br>Utiliza este código para verificar esta dirección de correo electrónico:<br>
    <div style="text-align:center;font-size:36px;margin-top:20px;line-height:44px">'.$codigo.'</div>

    </div>
    <div style="text-align:left">
    <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">

    </div></div></td><td width="8" style="width:8px"></td></tr></tbody></table></td></tr><tr height="32" style="height:32px"><td></td></tr></tbody></table>

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
        //echo "enviado";
    }else {
        //echo "<script>alert('falló')</script>";
        echo "falló";
    }
}
$conn->close();

?>
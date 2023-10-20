<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Validar Correo - Detección de Incendios</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    </head>
    <body>
        <div class="mt-5">
            <h2 class="text-center">Servicio de validación de correo electrónico</h2>
        </div>
        <div class="col-md-4 text-center mx-auto mt-5">

            <form id="formCorreoValidar">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Ingrese el correo Electrónico a validar</label>
                    <input type="email" class="form-control text-center" id="correoEnviarCodigo" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Nunca compartiremos tu correo con nadie más.</div>
                </div>

                <button id="sendCodigoCorreo" type="submit" class="btn btn-primary">Enviar código</button>
                <button id="tengoCodigoCorreo" type="submit" class="btn btn-success">Ya tengo un código</button>
            </form>
        </div>

        <!-- Modals -->

        <!-- Modal el correo no debe estar vacío -->
        <div class="modal" tabindex="-1" id="modalDigiteCorreo">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Digite un correo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>El correo no debe estar vacío</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal validar el correo -->
        <div class="modal" tabindex="-1" id="modalValidarCorreo">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Digite el código de verificación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formModalCorreoValidar" class="text-center">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Correo Electrónico a validar</label>
                            <input type="email" class="form-control text-center" id="correoValidar" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Digite el código de verificación</label>
                            <input type="email" class="form-control text-center" id="codigoVerificacion" aria-describedby="emailHelp">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <button id="validarCorreoCodigo" type="submit" class="btn btn-primary">Validar Correo</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal digitar correo y/o codigo para verificar -->
        <div class="modal" tabindex="-1" id="modalDigiteCorreoCodigo">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Digite los campos</h5>
                    </div>
                    <div class="modal-body">
                        <p>Digite los campos correo y código de verificación</p>
                    </div>
                </div>
            </div>
        </div>

         <!-- Modal si ya existe el correo en la base y está verificado -->
         <div class="modal" tabindex="-1" id="modalCorreoExisteValidado">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Correo Registrado</h5>
                    </div>
                    <div class="modal-body">
                        <p>El correo digitado ya está registrado y verificado</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>

         <!-- Modal si ya existe el correo en la base y NO está verificado -->
         <div class="modal" tabindex="-1" id="modalCorreoExisteSinVerificar">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Correo Registrado sin verificar</h5>
                    </div>
                    <div class="modal-body">
                        <p>El correo digitado ya está registrado pero no está validado</p>
                    </div>
                    <div class="modal-footer">
                <button id="mostrarModalValidarCorreoCodigo" type="submit" class="btn btn-primary">Validar Correo</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal correo verificado con exito -->
        <div class="modal" tabindex="-1" id="modalCorreoValidadoExitosamente">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Correo Validado Exitosamente</h5>
                    </div>
                    <div class="modal-body">
                        <p>El correo ha sido validado correctamente</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Aceptar</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal correo verificado con exito -->
        <div class="modal" tabindex="-1" id="modalCorreoNoExiste">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Correo No registrado</h5>
                    </div>
                    <div class="modal-body">
                        <p>El correo digitado no está registrado</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal codigo incorrecto -->
        <div class="modal" tabindex="-1" id="modalCodigoIncorrecto">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Código Incorrecto</h5>
                    </div>
                    <div class="modal-body">
                        <p>El código digitado es incorrecto</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal codigo incorrecto -->
        <div class="modal" tabindex="-1" id="modalCorreoYaVerificado">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Correo verficado</h5>
                    </div>
                    <div class="modal-body">
                        <p>El correo ya ha sido verificado<br>No es necesario validar de nuevo</p>
                    </div>
                </div>
            </div>
        </div>

        <script src="./js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

        <!--Add jQuery-->
        <script src="./js/jquery-3.7.1.min.js" crossorigin="anonymous"></script>

        <!--Use jQuery-->
        <script>
            let correoValidar = "";
            $(document).ready(function() {

                //hacer que el modal no se pueda cerrar ni con click afuera ni con teclado
                $('#modalDigiteCorreo').modal({backdrop: 'static', keyboard: false});
                $('#modalValidarCorreo').modal({backdrop: 'static', keyboard: false});
                $('#modalCorreoNoExiste').modal({backdrop: 'static', keyboard: false});
                $('#modalCodigoIncorrecto').modal({backdrop: 'static', keyboard: false});
                $('#modalDigiteCorreoCodigo').modal({backdrop: 'static', keyboard: false});
                $('#modalCorreoYaVerificado').modal({backdrop: 'static', keyboard: false});
                $('#modalCorreoExisteValidado').modal({backdrop: 'static', keyboard: false});
                $('#modalCorreoExisteSinVerificar').modal({backdrop: 'static', keyboard: false});
                $('#modalCorreoValidadoExitosamente').modal({backdrop: 'static', keyboard: false});


                // al presionar el boton para enviar codigo
                $(document).on('click', '#sendCodigoCorreo', (e) => {
                e.preventDefault();
                correoValidar = document.getElementById("correoEnviarCodigo").value;
                //console.log(correoValidar);
                if (correoValidar!="") {
                    $.ajax({
                        url:'./validarCorreo.php',
                        data : {correoValidar, enviarCodigo:"enviarCodigo"},
                        type: 'POST',
                        success: function (response) {
                            console.log(response);
                            if (response=="correo existe y verificado") {
                                $('#modalCorreoExisteValidado').modal('show');
                            } else {
                                if (response=="correo existe y sin verificar") {
                                    $('#modalCorreoExisteSinVerificar').modal('show');
                                } else {
                                    if (response=="correo guardado") {
                                        document.getElementById("correoValidar").value = correoValidar;
                                        $('#modalValidarCorreo').modal('show');
                                    }
                                }
                            }
                        },
                        error: function(response){
                            alert("fallo");
                        }
                    })//end ajax
                } else {
                    $('#modalDigiteCorreo').modal('show');
                }
                })

                // si ya tiene codigo de verificacion
                $(document).on('click', '#tengoCodigoCorreo', (e) => {
                    e.preventDefault();
                    $('#modalValidarCorreo').modal('show');
                })

                //cerrar modal que dice que correo existe sin verificar
                $(document).on('click', '#mostrarModalValidarCorreoCodigo', (e) => {
                    e.preventDefault();
                    setTimeout(function(){ $('#modalCorreoExisteSinVerificar').modal('toggle')}, 10);
                    document.getElementById("correoValidar").value = correoValidar;
                    $('#modalValidarCorreo').modal('show');
                })

                // boton validar codigo y correo
                $(document).on('click', '#validarCorreoCodigo', (e) => {
                    e.preventDefault();
                    correo_validar = document.getElementById("correoValidar").value;
                    codigo_validar = document.getElementById("codigoVerificacion").value;
                    if(correo_validar==""||codigo_validar==""){
                        setTimeout(function(){ $('#modalValidarCorreo').modal('toggle')}, 10);
                        setTimeout(function(){ $('#modalDigiteCorreoCodigo').modal('show')}, 15);
                        setTimeout(function(){ $('#modalDigiteCorreoCodigo').modal('toggle')}, 4000);
                        setTimeout(function(){ $('#modalValidarCorreo').modal('toggle')}, 4010);
                    }else{
                        $.ajax({
                            url:'./validarCorreo.php',
                            data : {validarCodigo: "validar correo y codigo", correo_validar, codigo_validar},
                            type: 'POST',
                            success: function (response) {
                            console.log(response);
                            if (response == "correo validado") {
                                setTimeout(function(){ $('#modalValidarCorreo').modal('toggle')}, 10);
                                $('#modalCorreoValidadoExitosamente').modal('show')
                                document.getElementById("formCorreoValidar").reset;
                            }
                            if (response == "correo no existe") {
                                setTimeout(function(){ $('#modalValidarCorreo').modal('toggle')}, 10);
                                setTimeout(function(){ $('#modalCorreoNoExiste').modal('show')}, 15);
                                setTimeout(function(){ $('#modalCorreoNoExiste').modal('toggle')}, 4000);
                                setTimeout(function(){ $('#modalValidarCorreo').modal('show')}, 4010);
                            }
                            if (response == "codigo incorrecto") {
                                setTimeout(function(){ $('#modalValidarCorreo').modal('toggle')}, 10);
                                setTimeout(function(){ $('#modalCodigoIncorrecto').modal('show')}, 15);
                                setTimeout(function(){ $('#modalCodigoIncorrecto').modal('toggle')}, 4000);
                                setTimeout(function(){ $('#modalValidarCorreo').modal('show')}, 4010);
                            }
                            if (response == "correo verificado") {
                                setTimeout(function(){ $('#modalValidarCorreo').modal('toggle')}, 10);
                                setTimeout(function(){ $('#modalCorreoYaVerificado').modal('show')}, 15);
                                setTimeout(function(){ $('#modalCorreoYaVerificado').modal('toggle')}, 4000);
                                setTimeout(function(){ $('#modalValidarCorreo').modal('show')}, 4010);
                            }
                            },error: function(response){}
                        })//fin ajax
                    }
                })

            })//fin docment ready

    </script>
    </body>
</html>
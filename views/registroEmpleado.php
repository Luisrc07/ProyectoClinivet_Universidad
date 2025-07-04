<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/registroEmpleado.css">
    <title>Registro De Empleados</title>
    <style>
        .error-message, .success-message {
            top: 0;
            left: 0;
            width: 100%;
            padding: 10px;
            text-align: center;
            border-radius: 0;
            font-weight: bold;
            z-index: 1000;
            display: none;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .success-message {
            background-color: #DFF2BF; /* Verde claro para éxito */
            color: #4F8A10; /* Verde oscuro para éxito */
            border: 1px solid #4F8A10;
        }
        .error-message {
            background-color: #FFBABA; /* Rojo claro para error */
            color: #D8000C; /* Rojo oscuro para error */
            border: 1px solid #D8000C;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="error-message" class="error-message"></div>
    <div id="success-message" class="success-message"></div>

    <div class="container_padre">
        <div class="Cont_Informacion">
            <img src="Resources/images/doctor.jpg" alt="hombre">
        </div>

        <form id="registro-form">
        <section class="form_registro">
    <div class="form_header">
        <img src="Resources/images/pata.png" alt="pata" class="pata">
        <h2>Registro de Empleados</h2>
    </div>

    <input type="hidden" name="idEmpleado" value="<?php echo isset($empleado->Id_Empleado) ? $empleado->Id_Empleado : ''; ?>">

    <label for="cedula">Cédula del Empleado</label>
    <input class="controls" type="text" name="Cedula" id="cedula" placeholder="Cédula del Empleado" required value="<?php echo isset($empleado->Cedula) ? $empleado->Cedula : ''; ?>">

    <label for="nombres">Nombre del Empleado</label>
    <input class="controls" type="text" name="Nombre" id="nombres" placeholder="Nombre del Empleado" required value="<?php echo isset($empleado->Nombres) ? $empleado->Nombres : ''; ?>">

    <label for="apellido">Apellido del Empleado</label>
    <input class="controls" type="text" name="Apellido" id="apellido" placeholder="Apellido del Empleado" required value="<?php echo isset($empleado->Apellidos) ? $empleado->Apellidos : ''; ?>">

    <label for="correo">Correo</label>
    <input class="controls" type="email" name="Correo" id="correo" placeholder="Correo" value="<?php echo isset($empleado->Correo) ? $empleado->Correo : ''; ?>">

    <label for="fec_nacimiento">Fecha de Nacimiento</label>
    <input class="controls" type="date" name="Fec_nacimiento" id="fec_nacimiento" value="<?php echo isset($empleado->Fecha_Nacimiento) ? date('Y-m-d', strtotime($empleado->Fecha_Nacimiento)) : ''; ?>">

    <label for="direccion">Dirección</label>
    <textarea class="direccion" name="direccion" id="direccion" placeholder="Ingrese dirección"><?php echo isset($empleado->Direccion) ? $empleado->Direccion : ''; ?></textarea>

    <label for="especializacion">Especialización</label>
    <input class="controls" type="text" name="Especializacion" id="especializacion" placeholder="Especialización" value="<?php echo isset($empleado->Especializacion) ? $empleado->Especializacion : ''; ?>">

    <label for="desempeño">Desempeño</label>
    <input class="controls" type="number" step="0.1" name="Desempeño" id="desempeño" placeholder="Desempeño" value="<?php echo isset($empleado->Desempeño) ? $empleado->Desempeño : ''; ?>">

    <input class="butom" type="submit" value="Registrar">
</section>
        </form>
    </div>

    <script>
    $(document).ready(function() {
        $("#registro-form").submit(function(event) {
            event.preventDefault();

            const cedula = $("#cedula").val();
            const correo = $("#correo").val();
            const fecNacimiento = new Date($("#fec_nacimiento").val());
            const hoy = new Date();
            let edad = hoy.getFullYear() - fecNacimiento.getFullYear();
            const mes = hoy.getMonth() - fecNacimiento.getMonth();
            if (mes < 0 || (mes === 0 && hoy.getDate() < fecNacimiento.getDate())) {
                edad--;
            }

            if (edad < 21) {
                mostrarMensaje("Error: El empleado debe tener al menos 21 años.", true);
                console.log("Edad insuficiente: ", edad);
                return;
            }

            const idEmpleado = $("input[name='idEmpleado']").val();
            if (idEmpleado) {
                // Es una actualización, no verificar cédula y correo si no han cambiado
                $.ajax({
                    type: "POST",
                    url: "index.php?controller=controlEmpleado&method=guardar",
                    data: $("#registro-form").serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.error) {
                            mostrarMensaje(response.error, true);
                            console.log("Error de registro:", response.error);
                        } else {
                            mostrarMensaje(response.success);
                            console.log("Registro exitoso:", response.success);
                            // Limpiar los campos del formulario
                            $("#registro-form").trigger("reset");

                            // Redirigir después de 3 segundos solo en caso de actualización
                            setTimeout(function() {
                                window.location.href = response.redirect;
                            }, 3000);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var errorMsg = "Error inesperado: " + textStatus + " - " + errorThrown;
                        if (jqXHR.responseText) {
                            errorMsg += " - " + jqXHR.responseText;
                        }
                        mostrarMensaje(errorMsg, true);
                        console.log("Error inesperado:", errorMsg);
                    }
                });
            } else {
                // Es un registro nuevo, verificar cédula y correo
                $.ajax({
                    type: "POST",
                    url: "index.php?controller=controlEmpleado&method=verificarCedulaYCorreo",
                    contentType: "application/json",
                    data: JSON.stringify({ cedula: cedula, correo: correo }),
                    dataType: "json",
                    success: function(data) {
                        if (data.cedulaExiste) {
                            mostrarMensaje("Error: La cédula ya está registrada.", true);
                            console.log("Error: La cédula ya está registrada.");
                            return;
                        }
                        if (data.correoExiste) {
                            mostrarMensaje("Error: El correo ya está registrado.", true);
                            console.log("Error: El correo ya está registrado.");
                            return;
                        }

                        // Si no hay duplicados, registrar el empleado
                        $.ajax({
                            type: "POST",
                            url: "index.php?controller=controlEmpleado&method=guardar",
                            data: $("#registro-form").serialize(),
                            dataType: "json",
                            success: function(response) {
                                if (response.error) {
                                    mostrarMensaje(response.error, true);
                                    console.log("Error de registro:", response.error);
                                } else {
                                    mostrarMensaje(response.success);
                                    console.log("Registro exitoso:", response.success);
                                    // Limpiar los campos del formulario
                                    $("#registro-form").trigger("reset");
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                var errorMsg = "Error inesperado: " + textStatus + " - " + errorThrown;
                                if (jqXHR.responseText) {
                                    errorMsg += " - " + jqXHR.responseText;
                                }
                                mostrarMensaje(errorMsg, true);
                                console.log("Error inesperado:", errorMsg);
                            }
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var errorMsg = "Error en la solicitud: " + textStatus + " - " + errorThrown;
                        if (jqXHR.responseText) {
                            errorMsg += " - " + jqXHR.responseText;
                        }
                        mostrarMensaje(errorMsg, true);
                        console.log("Error inesperado:", errorMsg);
                    }
                });
            }
        });

        function mostrarMensaje(mensaje, isError = false) {
            const mensajeDiv = isError ? $("#error-message") : $("#success-message");
            mensajeDiv.text(mensaje).fadeIn().delay(3000).fadeOut();
        }
    });
    </script>
</body>
</html>
